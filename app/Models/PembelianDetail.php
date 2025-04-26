<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    use HasFactory;

    protected $table = 'pembelian_detail'; // Nama tabel
    protected $fillable = [
        'nota',
        'kode_obat',
        'jumlah',
        'harga',
        'subtotal',
    ];
    

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }

    public function obat()
    {
        return $this->belongsTo(DataObat::class, 'kode_obat', 'kode_obat');
    }
}
