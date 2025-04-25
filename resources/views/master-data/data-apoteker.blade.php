@extends('layouts.app')
@section('content')


    <div class="page-heading">
        <h3>Data Apoteker</h3>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Data Apoteker</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalTambahApoteker">
                        Tambah Data
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Kode Apoteker</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Telpon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apotekers as $apoteker)
                                <tr>
                                    <td>{{ $apoteker->kode_apoteker }}</td>
                                    <td>{{ $apoteker->nama_apoteker }}</td>
                                    <td>{{ $apoteker->alamat }}</td>
                                    <td>{{ $apoteker->kota }}</td>
                                    <td>{{ $apoteker->telpon }}</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalEditApoteker" data-id="{{ $apoteker->kode_apoteker }}"
                                            data-kode="{{ $apoteker->kode_apoteker }}"
                                            data-nama="{{ $apoteker->nama_apoteker }}" data-alamat="{{ $apoteker->alamat }}"
                                            data-kota="{{ $apoteker->kota }}" data-telpon="{{ $apoteker->telpon }}"
                                            data-url="{{ route('apoteker.update', ['kode_apoteker' => $apoteker->kode_apoteker]) }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalHapusApoteker" data-id="{{ $apoteker->kode_apoteker }}"
                                            data-url="{{ route('apoteker.destroy', ['kode_apoteker' => $apoteker->kode_apoteker]) }}">
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
    <div class="modal fade" id="modalTambahApoteker" tabindex="-1" aria-labelledby="modalTambahApotekerLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahApotekerLabel">Tambah Data Apoteker</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="{{ route('apoteker.store') }}" method="POST">
                    @csrf
                    <div class="modal-body row g-3">
                        <div class="col-md-12">
                            <label for="kode_apoteker" class="form-label">Kode Apoteker</label>
                            <input type="text" class="form-control" id="kode_apoteker" name="kode_apoteker"
                                value="{{ $nextKode }}" readonly required>
                        </div>
                        <div class="col-md-12">
                            <label for="nama_apoteker" class="form-label">Nama Apoteker</label>
                            <input type="text" class="form-control" id="nama_apoteker" name="nama_apoteker" required>
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
    <div class="modal fade" id="modalEditApoteker" tabindex="-1" aria-labelledby="modalEditApotekerLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditApotekerLabel">Edit Data Apoteker</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="" method="POST" id="formEditApoteker">
                    @csrf
                    @method('PUT')
                    <div class="modal-body row g-3">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="col-md-12">
                            <label for="edit_kode_apoteker" class="form-label">Kode Apoteker</label>
                            <input type="text" class="form-control" id="edit_kode_apoteker" name="kode_apoteker"
                                readonly required>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_nama_apoteker" class="form-label">Nama Apoteker</label>
                            <input type="text" class="form-control" id="edit_nama_apoteker" name="nama_apoteker"
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
    <div class="modal fade" id="modalHapusApoteker" tabindex="-1" aria-labelledby="modalHapusApotekerLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHapusApotekerLabel">Hapus Data Apoteker</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="" method="POST" id="formHapusApoteker">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus data apoteker ini?</p>
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
        const modalEditApoteker = document.getElementById('modalEditApoteker');
        modalEditApoteker.addEventListener('show.bs.modal', function(event) {
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
            document.getElementById('edit_kode_apoteker').value = kode;
            document.getElementById('edit_nama_apoteker').value = nama;
            document.getElementById('edit_alamat').value = alamat;
            document.getElementById('edit_kota').value = kota;
            document.getElementById('edit_telpon').value = telpon;

            // Update action URL
            const form = document.getElementById('formEditApoteker');
            form.action = url; // Gunakan URL dari atribut data-url
        });
    </script>

    <script>
        const modalHapusApoteker = document.getElementById('modalHapusApoteker');
        modalHapusApoteker.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Tombol yang diklik
            const url = button.getAttribute('data-url'); // Ambil URL dari atribut data-url

            // Update action URL
            const form = document.getElementById('formHapusApoteker');
            form.action = url; // Gunakan URL dari atribut data-url
        });
    </script>
@endsection
