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
        'nomorTelepon' => 'required|string|max:14'
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
            'nomorTelepon' => $request->nomorTelepon
        ]);

        $pesanan->idPengiriman = $pengiriman->idPengiriman;
        $pesanan->jumlahTotal = $pesanan->calculateTotal();
        $pesanan->save();

        DB::commit();

        return redirect()->route('frontend.pemesanan.upload', ['idPesanan' => $idPesanan])
                    ->with('success', 'Data pengiriman berhasil disimpan');

    } catch (\Exception $e) {
        DB::rollBack();
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

    public function storeTransaksi(Request $request, $idPesanan)
    {
        $request->validate([
            'fotoBukti' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'totalDibayar' => 'required|numeric|min:0'
        ]);

        try {
            DB::beginTransaction();

            $pesanan = Pesanan::findOrFail($idPesanan);

            if ($pesanan->idUser !== Auth::id()) {
                throw new \Exception('Unauthorized action.');
            }

            // Handle file upload
            $fotoBukti = null;
            if ($request->hasFile('fotoBukti')) {
                $file = $request->file('fotoBukti');
                $fotoBukti = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/bukti_pembayaran', $fotoBukti);
            }

            // Buat array data transaksi
            $transaksiData = [
                'idPesanan' => $idPesanan,
                'fotoBukti' => $fotoBukti,
                'tanggal' => now(),
                'totalPembayaran' => $pesanan->jumlahTotal,
                'totalDibayar' => $request->totalDibayar,
                'status' => Transaksi::STATUS_DIBAYAR
            ];

            // Debug log
            Log::info('Creating transaction with data:', $transaksiData);

            // Create transaction
            $transaksi = Transaksi::create($transaksiData);

            // Update pesanan status menggunakan update() untuk memastikan nilai string
            $pesanan->update(['status' => 'diproses']); // Menggunakan string literal

            DB::commit();

            return redirect()->route('frontend.pemesanan.status', ['idPesanan' => $idPesanan])
                        ->with('success', 'Bukti pembayaran berhasil diunggah');

        } catch (\Exception $e) {
            DB::rollBack();

            if (isset($fotoBukti)) {
                Storage::delete('public/bukti_pembayaran/' . $fotoBukti);
            }

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
