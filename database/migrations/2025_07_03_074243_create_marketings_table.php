<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('marketings', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama_customer')->nullable();
            $table->string('nama_komoditi')->nullable();
            $table->float('budget')->nullable();
            $table->integer('qty')->nullable();
            $table->string('source')->nullable();
            $table->float('price_source')->nullable();
            $table->string('tracking')->nullable();
            $table->string('payment_of_terms')->nullable();
            $table->float('margin')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marketings');
    }
};