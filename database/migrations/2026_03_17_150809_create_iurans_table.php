<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('iurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('warga_id')->constrained()->onDelete('cascade');
            $table->string('bulan');
            $table->year('tahun');
            $table->decimal('jumlah', 10, 2);
            $table->date('tanggal_bayar')->nullable();
            $table->enum('status', ['lunas', 'pending', 'batal'])->default('pending');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('iurans');
    }
};