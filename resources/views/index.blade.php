<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Daftar Obat</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-primary text-white">
    <div class="container my-5">
        <header class="text-center mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1><i class="fas fa-pills"></i> Daftar Obat yang Dijual</h1>
                <button class="btn btn-light fw-bold" onclick="window.location.href='/login'">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </div>
            <p>Informasi lengkap tentang obat yang tersedia</p>
        </header>
        <div class="card shadow-lg">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Nama Obat</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obat as $item)
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-link text-decoration-none text-primary p-0"
                                        data-bs-toggle="modal" data-bs-target="#modal-{{ $item->id }}">
                                        <i class="fas fa-info-circle"></i> {{ $item->nama_obat }}
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="modalLabel-{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="modalLabel-{{ $item->id }}">Detail
                                                        Obat</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Nama:</strong> {{ $item->nama_obat }}</p>
                                                    <p><strong>Jenis:</strong> {{ $item->jenis }}</p>
                                                    <p><strong>Satuan:</strong> {{ $item->satuan }}</p>
                                                    <p><strong>Harga:</strong> Rp
                                                        {{ number_format($item->harga_jual, 0, ',', '.') }}
                                                    </p>
                                                    <p><strong>Jumlah:</strong> {{ $item->stok }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item->stok }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
