<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoomBook</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/adminlte/plugins/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/adminlte/plugins/fontawesome-free/css/all.min.css">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="../assets/adminlte/dist/css/adminlte.min.css">
</head>

<body>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <div class="container">

        <a class="navbar-brand fw-bold" href="#">
            <i class="fas fa-building"></i> RoomBook
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="#">Beranda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Ruangan</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Tentang</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Kontak</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-light btn-sm ms-3" href="../auth/login.php">
                        Masuk
                    </a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-warning btn-sm ms-2" href="../auth/register.php">
                        Daftar Akun
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>

<!-- Hero -->

<section class="py-5 bg-light">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-md-6">

                <h1 class="fw-bold">

                    Sistem Peminjaman Ruang
                    Kegiatan Organisasi Kampus

                </h1>

                <p class="text-muted mt-3">

                    Mempermudah mahasiswa melakukan peminjaman ruangan
                    secara online, cepat, transparan, dan terjadwal.

                </p>

            </div>

            <div class="col-md-6 text-center">

                <img src="../assets/img/hero.png"
                     class="img-fluid"
                     width="450">

            </div>

        </div>

    </div>

</section>

<!-- Footer -->

<footer class="bg-primary text-white text-center py-3">

    RoomBook afdalim_18 © 2026

</footer>

<script src="../assets/adminlte/plugins/jquery/jquery.min.js"></script>
<script src="../assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/adminlte/dist/js/adminlte.min.js"></script>

</body>

</html>