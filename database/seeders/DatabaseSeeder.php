<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat user admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),  // Menggunakan bcrypt untuk enkripsi password
        ]);

        // Menambahkan data supplier terlebih dahulu
        DB::table('data_supplier')->insert([ // Ganti 'suppliers' dengan 'data_supplier'
            [
                'kode_supplier' => 'SUP001',
                'nama_supplier' => 'PT Kimia Farma',
                'alamat' => 'Jl. Kimia Farma No. 1, Jakarta',
                'kota' => 'Jakarta',
                'telpon' => '021-12345678',
            ],
            [
                'kode_supplier' => 'SUP002',
                'nama_supplier' => 'PT Indofarma',
                'alamat' => 'Jl. Indofarma No. 2, Bandung',
                'kota' => 'Bandung',
                'telpon' => '022-23456789',
            ],
            [
                'kode_supplier' => 'SUP003',
                'nama_supplier' => 'PT Dexa Medica',
                'alamat' => 'Jl. Dexa Medica No. 3, Surabaya',
                'kota' => 'Surabaya',
                'telpon' => '031-34567890',
            ],
            // Tambahkan supplier lainnya sesuai kebutuhan
        ]);

        // Menambahkan data obat setelah supplier tersedia
        DB::table('data_obat')->insert([
            [
                'kode_obat' => 'O001',
                'nama_obat' => 'Bodrexin',
                'jenis' => 'Obat Bebas',
                'satuan' => 'Tablet',
                'harga_beli' => 5000,
                'harga_jual' => 10000,
                'stok' => 100,
                'kode_supplier' => 'SUP001', // Relasi dengan supplier Kimia Farma
            ],
            [
                'kode_obat' => 'O002',
                'nama_obat' => 'Paracetamol',
                'jenis' => 'Obat Bebas',
                'satuan' => 'Tablet',
                'harga_beli' => 3000,
                'harga_jual' => 6000,
                'stok' => 200,
                'kode_supplier' => 'SUP002', // Relasi dengan supplier Indofarma
            ],
            [
                'kode_obat' => 'O003',
                'nama_obat' => 'Amoxicillin',
                'jenis' => 'Obat Resep',
                'satuan' => 'Kapsul',
                'harga_beli' => 7000,
                'harga_jual' => 14000,
                'stok' => 50,
                'kode_supplier' => 'SUP003', // Relasi dengan supplier Dexa Medica
            ],
            // Tambahkan obat lainnya sesuai kebutuhan
        ]);
    }
}
