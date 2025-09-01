<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    use HasFactory;

    protected $table = 'distribusi';

    protected $fillable = [
        'barang_id',
        'tanggal_distribusi',
        'jumlah',
        'divisi_id',
        'keterangan_kondisi_awal',
        'petugas_id',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}