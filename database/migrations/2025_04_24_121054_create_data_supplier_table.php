<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSupplierTable extends Migration
{
    public function up(): void
    {
        Schema::create('data_supplier', function (Blueprint $table) {
            $table->string('kode_supplier')->primary(); // Primary key
            $table->string('nama_supplier');
            $table->string('alamat');
            $table->string('kota');
            $table->string('telpon');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_supplier');
    }
}
