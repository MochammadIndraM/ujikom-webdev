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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('nota')->unique();
            $table->date('tanggal_nota');
            $table->string('kode_pelanggan');
            $table->string('diskon')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('kode_pelanggan')
                ->references('kode_pelanggan')
                ->on('data_pelanggan')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('diskon')
                ->references('diskon')
                ->on('diskon')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
