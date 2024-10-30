<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\Models\Transaksi;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['reservasi'])->latest()->paginate(10);
        return view('admin.transaksi.index', compact('transaksis'));
    }

    /**
     * Display the specified transaction.
     */
    public function show(Transaksi $transaksi)
    {
        $transaksi->load('reservasi');
        return view('admin.transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit(Transaksi $transaksi)
    {
        $transaksi->load('reservasi');
        return view('admin.transaksi.edit', compact('transaksi'));
    }

    /**
     * Update the specified transaction in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,dibayar,diverifikasi,ditolak',
            'totalDibayar' => 'sometimes|required|numeric'
        ]);

        // Start a database transaction
        \Illuminate\Support\Facades\DB::beginTransaction();

        try {
            // Update transaksi
            $transaksi->update($validated);

            // Get the related meja through reservasi
            $meja = $transaksi->reservasi->meja;

            // Update reservasi and meja status based on transaksi status
            if ($transaksi->status === Transaksi::STATUS_VERIFIED) {
                $transaksi->reservasi->update(['status' => 'dikonfirmasi']);
                // Update meja status to Tidak Tersedia
                if ($meja) {
                    $meja->update(['status' => Meja::STATUS_TIDAK_TERSEDIA]);
                }
            } elseif ($transaksi->status === Transaksi::STATUS_DITOLAK) {
                $transaksi->reservasi->update(['status' => 'dibatalkan']);
                // Update meja status to Tersedia
                if ($meja) {
                    $meja->update(['status' => Meja::STATUS_TERSEDIA]);
                }
            }

            \Illuminate\Support\Facades\DB::commit();

            return redirect()
                ->route('admin.transaksi.index')
                ->with('success', 'Transaksi berhasil diperbarui');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollback();
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui transaksi');
        }
    }

    /**
     * Remove the specified transaction from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        try {
            // Delete old bukti pembayaran if exists
            if ($transaksi->fotoBukti) {
                Storage::delete('public/bukti-pembayaran/' . $transaksi->fotoBukti);
            }

            $transaksi->delete();

            return redirect()
                ->route('transaksi.index')
                ->with('success', 'Transaksi berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus transaksi');
        }
    }
}
