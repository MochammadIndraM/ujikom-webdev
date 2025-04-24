@extends('layouts.app')
@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Penjualan Obat</h3>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-body">

                    <!-- Informasi Nota dan Tanggal -->
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Nota: <strong>PJ001</strong></h6>
                            <h6 class="mb-0">Tanggal: <strong>24/04/2025</strong></h6>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <select class="form-select" id="pelangganSelect" name="pelanggan_id" style="width: 200px;">
                                <option selected disabled>Pilih Pelanggan</option>
                                <option value="1">Andi Saputra</option>
                                <option value="2">Siti Aminah</option>
                                <option value="3">Budi Santoso</option>
                                <!-- Tambahkan pelanggan lainnya sesuai kebutuhan -->
                            </select>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalBeliObat">
                                Pilih Obat
                            </button>
                        </div>

                    </div>

                    <!-- Tabel Data Obat yang Dijual -->
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Pelanggan</th>
                                <th>Nama Obat</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Andi Saputra</td>
                                <td>Bodrexin</td>
                                <td>5</td>
                                <td>10.000</td>
                                <td>
                                    <form action="#" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Ringkasan Penjualan -->
                    <div class="mt-4 d-flex justify-content-end">
                        <div class="card p-3" style="width: 300px;">
                            <!-- Diskon Input -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span>Diskon:</span>
                                <input type="number" id="inputDiskon" class="form-control w-50 ms-2" value="0"
                                    oninput="updateGrandTotal()" />
                            </div>

                            <!-- Grand Total -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span>Grand Total:</span>
                                <strong id="grandTotal">Rp 45.000</strong>
                            </div>

                            <!-- Tombol Bayar -->
                            <button type="button" class="btn btn-success w-100">
                                <i class="bi bi-cash-coin me-1"></i> Bayar
                            </button>
                        </div>
                    </div>



                </div>


            </div>

        </section>
    </div>

    <div class="modal fade" id="modalBeliObat" tabindex="-1" aria-labelledby="modalBeliObatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg "> <!-- modal-lg biar lebar -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBeliObatLabel">Pilih Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="/data-obat" method="POST">
                    @csrf
                    <div class="modal-body row g-3">
                        <div class="col-md-12">
                            <label for="nama" class="form-label">Nama Obat</label>
                            <select class="form-select" id="nama" name="nama" required>
                                <option value="" disabled selected>-- Pilih Obat --</option>
                                <option value="Paracetamol">Paracetamol</option>
                                <option value="Amoxicillin">Amoxicillin</option>
                                <option value="Bodrex">Bodrex</option>
                                <option value="Antalgin">Antalgin</option>
                                <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="nama" class="form-label">Jumlah</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateGrandTotal() {
            // Ambil harga dan diskon
            let harga = 50000; // Ganti dengan harga total pembelian
            let diskon = document.getElementById('inputDiskon').value;

            // Hitung grand total setelah diskon
            let grandTotal = harga - diskon;

            // Update grand total pada halaman
            document.getElementById('grandTotal').textContent = 'Rp ' + grandTotal.toLocaleString();
        }

        // Panggil fungsi untuk set grand total awal
        updateGrandTotal();
    </script>
@endsection
