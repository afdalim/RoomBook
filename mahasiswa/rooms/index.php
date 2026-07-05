<?php

include '../../auth/cek_login.php';

if($_SESSION['role']!='mahasiswa'){
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$data = mysqli_query($conn,"
SELECT *
FROM rooms
WHERE status='tersedia'
ORDER BY nama_ruang ASC
");

$totalRuangan = mysqli_num_rows($data);

include '../../includes/mahasiswa/header.php';
include '../../includes/mahasiswa/navbar.php';
include '../../includes/mahasiswa/sidebar.php';

?>

<style>

.room-card{
    border:none;
    border-radius:18px;
    overflow:hidden;
    transition:.3s;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}

.room-card:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 35px rgba(0,0,0,.18);
}

.room-header{
    height:6px;
    background:linear-gradient(90deg,#0d6efd,#4f8cff);
}

.room-icon{
    width:70px;
    height:70px;
    border-radius:50%;
    background:#eaf3ff;
    display:flex;
    justify-content:center;
    align-items:center;
    margin:auto;
    margin-top:10px;
    margin-bottom:15px;
}

.room-icon i{
    font-size:30px;
    color:#0d6efd;
}

.room-title{
    font-size:25px;
    font-weight:700;
    text-align:center;
}

.room-info{
    font-size:15px;
    color:#555;
    margin-bottom:8px;
}

.room-info i{
    width:22px;
    color:#0d6efd;
}

.fasilitas{
    background:#f8f9fa;
    border-radius:12px;
    padding:12px;
    min-height:85px;
    margin-top:10px;
}

.fasilitas-title{
    font-weight:bold;
    color:#0d6efd;
    margin-bottom:8px;
}

.btn-book{
    border-radius:12px;
    font-weight:600;
    margin-top:15px;
}

.page-title{
    font-weight:700;
}

</style>

<div class="content-wrapper">

<section class="content">

<div class="container-fluid pt-4">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="page-title">
Booking Ruangan
</h2>

<p class="text-muted mb-0">
Pilih ruangan yang tersedia untuk dipinjam.
</p>

</div>

<span class="badge badge-success p-2">

<?= $totalRuangan; ?> Ruangan Tersedia

</span>

</div>

<div class="row">

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<div class="col-lg-4 col-md-6 mb-4">

<div class="card room-card">

<div class="room-header"></div>

<div class="card-body">

<div class="room-icon">

<i class="fas fa-door-open"></i>

</div>

<h4 class="room-title">

<?= $row['nama_ruang']; ?>

</h4>

<hr>

<div class="room-info">

<i class="fas fa-map-marker-alt"></i>

<?= $row['lokasi']; ?>

</div>

<div class="room-info">

<i class="fas fa-users"></i>

Kapasitas <?= $row['kapasitas']; ?> Orang

</div>

<div class="fasilitas">

<div class="fasilitas-title">

<i class="fas fa-list"></i>

Fasilitas

</div>

<?= nl2br($row['fasilitas']); ?>

</div>

<div class="text-center">

<a
href="booking.php?id=<?= $row['id_room']; ?>"
class="btn btn-primary btn-book btn-block">

<i class="fas fa-calendar-plus"></i>

Booking Sekarang

</a>

</div>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</section>

</div>

<?php

include '../../includes/mahasiswa/footer.php';
include '../../includes/mahasiswa/scripts.php';

?>