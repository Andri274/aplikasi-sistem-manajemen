<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanProduksiWoodpelletTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_produksi_woodpellet', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('penanggung_jawab', 100)->nullable();
            $table->integer('bahan_baku')->default(0);
            $table->integer('mesin_1')->default(0);
            $table->integer('mesin_2')->default(0);
            $table->integer('mesin_3')->default(0);
            $table->integer('mesin_besar')->default(0);
            $table->integer('hasil_produksi')->default(0);
            $table->integer('target_capaian')->default(16000);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_produksi_woodpellet');
    }
}
