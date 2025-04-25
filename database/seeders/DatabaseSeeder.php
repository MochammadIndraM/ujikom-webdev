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
            'role' => 'admin',  // Menambahkan role admin
        ]);
        User::factory()->create([
            'name' => 'Apoteker',
            'email' => 'apoteker@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'apoteker',  // Menambahkan role apoteker
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
            [
                'kode_supplier' => 'SUP004',
                'nama_supplier' => 'PT Phapros Tbk',
                'alamat' => 'Jl. Simongan No. 131, Semarang',
                'kota' => 'Semarang',
                'telpon' => '024-7600000',
            ],
            [
                'kode_supplier' => 'SUP005',
                'nama_supplier' => 'PT Kalbe Farma Tbk',
                'alamat' => 'Jl. Let. Jend. Suprapto Kav. 4, Jakarta',
                'kota' => 'Jakarta',
                'telpon' => '021-4221255',
            ],
            [
                'kode_supplier' => 'SUP006',
                'nama_supplier' => 'PT Sanbe Farma',
                'alamat' => 'Jl. Industri Cimareme No. 8, Padalarang',
                'kota' => 'Bandung',
                'telpon' => '022-6865767',
            ],
            [
                'kode_supplier' => 'SUP007',
                'nama_supplier' => 'PT Soho Global Health',
                'alamat' => 'Jl. Rawa Bali I No. 3, Jakarta',
                'kota' => 'Jakarta',
                'telpon' => '021-46828188',
            ],
            [
                'kode_supplier' => 'SUP008',
                'nama_supplier' => 'PT Bernofarm',
                'alamat' => 'Jl. Raya Taman No. 11, Sidoarjo',
                'kota' => 'Sidoarjo',
                'telpon' => '031-7882000',
            ],

            // Tambahkan supplier lainnya sesuai kebutuhan
        ]);

        // Menambahkan data obat setelah supplier tersedia
        DB::table('data_obat')->insert([
            [
                'kode_obat' => 'OB001',
                'nama_obat' => 'Bodrexin',
                'jenis' => 'Obat Generik',
                'satuan' => 'Tablet', // Sesuaikan dengan enum satuan
                'harga_beli' => 5000,
                'harga_jual' => 10000,
                'stok' => 100,
                'kode_supplier' => 'SUP001',
            ],
            [
                'kode_obat' => 'OB002',
                'nama_obat' => 'Paracetamol',
                'jenis' => 'Obat Generik',
                'satuan' => 'Tablet', // Sesuaikan dengan enum satuan
                'harga_beli' => 3000,
                'harga_jual' => 6000,
                'stok' => 200,
                'kode_supplier' => 'SUP002',
            ],
            [
                'kode_obat' => 'OB003',
                'nama_obat' => 'Amoxicillin',
                'jenis' => 'Obat Resep',
                'satuan' => 'Kapsul', // Sesuaikan dengan enum satuan
                'harga_beli' => 7000,
                'harga_jual' => 14000,
                'stok' => 50,
                'kode_supplier' => 'SUP003',
            ],
            [
                'kode_obat' => 'OB004',
                'nama_obat' => 'Sanmol Syrup',
                'jenis' => 'Obat Generik',
                'satuan' => 'Syrup', // Sesuaikan dengan enum satuan
                'harga_beli' => 8500,
                'harga_jual' => 16000,
                'stok' => 75,
                'kode_supplier' => 'SUP004',
            ],
            [
                'kode_obat' => 'OB005',
                'nama_obat' => 'Kalpanax',
                'jenis' => 'Obat Generik',
                'satuan' => 'Tube', // Sesuaikan dengan enum satuan
                'harga_beli' => 6500,
                'harga_jual' => 12000,
                'stok' => 90,
                'kode_supplier' => 'SUP005',
            ],
            [
                'kode_obat' => 'OB006',
                'nama_obat' => 'Promag',
                'jenis' => 'Obat Generik',
                'satuan' => 'Tablet', // Sesuaikan dengan enum satuan
                'harga_beli' => 4000,
                'harga_jual' => 8000,
                'stok' => 180,
                'kode_supplier' => 'SUP006',
            ],
            [
                'kode_obat' => 'OB007',
                'nama_obat' => 'Bisolvon',
                'jenis' => 'Obat Resep',
                'satuan' => 'Botol', // Sesuaikan dengan enum satuan
                'harga_beli' => 12000,
                'harga_jual' => 20000,
                'stok' => 60,
                'kode_supplier' => 'SUP007',
            ],
            [
                'kode_obat' => 'OB008',
                'nama_obat' => 'Neurobion',
                'jenis' => 'Obat Resep',
                'satuan' => 'Tablet', // Sesuaikan dengan enum satuan
                'harga_beli' => 9500,
                'harga_jual' => 18000,
                'stok' => 40,
                'kode_supplier' => 'SUP008',
            ],
        ]);


        DB::table('data_pelanggan')->insert([
            [
                'kode_pelanggan' => 'PLG001',
                'nama_pelanggan' => 'Ahmad Fauzi',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'kota' => 'Jakarta',
                'telpon' => '0812-1111-2222',
            ],
            [
                'kode_pelanggan' => 'PLG002',
                'nama_pelanggan' => 'Siti Nurhaliza',
                'alamat' => 'Jl. Soekarno Hatta No. 15, Bandung',
                'kota' => 'Bandung',
                'telpon' => '0813-3333-4444',
            ],
            [
                'kode_pelanggan' => 'PLG003',
                'nama_pelanggan' => 'Budi Santoso',
                'alamat' => 'Jl. Pemuda No. 20, Surabaya',
                'kota' => 'Surabaya',
                'telpon' => '0812-5555-6666',
            ],
            [
                'kode_pelanggan' => 'PLG004',
                'nama_pelanggan' => 'Dewi Anggraini',
                'alamat' => 'Jl. Diponegoro No. 8, Yogyakarta',
                'kota' => 'Yogyakarta',
                'telpon' => '0813-7777-8888',
            ],
            [
                'kode_pelanggan' => 'PLG005',
                'nama_pelanggan' => 'Rizky Maulana',
                'alamat' => 'Jl. Gatot Subroto No. 5, Medan',
                'kota' => 'Medan',
                'telpon' => '0812-9999-0000',
            ],
        ]);
        DB::table('data_apoteker')->insert([
            [
                'kode_apoteker' => 'APT001',
                'nama_apoteker' => 'dr. Fitriani',
                'alamat' => 'Jl. Kesehatan No. 1, Jakarta',
                'kota' => 'Jakarta',
                'telpon' => '0812-1234-5678',
            ],
            [
                'kode_apoteker' => 'APT002',
                'nama_apoteker' => 'dr. Hendro Prasetyo',
                'alamat' => 'Jl. Sehat No. 22, Surabaya',
                'kota' => 'Surabaya',
                'telpon' => '0813-9876-5432',
            ],
            [
                'kode_apoteker' => 'APT003',
                'nama_apoteker' => 'dr. Lestari Wijaya',
                'alamat' => 'Jl. Farmasi No. 18, Bandung',
                'kota' => 'Bandung',
                'telpon' => '0812-4567-8910',
            ],
            [
                'kode_apoteker' => 'APT004',
                'nama_apoteker' => 'dr. Rahmat Hidayat',
                'alamat' => 'Jl. Apotik No. 5, Yogyakarta',
                'kota' => 'Yogyakarta',
                'telpon' => '0813-1122-3344',
            ],
        ]);
    }
}
