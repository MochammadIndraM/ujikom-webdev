@extends('layouts.app')
@section('content')
    <div class="page-heading">
        <h3>Riwayat Pembelian</h3>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Data Riwayat Pembelian</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Nota</th>
                                <th>Tanggal Pembelian</th>
                                <th>Nama Supplier</th>
                                <th>Diskon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembelians as $pembelian)
                                <tr>
                                    <td>{{ $pembelian->nota }}</td>
                                    <td>{{ $pembelian->tanggal_nota }}</td>
                                    <td>{{ $pembelian->supplier->nama_supplier }}</td>
                                    <td>{{ $pembelian->diskon ?? 0 }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#detailModal{{ $pembelian->id }}">
                                            Detail
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="detailModal{{ $pembelian->id }}" tabindex="-1"
                                            aria-labelledby="detailModalLabel{{ $pembelian->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="detailModalLabel{{ $pembelian->id }}">
                                                            Detail Pembelian</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Nota:</strong> {{ $pembelian->nota }}</p>
                                                        <p><strong>Tanggal Pembelian:</strong>
                                                            {{ $pembelian->tanggal_pembelian }}</p>
                                                        <p><strong>Nama Supplier:</strong>
                                                            {{ $pembelian->supplier->nama_supplier }}</p>
                                                        <p><strong>Diskon:</strong> {{ $pembelian->diskon }}%</p>
                                                        <hr>
                                                        <h6>Detail Barang:</h6>
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nama Obat</th>
                                                                    <th>Jumlah</th>
                                                                    <th>Harga</th>
                                                                    <th>SubTotal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($details->where('nota', $pembelian->nota) as $detail)
                                                                    <tr>
                                                                        <td>{{ $detail->obat->nama_obat }}</td>
                                                                        <td>{{ $detail->jumlah }}</td>
                                                                        <td>{{ number_format($detail->harga, 2) }}</td>
                                                                        <td>{{ number_format($detail->subtotal, 2) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
