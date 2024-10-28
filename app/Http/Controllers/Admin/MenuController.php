<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::with('detailMenus')->get();
        return view('admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $detailMenus = DetailMenu::all();
        return view('admin.menu.create', compact('detailMenus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'detail_menus' => 'required|array',
            'detail_menus.*' => 'exists:detail_menus,idDetailMenu'
        ]);

        $gambar = $request->file('gambar');
        $gambarPath = $gambar->store('menu-images', 'public');
        $totalHarga = DetailMenu::whereIn('idDetailMenu', $request->detail_menus)
            ->sum('harga');

        $menu = Menu::create([
            'nama' => $request->nama,
            'gambar' => $gambarPath,
            'harga' => $totalHarga
        ]);

        $menu->detailMenus()->attach($request->detail_menus);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil ditambahkan');
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
        $menu = Menu::with('detailMenus')->findOrFail($id);
        $detailMenus = DetailMenu::all();
        return view('admin.menu.edit', compact('menu', 'detailMenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|max:100',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'detail_menus' => 'required|array',
        'detail_menus.*' => 'exists:detail_menus,idDetailMenu'
    ]);

    $menu = Menu::findOrFail($id);

    // Calculate total price based on selected detail menus
    $totalHarga = DetailMenu::whereIn('idDetailMenu', $request->detail_menus)
        ->sum('harga');

    // Prepare data for updating
    $data = [
        'nama' => $request->nama,
        'harga' => $totalHarga
    ];

    // Handle image upload if a new image is provided
    if ($request->hasFile('gambar')) {
        // Delete old image if it exists
        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }

        // Store new image and add to data
        $gambar = $request->file('gambar');
        $gambarPath = $gambar->store('menu-images', 'public');
        $data['gambar'] = $gambarPath;
    }

    // Update the menu with the new data
    $menu->update($data);

    // Sync the detail menus
    $menu->detailMenus()->sync($request->detail_menus);

    return redirect()->route('admin.menu.index')
        ->with('success', 'Menu berhasil diperbarui');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        // Detach any related detail menus
        $menu->detailMenus()->detach();

        // Delete the image if it exists
        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }

        // Delete the menu
        $menu->delete();

        return redirect()->route('admin.menu.index')
            ->with('success', 'Menu berhasil dihapus');
    }

}
