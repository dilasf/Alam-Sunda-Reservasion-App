<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\Models\Notification;
use App\Models\Reservasi;
use App\Models\Transaksi;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with([
            'reservasi',
            'pesanan.user',
            'pesanan.pengiriman',
            'pesanan.itemPesanan'
        ])
            ->latest()
            ->paginate(10);

        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with([
            'reservasi',
            'pesanan.user',
            'pesanan.pengiriman',
            'pesanan.itemPesanan'
        ])->findOrFail($id);

        return view('admin.transaksi.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::with([
            'reservasi',
            'pesanan.user',
            'pesanan.pengiriman',
            'pesanan.itemPesanan'
        ])->findOrFail($id);

        return view('admin.transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id();
        $transaksi = Transaksi::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,dibayar,diverifikasi,ditolak',
            'totalPembayaran' => 'sometimes|required|numeric',
            'bukti_pembayaran' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        DB::beginTransaction();

        try {
            // Handle file upload if new bukti pembayaran is provided
            if ($request->hasFile('bukti_pembayaran')) {
                // Delete old file if exists
                if ($transaksi->reservasi && $transaksi->reservasi->bukti_pembayaran) {
                    Storage::delete('public/' . $transaksi->reservasi->bukti_pembayaran);
                }

                $path = $request->file('bukti_pembayaran')->store('bukti-pembayaran', 'public');
                if ($transaksi->reservasi) {
                    $transaksi->reservasi->update(['bukti_pembayaran' => $path]);
                }
            }

            // Update transaction status
            $transaksi->update([
                'status' => $validated['status'],
                'totalPembayaran' => $validated['totalPembayaran'] ?? $transaksi->totalPembayaran
            ]);

            // Handle Pesanan specific updates
            if ($transaksi->pesanan) {
                if ($validated['status'] === 'diverifikasi') {
                    if ($transaksi->pesanan->tipePesanan === 'delivery' && $transaksi->pesanan->pengiriman) {
                        $transaksi->pesanan->pengiriman->update(['status' => 'dikirim']);
                    }
                    $transaksi->pesanan->update(['status' => 'diproses']);
                } elseif ($validated['status'] === 'ditolak') {
                    if ($transaksi->pesanan->tipePesanan === 'delivery' && $transaksi->pesanan->pengiriman) {
                        $transaksi->pesanan->pengiriman->update(['status' => 'dibatalkan']);
                    }
                    $transaksi->pesanan->update(['status' => 'dibatalkan']);
                }
            }

            // Handle Reservasi specific updates
            if ($transaksi->reservasi) {
                $meja = $transaksi->reservasi->meja;

                if ($validated['status'] === 'diverifikasi') {
                    $transaksi->reservasi->update(['status' => 'dikonfirmasi']);
                    if ($meja) {
                        $meja->update(['status' => 'Tidak Tersedia']);
                    }
                } elseif ($validated['status'] === 'ditolak') {
                    $transaksi->reservasi->update(['status' => 'dibatalkan']);
                    if ($meja) {
                        $meja->update(['status' => 'Tersedia']);
                    }
                }
            }

            if ($validated['status'] === 'dibayar') {
                $type = $transaksi->reservasi ? 'reservasi' : 'pesanan';
                $name = $type === 'reservasi'
                    ? $transaksi->reservasi->nama
                    : $transaksi->pesanan->user->name;

                Notification::create([
                    'user_id' => Auth::id(), // Alternative method
                    'title' => 'Pembayaran Baru',
                    'message' => "Pembayaran {$type} baru dari {$name}",
                    'type' => $type,
                    'reference_id' => $type === 'reservasi'
                        ? $transaksi->reservasi->id
                        : $transaksi->pesanan->id
                ]);
            }

            DB::commit();

            return redirect()
                ->route('admin.transaksi.index')
                ->with('success', 'Transaksi berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui transaksi: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        DB::beginTransaction();

        try {
            // Handle Pesanan deletion
            if ($transaksi->pesanan) {
                if ($transaksi->pesanan->pengiriman) {
                    $transaksi->pesanan->pengiriman->delete();
                }
                $transaksi->pesanan->itemPesanan()->delete();
                $transaksi->pesanan->delete();
            }

            // Handle Reservasi deletion
            if ($transaksi->reservasi) {
                if ($transaksi->reservasi->bukti_pembayaran) {
                    Storage::delete('public/' . $transaksi->reservasi->bukti_pembayaran);
                }

                // Update meja status if necessary
                if ($transaksi->reservasi->meja) {
                    $transaksi->reservasi->meja->update(['status' => 'available']);
                }

                $transaksi->reservasi->delete();
            }

            $transaksi->delete();

            DB::commit();

            return redirect()
                ->route('admin.transaksi.index')
                ->with('success', 'Transaksi berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus transaksi: ' . $e->getMessage());
        }
    }
}
