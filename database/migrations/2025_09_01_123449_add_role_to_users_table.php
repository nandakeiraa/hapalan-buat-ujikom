<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Pakai enum bila MySQL mendukung, fallback ke string jika perlu
            if (Schema::hasColumn('users', 'role') === false) {
                $table->enum('role', ['admin', 'petugas', 'divisi'])
                      ->default('divisi')
                      ->after('email'); // letakkan setelah email, bebas
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};
