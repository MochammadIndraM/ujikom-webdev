<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian'; // Nama tabel
    protected $fillable = ['nota', 'tanggal_nota', 'kode_supplier', 'kode_apoteker', 'diskon'];

    public function supplier()
    {
        return $this->belongsTo(DataSupplier::class, 'kode_supplier', 'kode_supplier');
    }
    public function details()
    {
        return $this->hasMany(PembelianDetail::class);
    }
}
