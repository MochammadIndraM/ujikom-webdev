<?php

namespace App\Http\Controllers;

use App\Models\DataSupplier;
use App\Models\DataObat;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        // Ambil semua data supplier dan obat
        $suppliers = DataSupplier::all();
        $obats = DataObat::all();
        $lastnote = Penjualan::orderBy('nota', 'desc')->first();

        // Generate kode penjualan berikutnya
        if ($lastnote) {
            $lastKode = substr($lastnote->nota, 3); // ambil angka belakang, contoh '003'
            $nextKode = 'PJ' . str_pad((int)$lastKode + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextKode = 'PJ001';
        }

        // Kirim data ke view
        return view('transaksi.penjualan', [
            'suppliers' => $suppliers,
            'obats' => $obats,
            'lastKode' => $nextKode,
        ]);
    }

    public function getObatBySupplier($supplierId)
    {
        // Ambil data obat berdasarkan kode_supplier
        $obats = DataObat::where('kode_supplier', $supplierId)->get();

        // Kembalikan data dalam format JSON
        return response()->json($obats);
    }
    public function simpan(Request $request)
    {
        // Validasi input
        // dd($request->all());
        $request->validate([
            'nota' => 'required|string',
            'tanggal_nota' => 'required|date_format:d/m/Y',
            'kode_obat' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0',
            'harga' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0',  // Menambahkan validasi untuk diskon jika ada
        ]);

        // Ambil kode_supplier dari tabel data_obat berdasarkan kode_obat
        $dataObat = DataObat::where('kode_obat', $request->kode_obat)->first();

        if (!$dataObat) {
            return redirect()->back()->withErrors(['kode_obat' => 'Obat tidak ditemukan!']);
        }

        $kodeSupplier = $dataObat->kode_supplier;


        // Simpan data ke tabel penjualan
        Penjualan::create([
            'nota' => $request->nota,
            'tanggal_nota' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->tanggal_nota)->format('Y-m-d'),
            'kode_supplier' => $kodeSupplier, // Ambil dari database
            'diskon' => $request->diskon ?? null, // Menambahkan pengecekan untuk nilai diskon
        ]);
        // Simpan data ke tabel penjualan_detail
        PenjualanDetail::create([
            'nota' => $request->nota,
            'kode_obat' => $request->kode_obat,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'subtotal' => $request->subtotal,
        ]);

        DataObat::where('kode_obat', $request->kode_obat)->update([
            'stok' => DB::raw('stok -' . $request->jumlah),
        ]);
        return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil disimpan!');
    }

    public function show()
    {
        // Mengambil semua data penjualan beserta relasi supplier dan penjualan_detail
        $penjualans = Penjualan::all();
        $details = PenjualanDetail::all();

        // Mengirim data ke view
        return view('riwayat.penjualan', compact('penjualans', 'details'));
    }
}
