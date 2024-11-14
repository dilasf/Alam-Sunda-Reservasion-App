<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with(['user', 'itemPesanan.menu'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.pesanan.index', compact('pesanans'));
    }

    public function show($id)
    {
        $pesanan = Pesanan::with(['user', 'itemPesanan.menu', 'pengiriman', 'transaksi'])
            ->findOrFail($id);

        return view('admin.pesanan.show', compact('pesanan'));
    }

    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $statusOptions = [
            'pending' => 'Pending',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan'
        ];

        return view('admin.pesanan.edit', compact('pesanan', 'statusOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,dibatalkan'
        ]);

        try {
            DB::beginTransaction();

            $pesanan = Pesanan::findOrFail($id);

            // Update status pesanan
            $pesanan->status = $request->status;
            $pesanan->save();

            // Cek jika pesanan memiliki pengiriman
            if ($pesanan->pengiriman) {
                if ($request->status === 'selesai') {
                    $pesanan->pengiriman->update([
                        'status' => 'selesai'
                    ]);
                } elseif ($request->status === 'dibatalkan') {
                    $pesanan->pengiriman->update([
                        'status' => 'dibatalkan'
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.pesanan.index')
                ->with('success', 'Status pesanan berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Terjadi kesalahan saat memperbarui status pesanan')
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $pesanan = Pesanan::findOrFail($id);

            // Delete related records first
            $pesanan->itemPesanan()->delete();
            if ($pesanan->transaksi) {
                $pesanan->transaksi->delete();
            }
            if ($pesanan->pengiriman) {
                $pesanan->pengiriman->delete();
            }

            $pesanan->delete();

            DB::commit();

            return redirect()
                ->route('admin.pesanan.index')
                ->with('success', 'Pesanan berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menghapus pesanan');
        }
    }
}
