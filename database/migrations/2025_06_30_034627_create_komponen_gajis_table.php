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
    {Schema::create('komponen_gajis', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->enum('tipe', ['pendapatan', 'potongan']);
        $table->decimal('default_nilai', 12, 2)->default(0);
        $table->timestamps();
    });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komponen_gajis');
    }
};
