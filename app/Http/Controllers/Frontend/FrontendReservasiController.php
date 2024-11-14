<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Reservasi;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Log;

class FrontendReservasiController extends Controller
{

    public function createReservasi()
{
    // Tampilkan form reservasi
    $mejas = Meja::where('status', 'Tersedia')->get();
    $menus = Menu::with('detailMenus')->get();
    return view('frontend.reservasi.dashboard', compact('mejas','menus'));
}

public function storeReservasi(Request $request)
{
    try {
        // Debug input yang diterima
        \Illuminate\Support\Facades\Log::info('Form Data Received:', $request->all());

        // Validasi dengan custom messages
        $messages = [
            'nama_depan.required' => 'Nama depan harus diisi',
            'nama_belakang.required' => 'Nama belakang harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'no_telepon.required' => 'Nomor telepon harus diisi',
            'idMeja.required' => 'Meja harus dipilih',
            'idMeja.exists' => 'Meja yang dipilih tidak valid',
            'tanggal.required' => 'Tanggal dan waktu harus diisi',
            'tanggal.date_format' => 'Format tanggal dan waktu tidak valid',
            'jumlahPengunjung.required' => 'Jumlah pengunjung harus diisi',
            'jumlahPengunjung.integer' => 'Jumlah pengunjung harus berupa angka',
            'jumlahPengunjung.min' => 'Jumlah pengunjung minimal 1 orang'
        ];

        $validated = $request->validate([
            'nama_depan' => 'required|string',
            'nama_belakang' => 'required|string',
            'email' => 'required|email',
            'no_telepon' => 'required|string',
            'idMeja' => 'required|exists:mejas,idMeja',
            'tanggal' => [
                'required',
                'date_format:Y-m-d\TH:i',
                function ($attribute, $value, $fail) {
                    $date = Carbon::createFromFormat('Y-m-d\TH:i', $value);
                    if ($date->hour < 9 || $date->hour >= 21) {
                        $fail('Reservasi hanya dapat dilakukan pada pukul 09:00 - 21:00.');
                    }
                },
            ],
            'jumlahPengunjung' => 'required|integer|min:1'
        ], $messages);

        \Illuminate\Support\Facades\Log::info('Validation passed', $validated);

        // Debug autentikasi
        if (!Auth::check()) {
            \Illuminate\Support\Facades\Log::error('User not authenticated');
            throw new \Exception('Anda harus login terlebih dahulu.');
        }

        DB::beginTransaction();

        // Debug meja
        $meja = Meja::where('idMeja', $request->idMeja)->first();
        if (!$meja) {
            \Illuminate\Support\Facades\Log::error('Table not found', ['requested_id' => $request->idMeja]);
            throw new \Exception('Meja tidak ditemukan.');
        }

        // Debug kapasitas
        if ($meja->jumlahPengunjung < $request->jumlahPengunjung) {
            \Illuminate\Support\Facades\Log::error('Capacity mismatch', [
                'table_capacity' => $meja->jumlahPengunjung,
                'requested_capacity' => $request->jumlahPengunjung
            ]);
            throw new \Exception("Kapasitas meja {$meja->jumlahPengunjung} orang tidak mencukupi untuk {$request->jumlahPengunjung} pengunjung.");
        }

        // Debug reservasi yang ada
        $existingReservasi = Reservasi::where('idMeja', $request->idMeja)
            ->where('tanggal', $request->tanggal)
            ->where('status', '!=', 'dibatalkan')  // Perbaikan: menggunakan status yang sesuai dengan enum
            ->first();

        if ($existingReservasi) {
            \Illuminate\Support\Facades\Log::error('Existing reservation found', ['reservation' => $existingReservasi]);
            throw new \Exception('Meja sudah direservasi pada waktu tersebut.');
        }

        // Buat reservasi
        $reservasi = new Reservasi();
        $reservasi->nama_depan = $request->nama_depan;
        $reservasi->nama_belakang = $request->nama_belakang;
        $reservasi->email = $request->email;
        $reservasi->no_telepon = $request->no_telepon;
        $reservasi->idUsers = Auth::id();
        $reservasi->idMeja = $request->idMeja;
        $reservasi->tanggal = $request->tanggal;
        $reservasi->jumlahPengunjung = $request->jumlahPengunjung;
        $reservasi->status = 'pending';
        $reservasi->save();

        \Illuminate\Support\Facades\Log::info('Reservation created', ['reservation_id' => $reservasi->idReservasi]);

        // Update status meja
        $meja->status = 'Tidak Tersedia';
        $meja->save();

        \Illuminate\Support\Facades\Log::info('Table status updated');

        // Buat transaksi
        $transaksi = new Transaksi();
        $transaksi->idReservasi = $reservasi->idReservasi;
        $transaksi->tanggal = now()->toDateString(); // Menggunakan toDateString() karena kolom tanggal bertipe date
        $transaksi->totalPembayaran = 150000.00;  // Menggunakan format desimal yang sesuai
        $transaksi->totalDibayar = 0.00;  // Menggunakan format desimal yang sesuai
        $transaksi->status = 'pending';
        $transaksi->save();

        \Illuminate\Support\Facades\Log::info('Transaction created', ['transaction_id' => $transaksi->idTransaksi]);

        DB::commit();
        \Illuminate\Support\Facades\Log::info('All operations completed successfully');

        return redirect()
            ->route('frontend.reservasi.upload', $transaksi->idTransaksi)
            ->with('success', 'Reservasi berhasil dibuat. Silahkan upload bukti pembayaran.');

    } catch (\Illuminate\Validation\ValidationException $e) {
        DB::rollback();
        \Illuminate\Support\Facades\Log::error('Validation error', ['errors' => $e->errors()]);
        return back()
            ->withErrors($e->errors())
            ->withInput();

    } catch (\Exception $e) {
        DB::rollback();
        \Illuminate\Support\Facades\Log::error('General error', ['message' => $e->getMessage()]);
        return back()
            ->with('error', $e->getMessage())
            ->withInput();
    }
}

public function cancelReservasi($idReservasi)
{
    try {
        DB::beginTransaction();

        $reservasi = Reservasi::findOrFail($idReservasi);

        // Validasi apakah user yang login berhak membatalkan reservasi ini
        if ($reservasi->idUsers !== Auth::id()) {
            throw new \Exception('Anda tidak memiliki akses untuk membatalkan reservasi ini.');
        }

        // Validasi apakah reservasi masih bisa dibatalkan (misalnya berdasarkan status atau waktu)
        if ($reservasi->status === 'selesai' || $reservasi->status === 'dibatalkan') {
            throw new \Exception('Reservasi tidak dapat dibatalkan karena status sudah ' . $reservasi->status);
        }

        // Update status reservasi
        $reservasi->status = 'dibatalkan';
        $reservasi->save();

        // Update status transaksi menjadi ditolak
        $transaksi = Transaksi::where('idReservasi', $idReservasi)->first();
        if ($transaksi) {
            $transaksi->status = 'ditolak';
            $transaksi->save();
        }

        // Kembalikan status meja menjadi 'Tersedia'
        $meja = Meja::find($reservasi->idMeja);
        if ($meja) {
            $meja->status = 'Tersedia';
            $meja->save();
        }

        DB::commit();

        return back()->with('success', 'Reservasi berhasil dibatalkan');

    } catch (\Exception $e) {
        DB::rollback();
        \Illuminate\Support\Facades\Log::error('Error in cancelReservasi:', [
            'message' => $e->getMessage(),
            'idReservasi' => $idReservasi,
            'user_id' => Auth::id()
        ]);
        return back()->with('error', $e->getMessage());
    }
}

public function showUploadBukti($idTransaksi)
{
    $transaksi = Transaksi::with(['reservasi' => function($query) {
        $query->select('idReservasi', 'idUsers', 'tanggal', 'status');
    }])->findOrFail($idTransaksi);

    // Cek apakah transaksi milik user yang sedang login
    if ($transaksi->reservasi->idUsers !== Auth::id()) {
        return redirect()->route('frontend.reservasi.dashboard')
            ->with('error', 'Anda tidak memiliki akses ke transaksi ini');
    }

    // // Tambahan: cek status transaksi
    // if (!$transaksi->isPending()) {
    //     return redirect()->route('frontend.reservasi.success');
    // }

    return view('frontend.reservasi.upload', compact('transaksi'));
}

public function uploadBukti(Request $request, $idTransaksi)
{
    // Validasi request
    $request->validate([
        'fotoBukti' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ], [
        'fotoBukti.required' => 'File bukti pembayaran harus diupload',
        'fotoBukti.image' => 'File harus berupa gambar',
        'fotoBukti.mimes' => 'Format file harus JPG, JPEG, atau PNG',
        'fotoBukti.max' => 'Ukuran file maksimal 2MB'
    ]);

    try {
        // Cari transaksi berdasarkan ID
        $transaksi = Transaksi::with('reservasi')->findOrFail($idTransaksi);

        // Cek apakah bukti pembayaran sudah diupload sebelumnya
        // if ($transaksi->status === 'dibayar') {
        //     return redirect()->route('frontend.reservasi.success');
        // }

        // Handle upload file
        if ($request->hasFile('fotoBukti')) {
            // Hapus file lama jika ada
            if ($transaksi->fotoBukti && Storage::disk('public')->exists($transaksi->fotoBukti)) {
                Storage::disk('public')->delete($transaksi->fotoBukti);
            }

            // Upload file baru
            $file = $request->file('fotoBukti');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('bukti-pembayaran', $fileName, 'public');

            // Update data transaksi
            $transaksi->update([
                'fotoBukti' => $path,
                'status' => 'dibayar'
            ]);

            // Redirect dengan menyertakan idReservasi
            return redirect()->route('frontend.reservasi.success', ['idReservasi' => $transaksi->reservasi->idReservasi])
                           ->with('success', 'Bukti pembayaran berhasil diupload.');
        }

        return redirect()->back()->with('error', 'Terjadi kesalahan saat upload file');

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

    public function success($idReservasi)
    {
        $reservasi = Reservasi::with('transaksi')->findOrFail($idReservasi);
        return view('frontend.reservasi.success', compact('reservasi'));
    }

}
