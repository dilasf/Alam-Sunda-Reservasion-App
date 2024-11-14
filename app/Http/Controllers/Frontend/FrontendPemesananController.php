<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DetailMenu;
use App\Models\ItemPesanan;
use App\Models\Menu;
use App\Models\Pengiriman;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class FrontendPemesananController extends Controller
{
    const STATUS_PENDING = 'pending';
    public function index()
    {
        // Menggunakan eager loading untuk menu dan detail menu dengan relasi many-to-many
        $menus = Menu::with(['detailMenus' => function($query) {
            $query->select('detail_menus.*', 'menu_detail_menu.idMenu');
        }])
        ->select('idMenu', 'nama', 'harga', 'gambar')
        ->get()
        ->map(function($menu) {
            $menu->gambar_url = $menu->gambar ?
                asset('storage/menu-images/' . $menu->gambar) :
                asset('images/default-menu.jpg');
            return $menu;
        });

        return view('frontend.pemesanan.index', compact('menus'));
    }

    public function getMenuWithDetails($id)
    {
        $menu = Menu::with(['detailMenus' => function($query) {
            $query->select('detail_menus.*', 'menu_detail_menu.idMenu');
        }])->findOrFail($id);

        $menu->gambar_url = $menu->gambar ?
            asset('storage/menu-images/' . $menu->gambar) :
            asset('images/default-menu.jpg');

        return response()->json($menu);
    }

    public function processPesanan(Request $request)
{
    $request->validate([
        'items' => 'required|array',
        'items.*.menu_id' => 'required|exists:menus,idMenu',
        'items.*.jumlah' => 'required|integer|min:1',
        'tipePesanan' => 'required|in:takeaway,delivery'
    ]);

    try {
        // Cek waktu pemesanan untuk takeaway
        if ($request->tipePesanan === 'takeaway') {
            $now = now()->setTimezone('Asia/Jakarta');
            $openTime = now()->setTimezone('Asia/Jakarta')->setTime(9, 0, 0);
            $closeTime = now()->setTimezone('Asia/Jakarta')->setTime(19, 0, 0);

            if ($now->lt($openTime) || $now->gt($closeTime)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Maaf, pesanan takeaway hanya dapat dilakukan antara jam 9 pagi - 7 malam WIB. Silahkan order kembali besok pada jam operasional.'
                ], 422);
            }
        }

        DB::beginTransaction();

        // Create base pesanan
        $pesanan = new Pesanan();
        $pesanan->idUser = Auth::id();
        $pesanan->status = 'pending';
        $pesanan->tipePesanan = $request->tipePesanan;
        $pesanan->tanggalPesanan = now();
        $pesanan->save();

        $totalHarga = 0;

        foreach ($request->items as $item) {
            $menu = Menu::findOrFail($item['menu_id']);
            $subtotal = $menu->harga * $item['jumlah'];
            $totalHarga += $subtotal;

            ItemPesanan::create([
                'idPesanan' => $pesanan->idPesanan,
                'idMenus' => $item['menu_id'],
                'jumlah' => $item['jumlah'],
                'harga' => $menu->harga,
                'subtotal' => $subtotal
            ]);
        }

        $pesanan->jumlahTotal = $totalHarga;
        $pesanan->save();

        DB::commit();

        if ($request->tipePesanan === 'delivery') {
            return response()->json([
                'status' => 'success',
                'redirect' => route('frontend.pemesanan.pengiriman', ['idPesanan' => $pesanan->idPesanan])
            ]);
        } else {
            return response()->json([
                'status' => 'success',
                'redirect' => route('frontend.pemesanan.upload', ['idPesanan' => $pesanan->idPesanan])
            ]);
        }

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
}

    public function showPengirimanForm($idPesanan)
{
    $pesanan = Pesanan::with(['itemPesanan.menu', 'pengiriman'])
        ->findOrFail($idPesanan);

    if ($pesanan->idUser !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    return view('frontend.pemesanan.pengiriman', compact('pesanan'));
}

public function storePengiriman(Request $request, $idPesanan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'catatan' => 'nullable|string',
            'nomorTelepon' => 'required|string|max:14',
            'waktuPengiriman' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    try {
                        // Parse input dan set timezone dengan benar
                        $tanggalPengiriman = Carbon::parse($value)->setTimezone('Asia/Jakarta');
                        $now = Carbon::now()->setTimezone('Asia/Jakarta');
                        $maxDate = $now->copy()->addDays(7);

                        // Debug log untuk melihat waktu yang dipilih
                        Log::info('Waktu Pengiriman:', [
                            'input_value' => $value,
                            'parsed_date' => $tanggalPengiriman->format('Y-m-d H:i:s'),
                            'hour' => $tanggalPengiriman->hour,
                        ]);

                        // 1. Validasi rentang tanggal
                        if ($tanggalPengiriman->startOfDay()->lt($now->startOfDay()) ||
                            $tanggalPengiriman->startOfDay()->gt($maxDate->startOfDay())) {
                            $fail('Tanggal pengiriman harus antara hari ini dan 7 hari ke depan.');
                            return;
                        }

                        // Reset tanggalPengiriman karena startOfDay() mengubah waktunya
                        $tanggalPengiriman = Carbon::parse($value)->setTimezone('Asia/Jakarta');

                        // 2. Validasi jam operasional (09:00 - 21:00)
                        $hour = (int) $tanggalPengiriman->format('H');

                        Log::info('Validasi Jam:', [
                            'jam' => $hour,
                            'is_before_nine' => $hour < 9,
                            'is_after_twentyone' => $hour >= 21,
                        ]);

                        if ($hour < 9 || $hour >= 21) {
                            $fail('Waktu pengiriman harus antara jam 09:00 - 21:00.');
                            return;
                        }

                        // 3. Validasi minimal 1 jam dari sekarang untuk pesanan hari ini
                        if ($tanggalPengiriman->isSameDay($now)) {
                            $diffInMinutes = $tanggalPengiriman->diffInMinutes($now);
                            if ($diffInMinutes < 60) {
                                $fail('Waktu pengiriman harus minimal 1 jam dari waktu pemesanan.');
                                return;
                            }
                        }

                    } catch (\Exception $e) {
                        Log::error('Error in waktuPengiriman validation:', [
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString()
                        ]);
                        $fail('Format waktu pengiriman tidak valid.');
                    }
                },
            ]
        ]);

        try {
            DB::beginTransaction();

            $pesanan = Pesanan::findOrFail($idPesanan);

            if ($pesanan->idUser !== Auth::id()) {
                throw new \Exception('Unauthorized action.');
            }

            $pengiriman = Pengiriman::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'catatan' => $request->catatan,
                'nomorTelepon' => $request->nomorTelepon,
                'waktuPengiriman' => Carbon::parse($request->waktuPengiriman)->setTimezone('Asia/Jakarta')
            ]);

            $pesanan->idPengiriman = $pengiriman->idPengiriman;
            $pesanan->jumlahTotal = $pesanan->calculateTotal();
            $pesanan->save();

            DB::commit();

            return redirect()->route('frontend.pemesanan.upload', ['idPesanan' => $idPesanan])
                        ->with('success', 'Data pengiriman berhasil disimpan');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in storePengiriman:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function showUploadForm($idPesanan)
    {
        $pesanan = Pesanan::with(['itemPesanan.menu', 'pengiriman'])
            ->findOrFail($idPesanan);

        if ($pesanan->idUser !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if transaction already exists
        $existingTransaction = Transaksi::where('idPesanan', $idPesanan)->first();
        if ($existingTransaction) {
            return redirect()->route('frontend.pemesanan.status', ['idPesanan' => $idPesanan])
                        ->with('info', 'Transaksi sudah ada untuk pesanan ini.');
        }

        return view('frontend.pemesanan.upload', compact('pesanan'));
    }

    public function storeTransaksi(Request $request, $idPesanan) {
        $request->validate([
            'fotoBukti' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'totalDibayar' => 'required|numeric|min:0'
        ], [
            'fotoBukti.required' => 'File bukti pembayaran harus diupload',
            'fotoBukti.image' => 'File harus berupa gambar',
            'fotoBukti.mimes' => 'Format file harus JPG, JPEG, atau PNG',
            'fotoBukti.max' => 'Ukuran file maksimal 2MB'
        ]);

        try {
            DB::beginTransaction();

            $pesanan = Pesanan::findOrFail($idPesanan);

            if ($pesanan->idUser !== Auth::id()) {
                throw new \Exception('Unauthorized action.');
            }

            // Handle file upload
            $path = null;
            if ($request->hasFile('fotoBukti')) {
                $file = $request->file('fotoBukti');
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Store file in storage/app/public/bukti-pembayaran
                $path = $file->storeAs('bukti-pembayaran', $fileName, 'public');
            }

            // Create transaction data
            $transaksiData = [
                'idPesanan' => $idPesanan,
                'fotoBukti' => $path, // Simpan full path
                'tanggal' => now(),
                'totalPembayaran' => $pesanan->jumlahTotal,
                'totalDibayar' => $request->totalDibayar,
                'status' => Transaksi::STATUS_DIBAYAR
            ];

            // Log transaction data for debugging
            Log::info('Creating transaction with data:', $transaksiData);

            // Create transaction record
            $transaksi = Transaksi::create($transaksiData);

            // Update order status
            $pesanan->update(['status' => 'diproses']);

            DB::commit();

            return redirect()
                ->route('frontend.pemesanan.status', ['idPesanan' => $idPesanan])
                ->with('success', 'Bukti pembayaran berhasil diunggah');

        } catch (\Exception $e) {
            DB::rollBack();

            // Delete uploaded file if exists
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }

            // Log the error
            Log::error('Transaction creation failed:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function showTransactionStatus($idPesanan)
    {
        $pesanan = Pesanan::with([
            'itemPesanan.menu',
            'pengiriman',
            'transaksi'
        ])->findOrFail($idPesanan);

        if ($pesanan->idUser !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($pesanan->transaksi) {
            $transaksi = $pesanan->transaksi;
            $statusData = [
                'isPending' => $transaksi->isPending(),
                'isDibayar' => $transaksi->isDibayar(),
                'isVerified' => $transaksi->isVerified(),
                'isDitolak' => $transaksi->isDitolak(),
                'bukti_url' => $transaksi->getBuktiUrl()
            ];

            foreach ($statusData as $key => $value) {
                $transaksi->$key = $value;
            }
        }

        return view('frontend.pemesanan.status', compact('pesanan'));
    }
}
