<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        // Ambil semua data pelanggan
        $pelanggans = DataPelanggan::all();

        // Ambil pelanggan terakhir berdasarkan kode
        $lastPelanggan = DataPelanggan::orderBy('kode_pelanggan', 'desc')->first();

        // Generate kode pelanggan berikutnya
        if ($lastPelanggan) {
            $lastKode = substr($lastPelanggan->kode_pelanggan, 3); // ambil angka belakang, contoh '003'
            $nextKode = 'PLG' . str_pad((int)$lastKode + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextKode = 'PLG001';
        }

        // Kirim data ke view
        return view('master-data.data-pelanggan', compact('pelanggans', 'nextKode'));
    }

    public function showRegistrationForm()
    {
        // Ambil pelanggan terakhir berdasarkan kode
        $lastPelanggan = DataPelanggan::orderBy('kode_pelanggan', 'desc')->first();

        // Generate kode pelanggan berikutnya
        if ($lastPelanggan) {
            $lastKode = substr($lastPelanggan->kode_pelanggan, 3); // ambil angka belakang, contoh '003'
            $nextKode = 'PLG' . str_pad((int)$lastKode + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextKode = 'PLG001';
        }

        // Kirim kode pelanggan ke view form registrasi
        return view('auth.register', compact('nextKode'));
    }


    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'kode_pelanggan' => 'required|string|max:10|unique:data_pelanggan,kode_pelanggan',
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'telpon' => 'required|string|max:15',
        ]);

        // Menyimpan data pelanggan ke database
        DataPelanggan::create([
            'kode_pelanggan' => $request->kode_pelanggan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'telpon' => $request->telpon,
        ]);

        // Menyimpan session flash untuk pesan sukses
        return redirect()->route('admin.data-pelanggan')->with('success', 'Data Pelanggan berhasil ditambahkan!');
    }

    public function update(Request $request, $kode_pelanggan)
    {
        // Cari data berdasarkan kode_pelanggan, bukan id
        $pelanggan = DataPelanggan::where('kode_pelanggan', $kode_pelanggan)->firstOrFail();

        // Update data pelanggan
        $pelanggan->update($request->all());

        return redirect()->route('admin.data-pelanggan')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function destroy($kode_pelanggan)
    {
        // Cari data berdasarkan kode_pelanggan
        $pelanggan = DataPelanggan::where('kode_pelanggan', $kode_pelanggan)->firstOrFail();

        // Hapus data pelanggan
        $pelanggan->delete();

        return redirect()->route('admin.data-pelanggan')->with('success', 'Data pelanggan berhasil dihapus.');
    }
}
