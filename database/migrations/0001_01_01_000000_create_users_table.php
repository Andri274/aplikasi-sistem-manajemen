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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            
            // Tambahin dua metode login
            $table->string('email')->index()->nullable();  // Untuk vendor
            $table->string('no_hp')->index()->nullable();  // Untuk internal
        
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
        
            // Tambahin role user
            $table->enum('tipe_user', ['internal_hbl', 'vendor', 'freelance'])->default('vendor');
        
            $table->rememberToken();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};