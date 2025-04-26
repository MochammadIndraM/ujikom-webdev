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
        Schema::create('pembelian_detail', function (Blueprint $table) {
            $table->id();
            $table->string('nota');
            $table->string('kode_obat');
            $table->integer('jumlah');
            $table->decimal('harga', 10, 2); // Tambahkan kolom harga
            $table->decimal('subtotal', 10, 2); // Tambahkan kolom subtotal
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('nota')
                ->references('nota')
                ->on('pembelian')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('kode_obat')
                ->references('kode_obat')
                ->on('data_obat')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian_detail');
    }
};
