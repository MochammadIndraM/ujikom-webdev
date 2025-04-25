<?php

namespace App\Http\Controllers;

use App\Models\DataObat;
use App\Models\DataSupplier;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        // Mengambil semua data obat
        $obat = DataObat::all();

        // Mengambil semua data supplier untuk select option
        $suppliers = DataSupplier::all();

        // Ambil kode obat terakhir
        $lastObat = DataObat::orderBy('kode_obat', 'desc')->first();

        // Menghitung kode obat berikutnya
        if ($lastObat) {
            $lastKode = substr($lastObat->kode_obat, 2, 3);
            $nextKode = 'OB' . str_pad((int)$lastKode + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextKode = 'OB001';
        }

        // Mengirim data ke view
        return view('master-data.data-obat', compact('obat', 'nextKode', 'suppliers'));
    }

    public function showIndex()
    {
        // Mengambil semua data obat
        $obat = DataObat::all(); // Ensure the correct namespace for the model

        // Mengirim data ke view
        return view('index', compact('obat'));
    }



    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'kode_obat' => 'required|string|max:10|unique:data_obat,kode_obat',
            'nama_obat' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kode_supplier' => 'required|string|max:10|exists:data_supplier,kode_supplier', // Pastikan kode_supplier valid
        ]);

        // Menyimpan data obat ke database
        DataObat::create([
            'kode_obat' => $request->kode_obat,
            'nama_obat' => $request->nama_obat,
            'jenis' => $request->jenis,
            'satuan' => $request->satuan,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'kode_supplier' => $request->kode_supplier, // Relasi dengan supplier
        ]);

        // Menyimpan session flash untuk pesan sukses
        return redirect()->route('admin.data-obat')->with('success', 'Data Obat berhasil ditambahkan!');
    }

    public function update(Request $request, $kode_obat)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kode_supplier' => 'required|string|max:10|exists:data_supplier,kode_supplier', // Pastikan kode_supplier valid
        ]);

        // Cari data berdasarkan kode_obat
        $obat = DataObat::where('kode_obat', $kode_obat)->firstOrFail();

        // Update data obat
        $obat->update($request->all());

        return redirect()->route('admin.data-obat')->with('success', 'Data obat berhasil diperbarui.');
    }


    public function destroy($kode_obat)
    {
        // Cari data berdasarkan kode_obat
        $obat = DataObat::where('kode_obat', $kode_obat)->firstOrFail();

        // Hapus data obat
        $obat->delete();

        return redirect()->route('admin.data-obat')->with('success', 'Data obat berhasil dihapus.');
    }
}
