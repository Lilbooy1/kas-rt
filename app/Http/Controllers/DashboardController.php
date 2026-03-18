<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Iuran;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            // Data untuk admin
            $totalWarga = Warga::count();
            $totalIuranBulanIni = Iuran::where('bulan', date('F'))
                ->where('tahun', date('Y'))
                ->where('status', 'lunas')
                ->sum('jumlah');
            $totalKas = Iuran::where('status', 'lunas')->sum('jumlah');
            $iuranTerbaru = Iuran::with('warga.user')
                ->latest()
                ->take(5)
                ->get();
            $wargaAktif = Warga::where('status', 'aktif')->count();
            
            return view('dashboard', compact(
                'user', 
                'totalWarga', 
                'totalIuranBulanIni', 
                'totalKas', 
                'iuranTerbaru', 
                'wargaAktif'
            ));
            
        } else {
            // Data untuk anggota
            $warga = Warga::where('user_id', $user->id)->first();
            
            $totalIuranSaya = Iuran::where('user_id', $user->id)->count();
            $totalIuranLunas = Iuran::where('user_id', $user->id)
                ->where('status', 'lunas')
                ->sum('jumlah');
            $iuranSaya = Iuran::where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get();
            
            return view('dashboard', compact(
                'user', 
                'warga', 
                'totalIuranSaya', 
                'totalIuranLunas', 
                'iuranSaya'
            ));
        }
    }
}