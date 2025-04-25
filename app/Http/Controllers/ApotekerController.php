<?php

namespace App\Http\Controllers;

use App\Models\DataApoteker;
use Illuminate\Http\Request;

class ApotekerController extends Controller
{
    public function index()
    {
        // Ambil semua data apoteker
        $apotekers = DataApoteker::all();

        // Ambil apoteker terakhir berdasarkan kode
        $lastApoteker = DataApoteker::orderBy('kode_apoteker', 'desc')->first();

        // Generate kode apoteker berikutnya
        if ($lastApoteker) {
            $lastKode = substr($lastApoteker->kode_apoteker, 3); // ambil angka belakang, contoh '003'
            $nextKode = 'APT' . str_pad((int)$lastKode + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextKode = 'APT001';
        }

        // Kirim data ke view
        return view('master-data.data-apoteker', compact('apotekers', 'nextKode'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'kode_apoteker' => 'required|string|max:10|unique:data_apoteker,kode_apoteker',
            'nama_apoteker' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'telpon' => 'required|string|max:15',
        ]);

        // Menyimpan data apoteker ke database
        DataApoteker::create([
            'kode_apoteker' => $request->kode_apoteker,
            'nama_apoteker' => $request->nama_apoteker,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'telpon' => $request->telpon,
        ]);

        // Menyimpan session flash untuk pesan sukses
        return redirect()->route('admin.data-apoteker')->with('success', 'Data Apoteker berhasil ditambahkan!');
    }

    public function update(Request $request, $kode_apoteker)
    {
        // Cari data berdasarkan kode_apoteker, bukan id
        $apoteker = DataApoteker::where('kode_apoteker', $kode_apoteker)->firstOrFail();

        // Update data apoteker
        $apoteker->update($request->all());

        return redirect()->route('admin.data-apoteker')->with('success', 'Data apoteker berhasil diperbarui.');
    }

    public function destroy($kode_apoteker)
    {
        // Cari data berdasarkan kode_apoteker
        $apoteker = DataApoteker::where('kode_apoteker', $kode_apoteker)->firstOrFail();

        // Hapus data apoteker
        $apoteker->delete();

        return redirect()->route('admin.data-apoteker')->with('success', 'Data apoteker berhasil dihapus.');
    }
}
