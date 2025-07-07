<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('laporan_produksi_vendors', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('vendor_id')->nullable()->constrained()->onDelete('set null'); // gak dipakai di controller
            $table->date('tanggal');
            $table->enum('bahan_baku', ['kayu', 'sekam', 'mixing']);
            $table->decimal('qty_bahan_baku', 10, 2)->nullable();
            $table->decimal('mesin_1', 10, 2)->nullable();
            $table->decimal('mesin_2', 10, 2)->nullable();
            $table->decimal('mesin_3', 10, 2)->nullable();
            $table->decimal('mesin_besar', 10, 2)->nullable();
            $table->decimal('total_produksi', 10, 2)->default(0);
            $table->decimal('tercapai', 10, 2)->default(0);
            $table->decimal('belum_tercapai', 10, 2)->default(0);            
            $table->string('waktu_kerja_tim')->nullable();
            $table->decimal('hasil_jadi', 10, 2)->nullable();
            $table->decimal('hasil_cacat', 10, 2)->nullable();
            $table->text('catatan')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->decimal('target_harian', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_produksi_vendors');
    }
};
