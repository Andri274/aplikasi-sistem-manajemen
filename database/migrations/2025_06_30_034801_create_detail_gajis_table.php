<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailGajisTable extends Migration
{
    public function up(): void
    {
        Schema::create('detail_gajis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slip_gaji_id')->constrained()->onDelete('cascade');
            $table->string('nama_komponen');
            $table->decimal('nilai', 15, 2)->default(0);
            $table->string('keterangan')->nullable();
            $table->enum('tipe', ['pendapatan', 'potongan'])->default('pendapatan');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_gajis');
    }
}
