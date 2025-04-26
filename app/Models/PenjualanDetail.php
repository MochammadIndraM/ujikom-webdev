<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;

    protected $table = 'penjualan_detail'; // Nama tabel
    protected $fillable = [
        'nota',
        'kode_obat',
        'jumlah',
        'harga',
        'subtotal',
    ];


    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    public function obat()
    {
        return $this->belongsTo(DataObat::class, 'kode_obat', 'kode_obat');
    }
}
