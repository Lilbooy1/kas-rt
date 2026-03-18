<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IuranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $iurans = Iuran::with('warga.user')->latest()->paginate(10);
        } else {
            $warga = Warga::where('user_id', Auth::id())->first();
            $iurans = Iuran::where('warga_id', $warga->id ?? 0)
                ->with('warga.user')
                ->latest()
                ->paginate(10);
        }
        
        return view('iuran.index', compact('iurans'));
    }

    public function create()
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $wargas = Warga::with('user')->where('status', 'aktif')->get();
        $bulan = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        $tahun = range(date('Y'), date('Y') - 2);
        
        return view('iuran.create', compact('wargas', 'bulan', 'tahun'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $request->validate([
            'warga_id' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required|numeric'
        ]);

        Iuran::create([
            'user_id' => Auth::id(),
            'warga_id' => $request->warga_id,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'jumlah' => $request->jumlah,
            'tanggal_bayar' => $request->tanggal_bayar,
            'status' => $request->status ?? 'pending',
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('iuran.index')->with('success', 'Iuran berhasil ditambahkan');
    }

    public function edit(Iuran $iuran)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $wargas = Warga::with('user')->where('status', 'aktif')->get();
        $bulan = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        $tahun = range(date('Y'), date('Y') - 2);
        
        return view('iuran.edit', compact('iuran', 'wargas', 'bulan', 'tahun'));
    }

    public function update(Request $request, Iuran $iuran)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $request->validate([
            'warga_id' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required|numeric'
        ]);

        $iuran->update($request->all());

        return redirect()->route('iuran.index')->with('success', 'Iuran berhasil diupdate');
    }

    public function destroy(Iuran $iuran)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        $iuran->delete();
        return redirect()->route('iuran.index')->with('success', 'Iuran berhasil dihapus');
    }
}