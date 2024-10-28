<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DetailMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = DetailMenu::latest()->paginate(10);
        return view('admin.detail.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.detail.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric|min:0'
        ]);

        $gambar = $request->file('gambar');
        $gambarPath = $gambar->store('menu-images', 'public');

        DetailMenu::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
            'harga' => $request->harga
        ]);

        return redirect()->route('admin.detail.index')
            ->with('success', 'Menu created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailMenu  $detailMenu)
    {
        return view('admin.detail.show', compact('detailMenu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailMenu  $detailMenu)
    {
        return view('admin.detail.edit', compact('detailMenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailMenu $detailMenu)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'harga' => 'required|numeric|min:0'
        ]);

        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga
        ];

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($detailMenu->gambar) {
                Storage::disk('public')->delete($detailMenu->gambar);
            }

            // Store new image
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->store('menu-images', 'public');
            $data['gambar'] = $gambarPath;
        }

        $detailMenu->update($data);

        return redirect()->route('admin.detail.index')
            ->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailMenu  $detailMenu)
    {
        if ($detailMenu->gambar) {
            Storage::disk('public')->delete($detailMenu->gambar);
        }

        $detailMenu->delete();

        return redirect()->route('admin.detail.index')
            ->with('success', 'Menu deleted successfully.');
    }
}
