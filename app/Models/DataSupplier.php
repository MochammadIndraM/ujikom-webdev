<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSupplier extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi Laravel
    protected $table = 'data_supplier';
    // Tentukan primary key
    protected $primaryKey = 'kode_supplier';
    public $incrementing = false; // Karena kode_supplier bukan auto increment

    // Tentukan kolom yang dapat diisi

    protected $guarded = [''];



    // Tentukan jika menggunakan timestamps
    public $timestamps = true;

    public function obat()
    {
        return $this->hasMany(DataObat::class, 'kode_supplier', 'kode_supplier');
    }
}
