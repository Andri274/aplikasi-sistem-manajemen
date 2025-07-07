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
        Schema::create('slip_gajis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained()->onDelete('cascade');
            $table->date('periode_mulai');
            $table->date('periode_selesai');
            $table->decimal('total_pendapatan', 12, 2)->default(0);
            $table->decimal('total_potongan', 12, 2)->default(0);
            $table->decimal('total_bersih', 12, 2)->default(0);
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slip_gajis');
    }
};
