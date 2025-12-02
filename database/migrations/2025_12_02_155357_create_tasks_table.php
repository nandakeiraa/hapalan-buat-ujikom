<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(table: 'tasks', callback: function (Blueprint $table): void {
            $table->id();
            $table->string(column: 'name'); // nama tugas
            $table->boolean(column: 'status')->default(value: false); // status tugas
            $table->integer(colomn: 'priority')->default(value: 3); // priority low/medium/high
            $table->date(column: 'due_date')->nullable(); // tanggal tugas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
