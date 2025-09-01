<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'nama_barang',
        'jenis',
        'kondisi',
        'kode_inventaris',
        'tahun_pengadaan',
        'foto',
        'qr_code',
        'divisi_id',
    ];

    // Relasi ke divisi (jika ada model Divisi)
    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}