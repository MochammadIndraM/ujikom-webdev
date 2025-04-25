@extends('layouts.app')
@section('content')
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
                                <th>Nama Obat</th>
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
                            @foreach ($obat as $obatt)
                                <tr>
                                    <td>{{ $obatt->kode_obat }}</td>
                                    <td>{{ $obatt->nama_obat }}</td>
                                    <td>{{ $obatt->jenis }}</td>
                                    <td>{{ $obatt->satuan }}</td>
                                    <td>{{ $obatt->harga_beli }}</td>
                                    <td>{{ $obatt->harga_jual }}</td>
                                    <td>{{ $obatt->stok }}</td>
                                    <td>{{ $obatt->supplier->nama_supplier }}</td>

                                    <td>
                                        <!-- Tombol Edit -->
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalEditObat" data-kode_obat="{{ $obatt->kode_obat }}"
                                            data-nama_obat="{{ $obatt->nama_obat }}" data-jenis="{{ $obatt->jenis }}"
                                            data-satuan="{{ $obatt->satuan }}" data-harga_beli="{{ $obatt->harga_beli }}"
                                            data-harga_jual="{{ $obatt->harga_jual }}" data-stok="{{ $obatt->stok }}"
                                            data-kode_supplier="{{ $obatt->supplier->kode_supplier }}"
                                            data-url="{{ route('obat.update', ['kode_obat' => $obatt->kode_obat]) }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>



                                        <!-- Tombol Hapus -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapusObat" data-kode_obat="{{ $obatt->kode_obat }}"
                                            data-url="{{ route('obat.destroy', ['kode_obat' => $obatt->kode_obat]) }}">
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
    <div class="modal fade" id="modalTambahObat" tabindex="-1" aria-labelledby="modalTambahObatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahObatLabel">Tambah Data Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="{{ route('obat.store') }}" method="POST">
                    @csrf
                    <div class="modal-body row g-3">
                        <div class="col-md-12">
                            <label for="kode_obat" class="form-label">Kode Obat</label>
                            <input type="text" class="form-control" id="kode_obat" name="kode_obat"
                                value="{{ $nextKode }}" readonly required>
                        </div>

                        <div class="col-md-12">
                            <label for="nama_obat" class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" id="nama_obat" name="nama_obat" required>
                        </div>
                        <div class="col-md-12">
                            <label for="jenis" class="form-label">Jenis</label>
                            <select class="form-select" id="jenis" name="jenis" required>
                                @foreach (\App\Models\DataObat::getJenisEnumValues() as $jenis)
                                    <option value="{{ $jenis }}">{{ $jenis }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="satuan" class="form-label">Satuan</label>
                            <select class="form-select" id="satuan" name="satuan" required>
                                @foreach (\App\Models\DataObat::getSatuanEnumValues() as $satuan)
                                    <option value="{{ $satuan }}">{{ $satuan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
                        </div>
                        <div class="col-md-12">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
                        </div>
                        <div class="col-md-12">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" required>
                        </div>
                        <div class="col-md-12">
                            <label for="kode_supplier" class="form-label">Kode Supplier</label>
                            <select class="form-control" id="kode_supplier" name="kode_supplier" required>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->kode_supplier }}">{{ $supplier->nama_supplier }}
                                    </option>
                                @endforeach
                            </select>
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
    <div class="modal fade" id="modalEditObat" tabindex="-1" aria-labelledby="modalEditObatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditObatLabel">Edit Data Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="" method="POST" id="formEditObat">
                    @csrf
                    @method('PUT')
                    <div class="modal-body row g-3">
                        <div class="col-md-12">
                            <label for="edit_kode_obat" class="form-label">Kode Obat</label>
                            <input type="text" class="form-control" id="edit_kode_obat" name="kode_obat" readonly
                                required>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_nama_obat" class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" id="edit_nama_obat" name="nama_obat" required>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_jenis" class="form-label">Jenis</label>
                            <select class="form-select" id="edit_jenis" name="jenis" required>
                                @foreach (\App\Models\DataObat::getJenisEnumValues() as $jenis)
                                    <option value="{{ $jenis }}">{{ $jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_satuan" class="form-label">Satuan</label>
                            <select class="form-select" id="edit_satuan" name="satuan" required>
                                @foreach (\App\Models\DataObat::getSatuanEnumValues() as $satuan)
                                    <option value="{{ $satuan }}">{{ $satuan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_harga_beli" class="form-label">Harga Beli</label>
                            <input type="number" class="form-control" id="edit_harga_beli" name="harga_beli" required>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_harga_jual" class="form-label">Harga Jual</label>
                            <input type="number" class="form-control" id="edit_harga_jual" name="harga_jual" required>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="edit_stok" name="stok" required>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_kode_supplier" class="form-label">Nama Supplier</label>
                            <select class="form-control" id="edit_kode_supplier" name="kode_supplier" required>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->kode_supplier }}">{{ $supplier->nama_supplier }}
                                    </option>
                                @endforeach
                            </select>
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
    <div class="modal fade" id="modalHapusObat" tabindex="-1" aria-labelledby="modalHapusObatLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHapusObatLabel">Hapus Data Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="" method="POST" id="formHapusObat">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus data obat dengan kode <strong id="kode_obat_hapus"></strong>?
                        </p>
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
        const modalEditObat = document.getElementById('modalEditObat');
        modalEditObat.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Tombol yang diklik
            const kodeObat = button.getAttribute('data-kode_obat');
            const namaObat = button.getAttribute('data-nama_obat');
            const jenis = button.getAttribute('data-jenis');
            const satuan = button.getAttribute('data-satuan');
            const hargaBeli = button.getAttribute('data-harga_beli');
            const hargaJual = button.getAttribute('data-harga_jual');
            const stok = button.getAttribute('data-stok');
            const kodeSupplier = button.getAttribute('data-kode_supplier');
            const url = button.getAttribute('data-url'); // Ambil URL dari atribut data-url

            // Isi data ke dalam form modal
            document.getElementById('edit_kode_obat').value = kodeObat;
            document.getElementById('edit_nama_obat').value = namaObat;
            document.getElementById('edit_jenis').value = jenis;
            document.getElementById('edit_satuan').value = satuan;
            document.getElementById('edit_harga_beli').value = hargaBeli;
            document.getElementById('edit_harga_jual').value = hargaJual;
            document.getElementById('edit_stok').value = stok;
            document.getElementById('edit_kode_supplier').value = kodeSupplier;

            // Update action URL
            const form = document.getElementById('formEditObat');
            form.action = url; // Gunakan URL dari atribut data-url
        });
    </script>



    <script>
        const modalHapusObat = document.getElementById('modalHapusObat');
        modalHapusObat.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Tombol yang diklik
            const kodeObat = button.getAttribute('data-kode_obat'); // Ambil kode obat dari atribut data-kode_obat
            const url = button.getAttribute('data-url'); // Ambil URL dari atribut data-url

            // Tampilkan kode obat yang akan dihapus di dalam modal
            document.getElementById('kode_obat_hapus').textContent = kodeObat;

            // Perbarui atribut action pada form dengan URL yang sesuai
            const form = document.getElementById('formHapusObat');
            form.setAttribute('action', url); // Gunakan URL dari atribut data-url
        });
    </script>
@endsection
