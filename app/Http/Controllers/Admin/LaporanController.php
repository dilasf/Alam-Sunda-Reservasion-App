<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Pesanan;
use App\Models\Reservasi;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class LaporanController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'owner') {
            return view('owner.laporan.index');
        } else {
            return view('admin.laporan.index');
        }
    }

    public function generate(Request $request)
    {
        try {
            $validated = $request->validate([
                'report_type' => 'required|in:reservasi,pesanan',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date'
            ]);

            $startDate = $validated['start_date'] . ' 00:00:00';
            $endDate = $validated['end_date'] . ' 23:59:59';

            if ($validated['report_type'] === 'reservasi') {
                $data = Transaksi::with(['reservasi.meja'])
                    ->whereHas('reservasi')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->get();
            } else {
                $data = Transaksi::with(['pesanan.user', 'pesanan.pengiriman'])
                    ->whereHas('pesanan')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->get();
            }

            // Configure PDF based on user role
            if (Auth::user()->role === 'owner') {
                $view = 'owner.laporan.pdf';
            } else {
                $view = 'admin.laporan.pdf';
            }

            // Load view and configure PDF
            $pdf = PDF::loadView($view, compact('data', 'validated'))
                ->setPaper('a4', 'landscape')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'defaultFont' => 'sans-serif'
                ]);

            // Log for debugging
            \Illuminate\Support\Facades\Log::info('Generating PDF report', [
                'user_role' => Auth::user()->role,
                'report_type' => $validated['report_type'],
                'data_count' => $data->count(),
                'view_used' => $view
            ]);

            return $pdf->download('laporan-' . $validated['report_type'] . '.pdf');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('PDF generation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_role' => Auth::user()->role
            ]);

            return redirect()->back()->with('error', 'Gagal menghasilkan laporan: ' . $e->getMessage());
        }
    }
}
