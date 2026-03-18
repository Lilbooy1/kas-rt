<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:anggota');
    }

    public function index()
    {
        $user = Auth::user();
        $warga = Warga::where('user_id', $user->id)->first();
        
        if (!$warga) {
            return view('anggota.dashboard', [
                'user' => $user,
                'warga' => null,
                'error' => 'Data warga tidak ditemukan. Silakan hubungi admin.'
            ]);
        }

        // Statistik iuran pribadi
        $totalIuran = Iuran::where('warga_id', $warga->id)->count();
        $totalLunas = Iuran::where('warga_id', $warga->id)
            ->where('status', 'lunas')
            ->sum('jumlah');
        $iuranPending = Iuran::where('warga_id', $warga->id)
            ->where('status', 'pending')
            ->count();
        
        // Riwayat iuran (urut dari terbaru)
        $riwayatIuran = Iuran::where('warga_id', $warga->id)
            ->orderBy('tahun', 'desc')
            ->orderByRaw("FIELD(bulan, 'December','November','October','September','August','July','June','May','April','March','February','January')")
            ->get();

        // Cek status iuran bulan ini
        $bulanIni = date('F');
        $tahunIni = date('Y');
        
        $iuranBulanIni = Iuran::where('warga_id', $warga->id)
            ->where('bulan', $bulanIni)
            ->where('tahun', $tahunIni)
            ->first();

        // Cek apakah sudah bayar bulan ini
        $sudahBayarBulanIni = $iuranBulanIni ? true : false;
        
        // Status pembayaran untuk pesan
        if ($iuranBulanIni) {
            if ($iuranBulanIni->status == 'lunas') {
                $statusBulanIni = 'Lunas';
                $pesanBulanIni = 'Terima kasih! Pembayaran iuran bulan ini sudah lunas.';
                $warnaStatus = 'green';
            } elseif ($iuranBulanIni->status == 'pending') {
                $statusBulanIni = 'Menunggu Konfirmasi';
                $pesanBulanIni = 'Pembayaran Anda sedang menunggu konfirmasi admin.';
                $warnaStatus = 'yellow';
            } else {
                $statusBulanIni = 'Batal';
                $pesanBulanIni = 'Pembayaran bulan ini dibatalkan. Silakan hubungi admin.';
                $warnaStatus = 'red';
            }
        } else {
            $statusBulanIni = 'Belum Bayar';
            $pesanBulanIni = 'Anda belum membayar iuran bulan ini.';
            $warnaStatus = 'gray';
        }

        return view('anggota.dashboard', compact(
            'user',
            'warga',
            'totalIuran',
            'totalLunas',
            'iuranPending',
            'riwayatIuran',
            'iuranBulanIni',
            'bulanIni',
            'tahunIni',
            'sudahBayarBulanIni',
            'statusBulanIni',
            'pesanBulanIni',
            'warnaStatus'
        ));
    }

    public function bayarIuran(Request $request)
    {
        $user = Auth::user();
        $warga = Warga::where('user_id', $user->id)->first();

        if (!$warga) {
            return back()->with('error', 'Data warga tidak ditemukan.');
        }

        $request->validate([
            'bulan' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required|numeric|min:10000'
        ]);

        // CEK APAKAH SUDAH ADA IURAN UNTUK BULAN INI
        $existing = Iuran::where('warga_id', $warga->id)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->first();

        if ($existing) {
            if ($existing->status == 'lunas') {
                return back()->with('error', 'Anda sudah membayar iuran bulan ini dengan status LUNAS.');
            } elseif ($existing->status == 'pending') {
                return back()->with('error', 'Anda sudah mengajukan pembayaran untuk bulan ini. Silakan tunggu konfirmasi admin.');
            } else {
                return back()->with('error', 'Pembayaran bulan ini bermasalah. Silakan hubungi admin.');
            }
        }

        // Jika belum ada, buat iuran baru
        Iuran::create([
            'user_id' => $user->id,
            'warga_id' => $warga->id,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'jumlah' => $request->jumlah,
            'status' => 'pending',
            'tanggal_bayar' => null,
            'keterangan' => 'Menunggu konfirmasi admin'
        ]);

        return back()->with('success', 'Permintaan pembayaran iuran berhasil dikirim. Menunggu konfirmasi admin.');
    }
}