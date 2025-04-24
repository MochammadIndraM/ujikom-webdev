@extends('layouts.app')
@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Data Supplier</h3>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Data Supplier</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalTambahSupplier">
                        Tambah Data
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Kode Supplier</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Telpon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->kode_supplier }}</td>
                                    <td>{{ $supplier->nama_supplier }}</td>
                                    <td>{{ $supplier->alamat }}</td>
                                    <td>{{ $supplier->kota }}</td>
                                    <td>{{ $supplier->telpon }}</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalEditSupplier" data-id="{{ $supplier->kode_supplier }}"
                                            data-kode="{{ $supplier->kode_supplier }}"
                                            data-nama="{{ $supplier->nama_supplier }}" data-alamat="{{ $supplier->alamat }}"
                                            data-kota="{{ $supplier->kota }}" data-telpon="{{ $supplier->telpon }}"
                                            data-url="{{ route('supplier.update', ['kode_supplier' => $supplier->kode_supplier]) }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapusSupplier" data-id="{{ $supplier->kode_supplier }}"
                                            data-url="{{ route('supplier.destroy', ['kode_supplier' => $supplier->kode_supplier]) }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>

    {{-- modal tambah --}}
    <div class="modal fade" id="modalTambahSupplier" tabindex="-1" aria-labelledby="modalTambahSupplierLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahSupplierLabel">Tambah Data Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="{{ route('supplier.store') }}" method="POST">
                    @csrf
                    <div class="modal-body row g-3">
                        <div class="col-md-12">
                            <label for="kode_supplier" class="form-label">Kode Supplier</label>
                            <input type="text" class="form-control" id="kode_supplier" name="kode_supplier"
                                value="{{ $nextKode }}" readonly required>
                        </div>
                        <div class="col-md-12">
                            <label for="nama_supplier" class="form-label">Nama Supplier</label>
                            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" required>
                        </div>
                        <div class="col-md-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                        <div class="col-md-12">
                            <label for="kota" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota" required>
                        </div>
                        <div class="col-md-12">
                            <label for="telpon" class="form-label">Telpon</label>
                            <input type="text" class="form-control" id="telpon" name="telpon" required>
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

    {{-- modal edit --}}
    <div class="modal fade" id="modalEditSupplier" tabindex="-1" aria-labelledby="modalEditSupplierLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditSupplierLabel">Edit Data Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="" method="POST" id="formEditSupplier">
                    @csrf
                    @method('PUT')
                    <div class="modal-body row g-3">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="col-md-12">
                            <label for="edit_kode_supplier" class="form-label">Kode Supplier</label>
                            <input type="text" class="form-control" id="edit_kode_supplier" name="kode_supplier"
                                readonly required>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_nama_supplier" class="form-label">Nama Supplier</label>
                            <input type="text" class="form-control" id="edit_nama_supplier" name="nama_supplier"
                                required>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="edit_alamat" name="alamat" required>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_kota" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="edit_kota" name="kota" required>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_telpon" class="form-label">Telpon</label>
                            <input type="text" class="form-control" id="edit_telpon" name="telpon" required>
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

    {{-- modal hapus --}}
    <div class="modal fade" id="modalHapusSupplier" tabindex="-1" aria-labelledby="modalHapusSupplierLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHapusSupplierLabel">Hapus Data Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="" method="POST" id="formHapusSupplier">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus data supplier ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const modalEditSupplier = document.getElementById('modalEditSupplier');
        modalEditSupplier.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Tombol yang diklik
            const id = button.getAttribute('data-id');
            const kode = button.getAttribute('data-kode');
            const nama = button.getAttribute('data-nama');
            const alamat = button.getAttribute('data-alamat');
            const kota = button.getAttribute('data-kota');
            const telpon = button.getAttribute('data-telpon');
            const url = button.getAttribute('data-url'); // Ambil URL dari atribut data-url

            // Isi data ke dalam form modal
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_kode_supplier').value = kode;
            document.getElementById('edit_nama_supplier').value = nama;
            document.getElementById('edit_alamat').value = alamat;
            document.getElementById('edit_kota').value = kota;
            document.getElementById('edit_telpon').value = telpon;

            // Update action URL
            const form = document.getElementById('formEditSupplier');
            form.action = url; // Gunakan URL dari atribut data-url
        });
    </script>

    <script>
        const modalHapusSupplier = document.getElementById('modalHapusSupplier');
        modalHapusSupplier.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Tombol yang diklik
            const url = button.getAttribute('data-url'); // Ambil URL dari atribut data-url

            // Update action URL
            const form = document.getElementById('formHapusSupplier');
            form.action = url; // Gunakan URL dari atribut data-url
        });
    </script>
@endsection
