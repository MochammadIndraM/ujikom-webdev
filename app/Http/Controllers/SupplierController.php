<?php

namespace App\Http\Controllers;

use App\Models\DataSupplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        // Mengambil semua data supplier dari database
        $suppliers = DataSupplier::all();

        // Ambil kode supplier terakhir
        $lastSupplier = DataSupplier::orderBy('kode_supplier', 'desc')->first();

        // Menghitung kode supplier berikutnya
        if ($lastSupplier) {
            // Ambil angka terakhir dari kode supplier, misalnya SUP003 -> 003
            $lastKode = substr($lastSupplier->kode_supplier, 3);
            $nextKode = 'SUP' . str_pad((int)$lastKode + 1, 3, '0', STR_PAD_LEFT); // Tambahkan 1 dan format menjadi SUP004
        } else {
            $nextKode = 'SUP001'; // Jika tidak ada data, mulai dari SUP001
        }

        // Mengirim data ke view
        return view('master-data.data-supplier', compact('suppliers', 'nextKode'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'kode_supplier' => 'required|string|max:10|unique:data_supplier,kode_supplier',
            'nama_supplier' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'telpon' => 'required|string|max:15',
        ]);

        // Menyimpan data supplier ke database
        DataSupplier::create([
            'kode_supplier' => $request->kode_supplier,
            'nama_supplier' => $request->nama_supplier,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'telpon' => $request->telpon,
        ]);

        // Menyimpan session flash untuk pesan sukses
        return redirect()->route('admin.data-supplier')->with('success', 'Data Supplier berhasil ditambahkan!');
    }

    public function update(Request $request, $kode_supplier)
    {
        // Cari data berdasarkan kode_supplier, bukan id
        $supplier = DataSupplier::where('kode_supplier', $kode_supplier)->firstOrFail();

        // Update data supplier
        $supplier->update($request->all());

        return redirect()->route('admin.data-supplier')->with('success', 'Data supplier berhasil diperbarui.');
    }

    public function destroy($kode_supplier)
    {
        // Cari data berdasarkan kode_supplier
        $supplier = DataSupplier::where('kode_supplier', $kode_supplier)->firstOrFail();

        // Hapus data supplier
        $supplier->delete();

        return redirect()->route('admin.data-supplier')->with('success', 'Data supplier berhasil dihapus.');
    }
}
