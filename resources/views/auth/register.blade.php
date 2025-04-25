<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Mazer Admin Dashboard</title>
    <link rel="shortcut icon" href="./assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="./assets/compiled/css/auth.css">
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="auth">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-lg-6">
                <div class="card p-4 shadow-lg">
                    <div id="auth-left" class="text-center">
                        <div class="auth-logo mb-3">
                            <a href="index.html"><img src="./assets/img/inthera-logo.png" alt="Logo"
                                    width="100"></a>
                        </div>
                        <h1 class="">Sign Up</h1>
                        <p class=" mb-4">Input your data to register.</p>

                        <form action="{{ route('register.submit') }}" method="POST" id="registerForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Nama -->
                                    <div class="form-group position-relative has-icon-left mb-3">
                                        <input type="text" name="nama" class="form-control"
                                            placeholder="Nama Lengkap" required>
                                        <div class="form-control-icon"><i class="bi bi-person"></i></div>
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group position-relative has-icon-left mb-3">
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            required>
                                        <div class="form-control-icon"><i class="bi bi-envelope"></i></div>
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group position-relative has-icon-left mb-3">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Password" required autocomplete="off" minlength="6">
                                        <div class="form-control-icon"><i class="bi bi-shield-lock"></i></div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="form-group position-relative has-icon-left mb-3">
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="Confirm Password" required autocomplete="off" minlength="6">
                                        <div class="form-control-icon"><i class="bi bi-shield-lock"></i></div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block shadow-sm mt-3">Sign Up</button>
                        </form>

                        <div class="text-center mt-4">
                            <p class='text-gray-600'>Already have an account? <a href="/login" class="font-bold">Log
                                    in</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Validasi untuk memastikan password dan konfirmasi password cocok
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            var password = document.querySelector('input[name="password"]').value;
            var confirmPassword = document.querySelector('input[name="password_confirmation"]').value;

            if (password !== confirmPassword) {
                alert('Password dan Konfirmasi Password tidak cocok.');
                event.preventDefault(); // Menghentikan form submit
            }
        });

        document.getElementById("registerForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Mencegah reload halaman

            let formData = new FormData(this); // Ambil semua data form

            fetch("{{ route('register.submit') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json()) // Ubah response jadi JSON
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: data.message,
                            timer: 3000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href =
                            "{{ route('login') }}"; // Redirect setelah toast selesai
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal!",
                            text: data.message
                        });
                    }
                })
                .catch(error => console.error(error)); // Debugging jika error
        });
    </script>
</body>

</html>
