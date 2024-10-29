<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $reservasis = Reservasi::with(['meja', 'user'])->latest()->get();
        return view('admin.reservasi.index', compact('reservasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mejas = Meja::where('status', 'Tersedia')->get();
        return view('admin.reservasi.create', compact('mejas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'email' => 'required|email',
            'no_telepon' => 'required',
            'idMeja' => 'required',
            'tanggal' => 'required|date',
            'jumlahPengunjung' => 'required|numeric',
            'status' => 'required|in:pending,dikonfirmasi,selesai,dibatalkan'
        ]);

        $meja = Meja::findOrFail($request->idMeja);
        if ($meja->status !== 'Tersedia') {
            return back()->with('error', 'Meja tidak tersedia');
        }

        if ($request->jumlahPengunjung > $meja->jumlahPengunjung) {
            return back()->with('error', 'Jumlah pengunjung melebihi kapasitas meja');
        }

        $reservasi = Reservasi::create([
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'idUsers' => Auth::id(),
            'idMeja' => $request->idMeja,
            'tanggal' => $request->tanggal,
            'jumlahPengunjung' => $request->jumlahPengunjung,
            'status' => $request->status ?? 'pending', // Default ke 'pending' jika tidak ada status yang diberikan
        ]);

        $meja->update(['status' => 'Tidak Tersedia']);

        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $mejas = Meja::where('status', 'Tersedia')
            ->orWhere('idMeja', $reservasi->idMeja)
            ->get();
        return view('admin.reservasi.edit', compact('reservasi', 'mejas'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_depan' => 'required',
        'nama_belakang' => 'required',
        'email' => 'required|email',
        'no_telepon' => 'required',
        'idMeja' => 'required|exists:mejas,idMeja',
        'tanggal' => 'required|date',
        'jumlahPengunjung' => 'required|numeric|min:1',
        'status' => 'required|in:pending,dikonfirmasi,selesai,dibatalkan'
    ]);

    $reservasi = Reservasi::findOrFail($id);
    $meja = Meja::findOrFail($request->idMeja);

    // Cek kapasitas meja
    if ($request->jumlahPengunjung > $meja->jumlahPengunjung) {
        return back()->with('error', 'Jumlah pengunjung melebihi kapasitas meja');
    }

    // Jika meja berubah
    if ($reservasi->idMeja != $request->idMeja) {
        // Cek ketersediaan meja baru
        if ($meja->status === 'Tidak Tersedia' && !in_array($request->status, ['selesai', 'dibatalkan'])) {
            return back()->with('error', 'Meja tidak tersedia');
        }

        // Update status meja lama menjadi Tersedia
        Meja::findOrFail($reservasi->idMeja)->update(['status' => 'Tersedia']);
    }

    // Update status meja berdasarkan status reservasi baru
    if (in_array($request->status, ['pending', 'dikonfirmasi'])) {
        $meja->update(['status' => 'Tidak Tersedia']);
    } elseif (in_array($request->status, ['selesai', 'dibatalkan'])) {
        $meja->update(['status' => 'Tersedia']);
    }

    // Update reservasi
    $reservasi->update([
        'nama_depan' => $request->nama_depan,
        'nama_belakang' => $request->nama_belakang,
        'email' => $request->email,
        'no_telepon' => $request->no_telepon,
        'idMeja' => $request->idMeja,
        'tanggal' => $request->tanggal,
        'jumlahPengunjung' => $request->jumlahPengunjung,
        'status' => $request->status
    ]);

    return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil diperbarui');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        Meja::find($reservasi->idMeja)->update(['status' => 'Tersedia']);
        $reservasi->delete();

        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil dihapus');
    }
    public function detail(Reservasi $reservasi)
{
    $reservasi->load(['meja', 'user']);
    $reservasi->formatted_tanggal = Carbon::parse($reservasi->tanggal)->format('d/m/Y H:i');

    return response()->json($reservasi);
}
}
