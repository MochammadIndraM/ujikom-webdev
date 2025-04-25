<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataObat extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi Laravel
    protected $table = 'data_obat';
    // Tentukan primary key
    protected $primaryKey = 'kode_obat';
    public $incrementing = false; // Karena kode_supplier bukan auto increment

    // Tentukan kolom yang dapat diisi

    protected $guarded = [''];



    // Tentukan jika menggunakan timestamps
    public $timestamps = true;

    public function supplier()
    {
        return $this->belongsTo(DataSupplier::class, 'kode_supplier', 'kode_supplier');
    }

    // Fungsi untuk mendapatkan nilai enum 'jenis'
    public static function getJenisEnumValues()
    {
        return ['Obat Generik', 'Obat Resep', 'Obat Herbal'];
    }

    // Fungsi untuk mendapatkan nilai enum 'satuan'
    public static function getSatuanEnumValues()
    {
        return ['Tablet', 'Kapsul', 'Botol', 'Tube', 'Syrup'];
    }
}
