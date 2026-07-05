<!DOCTYPE html>

<?php

include '../config/koneksi.php';

$totalRuangan = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM rooms"));

$totalMahasiswa = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM users
WHERE role='mahasiswa'
"));

$totalBooking = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM bookings
"));

$totalApproved = mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM bookings
WHERE status='Approved'
"));

$approval = 0;

if($totalBooking>0){

$approval = round(($totalApproved/$totalBooking)*100);

}

?>

<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>RoomBook | Sistem Peminjaman Ruangan</title>

<link rel="stylesheet" href="../assets/adminlte/plugins/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="../assets/adminlte/plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="../assets/adminlte/dist/css/adminlte.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

html{
    scroll-behavior:smooth;
}

body{
    background:#f8fafc;
}

/* ===========================
NAVBAR
=========================== */

.navbar{
    background:linear-gradient(90deg,#2563eb,#1d4ed8);
    padding:15px 0;
    box-shadow:0 5px 18px rgba(0,0,0,.12);
}

.navbar-brand{
    font-size:28px;
    font-weight:700;
}

.nav-link{
    color:white!important;
    font-weight:500;
    margin-left:15px;
}

.nav-link:hover{
    color:#ffd43b!important;
}

/* ===========================
BUTTON
=========================== */

.btn-login{

    border-radius:30px;
    padding:10px 25px;
    font-weight:600;
    background:white;
    color:#2563eb!important;
    transition:.3s;

}

.btn-login:hover{

    transform:translateY(-2px);

}

.btn-register{

    border-radius:30px;
    padding:10px 25px;
    margin-left:10px;
    background:#ffd43b;
    color:#222!important;
    font-weight:600;
    transition:.3s;

}

.btn-register:hover{

    transform:translateY(-2px);

}

/* ===========================
HERO
=========================== */

.hero{

padding:90px 0;

background:linear-gradient(135deg,#2563eb,#4f8cff);

color:white;

overflow:hidden;

position:relative;

}

.hero::before{

content:"";

position:absolute;

width:420px;

height:420px;

background:rgba(255,255,255,.08);

border-radius:50%;

right:-120px;

top:-120px;

}

.hero::after{

content:"";

position:absolute;

width:280px;

height:280px;

background:rgba(255,255,255,.08);

border-radius:50%;

left:-80px;

bottom:-80px;

}

.hero h1{

font-size:54px;

font-weight:700;

line-height:1.2;

margin-bottom:20px;

}

.hero p{

font-size:18px;

opacity:.95;

margin-bottom:30px;

}

.badge-hero{

background:#ffd43b;

color:#222;

padding:10px 18px;

border-radius:25px;

font-size:14px;

font-weight:600;

margin-bottom:20px;

display:inline-block;

}

.hero-image{

animation:float 4s ease-in-out infinite;

}

@keyframes float{

0%{
transform:translateY(0);
}

50%{
transform:translateY(-15px);
}

100%{
transform:translateY(0);
}

}

.btn-hero{

padding:13px 28px;

border-radius:35px;

font-weight:600;

margin-right:10px;

}

/* ===========================
SECTION
=========================== */

.section-title{

font-size:38px;

font-weight:700;

margin-bottom:15px;

color:#222;

}

.section-subtitle{

color:#666;

margin-bottom:50px;

}

</style>

</head>

<body>

<!-- ===========================
NAVBAR
=========================== -->

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">

<div class="container">

<a class="navbar-brand" href="#">

<i class="fas fa-building"></i>

RoomBook

</a>

<button class="navbar-toggler"
type="button"
data-toggle="collapse"
data-target="#navbar">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse"
id="navbar">

<ul class="navbar-nav ml-auto align-items-center">

<li class="nav-item">

<a class="nav-link" href="#beranda">

Beranda

</a>

</li>

<li class="nav-item">

<a class="nav-link" href="#fitur">

Fitur

</a>

</li>

<li class="nav-item">

<a class="nav-link" href="#alur">

Alur

</a>

</li>

<li class="nav-item">

<a class="nav-link" href="#kontak">

Kontak

</a>

</li>

<li class="nav-item ml-3">

<a href="../auth/login.php"
class="btn btn-login">

<i class="fas fa-sign-in-alt"></i>

Masuk

</a>

</li>

<li class="nav-item">

<a href="../auth/register.php"
class="btn btn-register">

<i class="fas fa-user-plus"></i>

Daftar

</a>

</li>

</ul>

</div>

</div>

</nav>

<!-- ===========================
HERO
=========================== -->

<section class="hero" id="beranda">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-6">

<span class="badge-hero">

<i class="fas fa-check-circle"></i>

Platform Peminjaman Ruangan Kampus

</span>

<h1>

Peminjaman Ruangan Kampus
<br>

Lebih Mudah,
Cepat,
dan Terjadwal

</h1>

<p>

RoomBook merupakan sistem informasi peminjaman ruangan
yang membantu mahasiswa melakukan reservasi ruang
secara online, transparan, dan efisien tanpa proses
administrasi yang rumit.

</p>

<a href="../auth/login.php"
class="btn btn-light btn-hero">

<i class="fas fa-sign-in-alt"></i>

Masuk

</a>

<a href="../auth/register.php"
class="btn btn-warning btn-hero">

<i class="fas fa-user-plus"></i>

Daftar Sekarang

</a>

</div>

<div class="col-lg-6 text-center">

<img
src="../assets/img/hero.png"
class="img-fluid hero-image"
style="max-width:480px;">

</div>

</div>

</div>

<!-- Wave -->

<svg
style="display:block"
xmlns="http://www.w3.org/2000/svg"
viewBox="0 0 1440 320">

<path
fill="#f8fafc"
fill-opacity="1"

d="M0,256L80,245.3C160,235,320,213,480,197.3C640,181,800,171,960,181.3C1120,192,1280,224,1360,240L1440,256L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">

</path>

</svg>

</section>

<!-- ===========================
STATISTIK
=========================== -->

<section class="py-5">

<div class="container">

<div class="row text-center">

<div class="col-md-3 col-6 mb-4">

<div class="card shadow-sm border-0 h-100">

<div class="card-body">

<i class="fas fa-door-open fa-3x text-primary mb-3"></i>

<h2 class="font-weight-bold text-primary">

<?= $totalRuangan ?>

</h2>

<p class="text-muted mb-0">

Ruangan

</p>

</div>

</div>

</div>

<div class="col-md-3 col-6 mb-4">

<div class="card shadow-sm border-0 h-100">

<div class="card-body">

<i class="fas fa-user-graduate fa-3x text-success mb-3"></i>

<h2 class="font-weight-bold text-success">

<?= $totalMahasiswa ?>

</h2>

<p class="text-muted mb-0">

Mahasiswa

</p>

</div>

</div>

</div>

<div class="col-md-3 col-6 mb-4">

<div class="card shadow-sm border-0 h-100">

<div class="card-body">

<i class="fas fa-calendar-check fa-3x text-warning mb-3"></i>

<h2 class="font-weight-bold text-warning">

<?= $totalBooking ?>

</h2>

<p class="text-muted mb-0">

Peminjaman

</p>

</div>

</div>

</div>

<div class="col-md-3 col-6 mb-4">

<div class="card shadow-sm border-0 h-100">

<div class="card-body">

<i class="fas fa-check-circle fa-3x text-info mb-3"></i>

<h2 class="font-weight-bold text-info">

<?= $approval ?>%

</h2>

<p class="text-muted mb-0">

Approval

</p>

</div>

</div>

</div>

</div>

</div>

</section>

<!-- ===========================
FITUR
=========================== -->

<section class="py-5 bg-white" id="fitur">

<div class="container">

<div class="text-center mb-5">

<h2 class="section-title">

Mengapa Memilih RoomBook?

</h2>

<p class="section-subtitle">

Solusi digital untuk proses peminjaman ruangan yang lebih efisien.

</p>

</div>

<div class="row">

<div class="col-lg-3 col-md-6 mb-4">

<div class="card border-0 shadow h-100">

<div class="card-body text-center">

<i class="fas fa-bolt fa-3x text-primary mb-3"></i>

<h5 class="font-weight-bold">

Cepat

</h5>

<p class="text-muted">

Peminjaman ruangan dapat dilakukan kapan saja hanya dalam beberapa menit.

</p>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card border-0 shadow h-100">

<div class="card-body text-center">

<i class="fas fa-calendar-alt fa-3x text-success mb-3"></i>

<h5 class="font-weight-bold">

Terjadwal

</h5>

<p class="text-muted">

Semua jadwal peminjaman tersimpan rapi sehingga meminimalkan bentrok penggunaan.

</p>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card border-0 shadow h-100">

<div class="card-body text-center">

<i class="fas fa-shield-alt fa-3x text-warning mb-3"></i>

<h5 class="font-weight-bold">

Aman

</h5>

<p class="text-muted">

Setiap pengguna memiliki akun masing-masing sehingga data lebih terjamin.

</p>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card border-0 shadow h-100">

<div class="card-body text-center">

<i class="fas fa-chart-line fa-3x text-danger mb-3"></i>

<h5 class="font-weight-bold">

Transparan

</h5>

<p class="text-muted">

Status pengajuan dapat dipantau secara realtime tanpa harus datang ke admin.

</p>

</div>

</div>

</div>

</div>

</div>

</section>

<!-- ===========================
ALUR PEMINJAMAN
=========================== -->

<section class="py-5 bg-light" id="alur">

<div class="container">

<div class="text-center mb-5">

<h2 class="section-title">
Alur Peminjaman Ruangan
</h2>

<p class="section-subtitle">
Hanya membutuhkan beberapa langkah sederhana.
</p>

</div>

<div class="row text-center">

<div class="col-lg-3 col-md-6 mb-4">

<div class="card border-0 shadow h-100">

<div class="card-body">

<div class="mb-3">

<i class="fas fa-user-circle fa-4x text-primary"></i>

</div>

<h5 class="font-weight-bold">

1. Login

</h5>

<p class="text-muted">

Masuk menggunakan akun mahasiswa yang telah terdaftar.

</p>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card border-0 shadow h-100">

<div class="card-body">

<div class="mb-3">

<i class="fas fa-door-open fa-4x text-success"></i>

</div>

<h5 class="font-weight-bold">

2. Pilih Ruangan

</h5>

<p class="text-muted">

Pilih ruangan yang masih tersedia sesuai kebutuhan.

</p>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card border-0 shadow h-100">

<div class="card-body">

<div class="mb-3">

<i class="fas fa-calendar-plus fa-4x text-warning"></i>

</div>

<h5 class="font-weight-bold">

3. Ajukan Peminjaman

</h5>

<p class="text-muted">

Isi formulir peminjaman dan kirimkan pengajuan.

</p>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card border-0 shadow h-100">

<div class="card-body">

<div class="mb-3">

<i class="fas fa-check-circle fa-4x text-info"></i>

</div>

<h5 class="font-weight-bold">

4. Menunggu Persetujuan

</h5>

<p class="text-muted">

Admin memverifikasi permohonan hingga status disetujui.

</p>

</div>

</div>

</div>

</div>

</div>

</section>

<!-- ===========================
CALL TO ACTION
=========================== -->

<section
class="py-5 text-center text-white"
style="background:linear-gradient(135deg,#2563eb,#1d4ed8);">

<div class="container">

<h2 class="font-weight-bold mb-3">

Siap Menggunakan RoomBook?

</h2>

<p class="mb-4">

Daftarkan akun Anda dan mulai melakukan peminjaman ruangan secara online.

</p>

<a
href="../auth/register.php"
class="btn btn-warning btn-lg mr-2">

<i class="fas fa-user-plus"></i>

Daftar Sekarang

</a>

<a
href="../auth/login.php"
class="btn btn-light btn-lg">

<i class="fas fa-sign-in-alt"></i>

Masuk

</a>

</div>

</section>

<!-- ===========================
FOOTER
=========================== -->

<footer
class="pt-5 pb-3"
id="kontak"
style="background:#0f172a;color:white;">

<div class="container">

<div class="row">

<div class="col-md-5">

<h3 class="font-weight-bold">

<i class="fas fa-building"></i>

RoomBook

</h3>

<p class="mt-3">

Sistem Informasi Peminjaman Ruangan Kampus yang
membantu mahasiswa melakukan reservasi ruangan
secara mudah, cepat, dan transparan.

</p>

</div>

<div class="col-md-3">

<h5>

Menu

</h5>

<ul class="list-unstyled mt-3">

<li>

<a href="#beranda" class="text-light">

Beranda

</a>

</li>

<li>

<a href="#fitur" class="text-light">

Fitur

</a>

</li>

<li>

<a href="#alur" class="text-light">

Alur Peminjaman

</a>

</li>

</ul>

</div>

<div class="col-md-4">

<h5>

Developer

</h5>

<p class="mt-3">

<b>Afdal Indra Maulana</b>

<br>

Sistem Informasi

<br>

STIKOM Yos Sudarso Purwokerto

</p>

</div>

</div>

<hr style="background:rgba(255,255,255,.2);">

<div class="text-center">

© <?= date('Y'); ?>

RoomBook

|

Developed by

<b>Afdal Indra Maulana</b>

</div>

</div>

</footer>

<script src="../assets/adminlte/plugins/jquery/jquery.min.js"></script>

<script src="../assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../assets/adminlte/dist/js/adminlte.min.js"></script>

</body>

</html>