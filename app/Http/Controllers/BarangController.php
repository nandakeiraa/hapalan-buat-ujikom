<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'kondisi' => 'required|string|max:100',
            'tahun_pengadaan' => 'required|digits:4|integer',
            'foto' => 'nullable|image|max:2048',
            'divisi_id' => 'nullable|integer',
        ]);

        // Generate kode inventaris unik (contoh sederhana)
        $kodeInventaris = 'INV-' . strtoupper(Str::random(8));

        // Generate QR code sebagai file PNG dan simpan di storage/app/public/qrcodes
        $qrCodeImage = QrCode::format('png')->size(300)->generate($kodeInventaris);
        $qrCodeFileName = 'qrcode-' . $kodeInventaris . '.png';
        Storage::disk('public')->put('qrcodes/' . $qrCodeFileName, $qrCodeImage);

        // Upload foto barang jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('barang', 'public');
        }

        // Simpan data barang
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'jenis' => $request->jenis,
            'kondisi' => $request->kondisi,
            'kode_inventaris' => $kodeInventaris,
            'tahun_pengadaan' => $request->tahun_pengadaan,
            'foto' => $fotoPath,
            'qr_code' => 'qrcodes/' . $qrCodeFileName,
            'divisi_id' => $request->divisi_id,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan dengan QR code.');
    }

    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'kondisi' => 'required|string|max:100',
            'tahun_pengadaan' => 'required|digits:4|integer',
            'foto' => 'nullable|image|max:2048',
            'divisi_id' => 'nullable|integer',
        ]);

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($barang->foto) {
                Storage::disk('public')->delete($barang->foto);
            }
            $fotoPath = $request->file('foto')->store('barang', 'public');
            $barang->foto = $fotoPath;
        }

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'jenis' => $request->jenis,
            'kondisi' => $request->kondisi,
            'tahun_pengadaan' => $request->tahun_pengadaan,
            'divisi_id' => $request->divisi_id,
        ]);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang)
    {
        // Hapus foto dan QR code dari storage
        if ($barang->foto) {
            Storage::disk('public')->delete($barang->foto);
        }
        if ($barang->qr_code) {
            Storage::disk('public')->delete($barang->qr_code);
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}