<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('jenis');
            $table->string('kondisi');
            $table->string('kode_inventaris')->unique();
            $table->year('tahun_pengadaan');
            $table->string('foto')->nullable();
            $table->string('qr_code')->unique();
            $table->unsignedBigInteger('divisi_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('barang');
    }
}