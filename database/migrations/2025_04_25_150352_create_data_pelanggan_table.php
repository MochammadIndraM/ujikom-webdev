<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPelangganTable extends Migration
{
    public function up(): void
    {
        Schema::create('data_pelanggan', function (Blueprint $table) {
            $table->string('kode_pelanggan')->primary(); // Primary key
            $table->string('nama_pelanggan');
            $table->string('alamat');
            $table->string('kota');
            $table->string('telpon');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_pelanggan');
    }
}
