<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataObatTable extends Migration
{
    public function up(): void
    {
        Schema::create('data_obat', function (Blueprint $table) {
            $table->string('kode_obat')->primary(); // Primary key
            $table->string('nama_obat');
            $table->string('jenis');
            $table->string('satuan');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->integer('stok');
            // Pastikan foreign key merujuk ke kolom 'kode_supplier' yang ada di tabel 'data_supplier'
            $table->string('kode_supplier'); // Gunakan tipe data yang sama seperti di tabel data_supplier
            $table->foreign('kode_supplier')
                ->references('kode_supplier')
                ->on('data_supplier')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_obat');
    }
}
