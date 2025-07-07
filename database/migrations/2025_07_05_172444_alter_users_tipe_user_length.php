<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('tipe_user', 50)->change();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('tipe_user', 10)->change(); // revert ke 10 kalau rollback
    });
}

};
