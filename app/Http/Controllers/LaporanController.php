<?php

namespace App\Http\Controllers;
use App\Models\Iuran;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;  // <-- TAMBAHKAN UNTUK DEBUG

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin'); // Hanya admin yang bisa akses laporan
    }

    public function index()
    {
        // Statistik Total
        $totalKas = Iuran::where('status', 'lunas')->sum('jumlah');
        $totalWarga = Warga::count();
        $totalIuran = Iuran::count();
        $totalLunas = Iuran::where('status', 'lunas')->count();

        // GRAFIK PER BULAN (TAHUN INI)
        $tahunIni = date('Y'); // 2026
        
        // Query untuk grafik
        $grafikBulan = Iuran::select('bulan', DB::raw('SUM(jumlah) as total'))
            ->where('tahun', $tahunIni)
            ->where('status', 'lunas')
            ->groupBy('bulan')
            ->orderBy(DB::raw('FIELD(bulan, "January","February","March","April","May","June","July","August","September","October","November","December")'))
            ->get();

        // DEBUG: cek apakah ada data
        if ($grafikBulan->isEmpty()) {
            Log::info('GRAFIK KOSONG - Tidak ada data iuran lunas untuk tahun ' . $tahunIni);
            
            // Cek semua data iuran
            $semuaIuran = Iuran::all();
            Log::info('Total semua iuran: ' . $semuaIuran->count());
            
            foreach ($semuaIuran as $i) {
                Log::info('Data: ' . $i->bulan . ' ' . $i->tahun . ' ' . $i->status . ' Rp' . $i->jumlah);
            }
        } else {
            Log::info('DATA GRAFIK DITEMUKAN:', $grafikBulan->toArray());
        }

        // Data untuk chart
        $bulanData = [];
        $jumlahData = [];
        
        $semuaBulan = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        
        foreach ($semuaBulan as $bulan) {
            $bulanData[] = substr($bulan, 0, 3); // Jan, Feb, Mar, etc
            $found = $grafikBulan->firstWhere('bulan', $bulan);
            $jumlahData[] = $found ? (int)$found->total : 0;
        }

        // DEBUG: lihat jumlahData
        Log::info('JumlahData:', $jumlahData);

        // 5 Iuran Terbesar
        $iuranTerbesar = Iuran::with('warga.user')
            ->where('status', 'lunas')
            ->orderBy('jumlah', 'desc')
            ->take(5)
            ->get();

        // Laporan per Bulan (untuk tabel)
        $laporanBulan = Iuran::select(
                DB::raw('YEAR(tanggal_bayar) as tahun'),
                DB::raw('MONTH(tanggal_bayar) as bulan_num'),
                DB::raw('MONTHNAME(tanggal_bayar) as bulan'),
                DB::raw('COUNT(*) as total_transaksi'),
                DB::raw('SUM(jumlah) as total_nominal'),
                DB::raw('SUM(CASE WHEN status = "lunas" THEN jumlah ELSE 0 END) as total_lunas')
            )
            ->whereNotNull('tanggal_bayar')
            ->groupBy(DB::raw('YEAR(tanggal_bayar)'), DB::raw('MONTH(tanggal_bayar)'), DB::raw('MONTHNAME(tanggal_bayar)'))
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan_num', 'desc')
            ->paginate(12);

        return view('laporan.index', compact(
            'totalKas',
            'totalWarga',
            'totalIuran',
            'totalLunas',
            'bulanData',
            'jumlahData',
            'iuranTerbesar',
            'laporanBulan'
        ));
    }

    public function perBulan(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun ?? date('Y');

        $iurans = Iuran::with('warga.user')
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->orderBy('created_at', 'desc')
            ->get();

        $total = $iurans->where('status', 'lunas')->sum('jumlah');
        $lunas = $iurans->where('status', 'lunas')->count();
        $pending = $iurans->where('status', 'pending')->count();

        return view('laporan.per-bulan', compact('iurans', 'bulan', 'tahun', 'total', 'lunas', 'pending'));
    }

    public function exportExcel(Request $request)
    {
        // Nanti kita buat export ke Excel
        return redirect()->back()->with('success', 'Fitur export sedang dalam pengembangan');
    }

    public function exportPdf(Request $request)
    {
        // Nanti kita buat export ke PDF
        return redirect()->back()->with('success', 'Fitur export sedang dalam pengembangan');
    }
}