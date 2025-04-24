@extends('layouts.app')
@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Data Obat</h3>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Data Obat</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahObat">
                        Tambah Data
                    </button>
                </div>

                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Kode Obat</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Satuan</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Supplier</th>
                                <th>Aksi</th>


                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>OBT001</td>
                                <td>Bodrexin</td>
                                <td>Pil</td>
                                <td>Pcs</td>
                                <td>10000</td>
                                <td>12000</td>
                                <td>50</td>
                                <td>Kimia Farma</td>

                                <td>
                                    <a href="#" class="btn btn-sm btn-warning me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

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
                </div>
            </div>

        </section>
    </div>

    <div class="modal fade" id="modalTambahObat" tabindex="-1" aria-labelledby="modalTambahObatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg "> <!-- modal-lg biar lebar -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahObatLabel">Tambah Data Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="/data-obat" method="POST">
                    @csrf
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label for="kode_obat" class="form-label">Kode Obat</label>
                            <input type="text" class="form-control" id="kode_obat" name="kode_obat" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="col-md-6">
                            <label for="jenis" class="form-label">Jenis</label>
                            <input type="text" class="form-control" id="jenis" name="jenis">
                        </div>
                        <div class="col-md-6">
                            <label for="satuan" class="form-label">Satuan</label>
                            <input type="text" class="form-control" id="satuan" name="satuan">
                        </div>
                        <div class="col-md-6">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
                        </div>
                        <div class="col-md-6">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
                        </div>
                        <div class="col-md-6">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok">
                        </div>
                        <div class="col-md-6">
                            <label for="supplier" class="form-label">Supplier</label>
                            <input type="text" class="form-control" id="supplier" name="supplier">
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
@endsection
