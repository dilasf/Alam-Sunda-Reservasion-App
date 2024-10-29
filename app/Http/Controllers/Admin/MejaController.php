<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $mejas = Meja::all();
        return view('admin.meja.index', compact('mejas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statusOptions = Meja::getStatusOptions();
        return view('admin.meja.create', compact('statusOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'jumlahPengunjung' => 'required|numeric',
            'status' => 'required|in:Tersedia,Tidak Tersedia',
            'lokasi' => 'required|max:150'
        ]);

        Meja::create($request->all());
        return redirect()->route('admin.meja.index')
            ->with('success', 'Meja berhasil ditambahkan.');
    }

    public function edit(Meja $meja)
    {
        $statusOptions = Meja::getStatusOptions();
        return view('admin.meja.edit', compact('meja', 'statusOptions'));
    }

    public function update(Request $request, Meja $meja)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'jumlahPengunjung' => 'required|numeric',
            'status' => 'required|in:Tersedia,Tidak Tersedia',
            'lokasi' => 'required|max:150'
        ]);

        // Cek jika ada perubahan status dari Tidak Tersedia ke Tersedia
        if ($meja->status === 'Tidak Tersedia' && $request->status === 'Tersedia') {
            // Cek apakah ada reservasi aktif untuk meja ini
            $activeReservation = Reservasi::where('idMeja', $meja->idMeja)
                ->whereIn('status', ['pending', 'dikonfirmasi'])
                ->first();

            if ($activeReservation) {
                return back()->with('error', 'Tidak dapat mengubah status meja karena masih ada reservasi aktif.');
            }
        }

        $meja->update($request->all());
        return redirect()->route('admin.meja.index')
            ->with('success', 'Meja berhasil diperbarui.');
    }

    public function destroy(Meja $meja)
    {
        // Cek apakah ada reservasi yang terkait dengan meja ini
        $hasReservations = Reservasi::where('idMeja', $meja->idMeja)
            ->whereIn('status', ['pending', 'dikonfirmasi'])
            ->exists();

        if ($hasReservations) {
            return back()->with('error', 'Tidak dapat menghapus meja karena masih ada reservasi aktif.');
        }

        $meja->delete();
        return redirect()->route('admin.meja.index')
            ->with('success', 'Meja berhasil dihapus.');
    }
}
