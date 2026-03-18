<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WargaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role != 'admin') {
            abort(403, 'Unauthorized access.');
        }

        $wargas = Warga::with('user')->paginate(10);
        return view('warga.index', compact('wargas'));
    }

    public function create()
    {
        if (Auth::user()->role != 'admin') {
            abort(403, 'Unauthorized access.');
        }
        return view('warga.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'admin') {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'nik' => 'required|unique:wargas,nik|size:16',
            'no_rumah' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        Warga::create([
            'user_id' => Auth::id(),
            'nik' => $request->nik,
            'no_rumah' => $request->no_rumah,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'status' => 'aktif'
        ]);

        return redirect()->route('warga.index')
            ->with('success', 'Warga berhasil ditambahkan.');
    }

    public function show(Warga $warga)
    {
        if (Auth::user()->role != 'admin') {
            abort(403, 'Unauthorized access.');
        }
        return view('warga.show', compact('warga'));
    }

    public function edit(Warga $warga)
    {
        if (Auth::user()->role != 'admin') {
            abort(403, 'Unauthorized access.');
        }
        return view('warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        if (Auth::user()->role != 'admin') {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'nik' => 'required|size:16|unique:wargas,nik,' . $warga->id,
            'no_rumah' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        $warga->update($request->all());

        return redirect()->route('warga.index')
            ->with('success', 'Warga berhasil diupdate.');
    }

    public function destroy(Warga $warga)
    {
        if (Auth::user()->role != 'admin') {
            abort(403, 'Unauthorized access.');
        }
        
        $warga->delete();
        return redirect()->route('warga.index')
            ->with('success', 'Warga berhasil dihapus.');
    }
}