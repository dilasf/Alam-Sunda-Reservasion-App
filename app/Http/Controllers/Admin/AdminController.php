<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailMenu;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Reservasi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalDetailMenus = DetailMenu::count();
        $totalMenus = Menu::count();
        $totalMejas = Meja::count();
        $totalReservasis = Reservasi::count();
        $totalPesanans = Pesanan::count();
        // Calculate total payments from all transactions
        $totalPembayaran = Transaksi::where('status', Transaksi::STATUS_VERIFIED)
            ->sum('totalPembayaran');
        $totalTransaksis = Transaksi::count();

        if (Auth::user()->role === 2) {
            // Logic khusus untuk owner
            return view('owner.dashboard.index', compact(
                'totalDetailMenus',
                'totalMenus',
                'totalMejas',
                'totalReservasis',
                'totalPesanans',
                'totalPembayaran',
                'totalTransaksis',
            ));
        } else {
            // Logic untuk admin
            return view('admin.dashboard.index', compact(
                'totalDetailMenus',
                'totalMenus',
                'totalMejas',
                'totalReservasis',
                'totalPesanans',
                'totalPembayaran',
                'totalTransaksis',
            ));
        }
        // Passing data to the view

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
