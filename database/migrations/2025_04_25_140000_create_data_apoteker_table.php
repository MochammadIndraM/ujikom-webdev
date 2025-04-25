<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataApotekerTable extends Migration
{
    public function up(): void
    {
        Schema::create('data_apoteker', function (Blueprint $table) {
            $table->string('kode_apoteker')->primary(); // Primary key
            $table->string('nama_apoteker');
            $table->string('alamat');
            $table->string('kota');
            $table->string('telpon');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_apoteker');
    }
}
