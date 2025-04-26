@extends('layouts.app')
@section('content')
    <div class="page-heading">
        <h3>Pembelian Obat</h3>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-body">

                    <!-- Informasi Nota dan Tanggal -->
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Nota: <strong id="nota">{{ $lastKode }}</strong></h6>
                            <h6 class="mb-0">Tanggal: <strong
                                    id="tanggalNota">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</strong></h6>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <select class="form-select" id="supplierSelect" name="kode_supplier" style="width: 200px;">
                                <option selected disabled>Pilih Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->kode_supplier }}">{{ $supplier->nama_supplier }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalBeliObat">
                                Pilih Obat
                            </button>
                        </div>
                    </div>

                    <!-- Tabel Data Obat yang Dibeli -->
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Supplier</th>
                                <th>Nama Obat</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="emptyRow">
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Ringkasan Pembelian -->
                    <div class="mt-4 d-flex justify-content-end">
                        <div class="card p-3" style="width: 300px;">
                            <form action="{{ route('pembelian.simpan') }}" method="POST" id="formPembelian">
                                @csrf
                                <!-- Diskon Input -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>Diskon:</span>
                                    <input type="number" id="inputDiskon" class="form-control w-50 ms-2" value="0"
                                        oninput="updateGrandTotal()" />
                                </div>

                                <!-- Grand Total -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>Grand Total:</span>
                                    <strong id="grandTotal">Rp 0</strong>
                                </div>

                                <input type="hidden" name="nota" value="{{ $lastKode }}">
                                {{-- <input type="hidden" name="kode_supplier" value="{{ old('kode_supplier') }}"> --}}
                                <input type="hidden" name="tanggal_nota"
                                    value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}">
                                {{-- <input type="hidden" name="kode_supplier" id="kode_supplier"
                                    value="{{ old('kode_supplier') }}"> --}}
                                <input type="hidden" name="kode_obat" id="kode_obat">
                                <input type="hidden" name="jumlah" id="jumlah">
                                <input type="hidden" name="subtotal" id="subtotal">
                                <input type="hidden" name="harga" id="harga">
                                {{-- <input type="hidden" name="diskon" id="diskon"> --}}
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="bi bi-cash-coin me-1"></i> Bayar
                                </button>
                            </form>

                        </div>
                    </div>


                </div>
            </div>

        </section>
    </div>

    <div class="modal fade" id="modalBeliObat" tabindex="-1" aria-labelledby="modalBeliObatLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBeliObatLabel">Pilih Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="/data-obat" method="POST">
                    @csrf
                    <div class="modal-body row g-3">
                        <div class="col-md-12">
                            <label for="nama" class="form-label">Daftar Obat</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Obat</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data obat akan dimuat secara dinamis -->
                                </tbody>
                            </table>
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
        document.getElementById('supplierSelect').addEventListener('change', function() {
            const supplierId = this.value;

            // Kirim permintaan AJAX untuk mendapatkan data obat berdasarkan supplier
            fetch(`/get-obat-by-supplier/${supplierId}`)

                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#modalBeliObat tbody');
                    tableBody.innerHTML = ''; // Kosongkan tabel sebelum menambahkan data baru

                    // Tambahkan data obat ke tabel
                    data.forEach(obat => {
                        const row = document.createElement('tr');
                        row.dataset.kodeObat = obat
                            .kode_obat; // Tambahkan kode_obat sebagai atribut data
                        row.dataset.hargaBeli = obat
                            .harga_beli; // Tambahkan harga_beli sebagai atribut data
                        row.innerHTML = `
                        <td>${obat.nama_obat}</td>
                        <td>${parseInt(obat.harga_beli).toLocaleString()}</td>
                        <td>
                        <input type="number" class="form-control" name="jumlah[${obat.kode_obat}]" min="0" placeholder="0">
                        </td>
                  `;

                        tableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error:', error));
        });
    </script>

    <script>
        function removeRow(button) {
            const row = button.closest('tr');
            row.remove();

            // Tambahkan baris default jika tabel kosong
            const tableBody = document.querySelector('#table1 tbody');
            if (tableBody.children.length === 0) {
                const emptyRow = document.createElement('tr');
                emptyRow.id = 'emptyRow';
                emptyRow.innerHTML = `
                    <td colspan="6" class="text-center">Tidak ada data</td>
                `;
                tableBody.appendChild(emptyRow);
            }

            // Perbarui total harga keseluruhan
            updateGrandTotal();
        }

        function updateGrandTotal() {
            const tableBody = document.querySelector('#table1 tbody');
            let totalHarga = 0;

            tableBody.querySelectorAll('tr').forEach(row => {
                const subtotalCell = row.querySelector('td:nth-child(5)');
                if (subtotalCell) {
                    const subtotal = parseInt(subtotalCell.textContent.replace(/,/g, '')) || 0;
                    totalHarga += subtotal;
                }
            });

            let diskon = parseInt(document.getElementById('inputDiskon').value) || 0;
            if (diskon < 0) {
                diskon = 0;
                document.getElementById('inputDiskon').value = 0;
            }

            let grandTotal = totalHarga - diskon;
            if (grandTotal < 0) {
                grandTotal = 0; // Kalau minus, set jadi 0
            }
            
            document.getElementById('grandTotal').textContent = 'Rp ' + grandTotal.toLocaleString();
        }


        document.querySelector('#modalBeliObat form').addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah form reload

            const tableBody = document.querySelector('#table1 tbody');
            const modalTableBody = document.querySelector('#modalBeliObat tbody');

            // Hapus baris default jika ada
            const emptyRow = document.getElementById('emptyRow');
            if (emptyRow) {
                emptyRow.remove();
            }

            let firstObat = true; // Untuk mengisi input form hanya dari obat pertama yang dipilih (kalau banyak)

            modalTableBody.querySelectorAll('tr').forEach(row => {
                const namaObat = row.querySelector('td:first-child').textContent;
                const jumlahInput = row.querySelector('input[type="number"]');
                const jumlah = jumlahInput.value;
                const harga = row.dataset.hargaBeli; // Ambil harga dari data attribute
                const subtotal = jumlah * harga;
                const kodeObat = row.dataset.kodeObat;

                if (jumlah > 0) {
                    // Tambahkan ke tabel
                    const newRow = document.createElement('tr');
                    newRow.dataset.kodeObat = kodeObat;
                    newRow.innerHTML = `
                <td>${document.querySelector('#supplierSelect option:checked').textContent}</td>
                <td>${namaObat}</td>
                <td>${parseInt(harga).toLocaleString()}</td>
                <td>${jumlah}</td>
                <td>${subtotal.toLocaleString()}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            `;
                    tableBody.appendChild(newRow);

                    // Isi input hidden hanya untuk yang pertama
                    if (firstObat) {
                        document.getElementById('kode_obat').value = kodeObat;
                        document.getElementById('jumlah').value = jumlah;
                        document.getElementById('harga').value = harga;
                        document.getElementById('subtotal').value = subtotal;
                        // document.getElementById('kode_supplier').value = kode_supplier;
                        // document.getElementById('kode_supplier').value = kodeSupplier;

                        firstObat = false;
                    }
                }
            });

            // Update diskon
            // document.getElementById('diskon').value = document.getElementById('inputDiskon').value || 0;

            // Tutup modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalBeliObat'));
            modal.hide();

            // Update grand total
            updateGrandTotal();
        });
    </script>
@endsection
