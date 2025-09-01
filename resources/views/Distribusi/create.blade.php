@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Distribusi Barang</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('distribusi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="barang_id" class="form-label">Barang</label>
            <select name="barang_id" id="barang_id" class="form-control" required>
                <option value="">-- Pilih Barang --</option>
                @foreach($barang as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_barang }} ({{ $item->kode_inventaris }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal_distribusi" class="form-label">Tanggal Distribusi</label>
            <input type="date" name="tanggal_distribusi" id="tanggal_distribusi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label for="divisi_id" class="form-label">Divisi Tujuan</label>
            <select name="divisi_id" id="divisi_id" class="form-control" required>
                <option value="">-- Pilih Divisi --</option>
                @foreach($divisi as $d)
                    <option value="{{ $d->id }}">{{ $d->nama_divisi }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="keterangan_kondisi_awal" class="form-label">Keterangan Kondisi Awal</label>
            <input type="text" name="keterangan_kondisi_awal" id="keterangan_kondisi_awal" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Distribusi</button>
    </form>
</div>
@endsection