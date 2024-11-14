<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WelcomeController extends Controller
{
    public function index(){
        try {
            $mejas = Meja::where('status', 'Tersedia')->get();

            // Enable query log untuk debugging
            DB::enableQueryLog();

            $menus = Menu::with(['detailMenus' => function($query) {
                $query->select('detail_menus.idDetailMenu', 'detail_menus.nama');
            }])->get();

            // Lihat query yang dijalankan
            // dd(\DB::getQueryLog());

            return view('welcome', compact('mejas', 'menus'));
        } catch (\Exception $e) {
            // Log error jika terjadi masalah
            Log::error('Error in index method: ' . $e->getMessage());
            throw $e;
        }
    }
}
