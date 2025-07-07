<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pembelian_bahan_bakus', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama_bahan');
            $table->float('jumlah');
            $table->string('satuan');
            $table->integer('harga_satuan');
            $table->integer('total_harga');
            $table->string('supplier');
            $table->string('no_faktur')->nullable();
            $table->string('bukti_file')->nullable(); // path file
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembelian_bahan_bakus');
    }
};
