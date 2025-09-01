<?php

namespace App\Http\Controllers;

use App\Models\Distribusi;
use App\Models\Barang;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistribusiController extends Controller
{
    public function index()
    {
        $distribusi = Distribusi::with(['barang', 'divisi', 'petugas'])->get();
        return view('distribusi.index', compact('distribusi'));
    }

    public function create()
    {
        $barang = Barang::all();
        $divisi = Divisi::all();
        return view('distribusi.create', compact('barang', 'divisi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'tanggal_distribusi' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'divisi_id' => 'required|exists:divisi,id',
            'keterangan_kondisi_awal' => 'required|string|max:255',
        ]);

        Distribusi::create([
            'barang_id' => $request->barang_id,
            'tanggal_distribusi' => $request->tanggal_distribusi,
            'jumlah' => $request->jumlah,
            'divisi_id' => $request->divisi_id,
            'keterangan_kondisi_awal' => $request->keterangan_kondisi_awal,
            'petugas_id' => Auth::id(),
        ]);

        return redirect()->route('distribusi.index')->with('success', 'Distribusi barang berhasil dicatat.');
    }

    // Tambahkan fungsi show, edit, update, destroy jika diperlukan
}