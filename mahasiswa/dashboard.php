<?php

include '../auth/cek_login.php';

if($_SESSION['role']!='mahasiswa'){
    header("Location: ../auth/login.php");
    exit;
}

include '../config/koneksi.php';

$idUser=$_SESSION['id_user'];

$totalBooking=mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM bookings
WHERE id_user='$idUser'
"));

$totalPending=mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM bookings
WHERE id_user='$idUser'
AND status='Pending'
"));

$totalApproved=mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM bookings
WHERE id_user='$idUser'
AND status='Approved'
"));

$totalRejected=mysqli_num_rows(mysqli_query($conn,"
SELECT * FROM bookings
WHERE id_user='$idUser'
AND status='Rejected'
"));

$bookingTerbaru=mysqli_query($conn,"
SELECT
b.*,
r.nama_ruang
FROM bookings b
JOIN rooms r
ON b.id_room=r.id_room
WHERE b.id_user='$idUser'
ORDER BY b.created_at DESC
LIMIT 5
");

include '../includes/mahasiswa/header.php';
include '../includes/mahasiswa/navbar.php';
include '../includes/mahasiswa/sidebar.php';

?>

<style>

.dashboard-title{
font-size:30px;
font-weight:700;
margin-bottom:5px;
color:#2c3e50;
}

.dashboard-subtitle{
color:#6c757d;
margin-bottom:25px;
}

.welcome-card{

background:linear-gradient(135deg,#198754,#20c997);

border-radius:18px;

padding:28px;

color:white;

margin-bottom:25px;

box-shadow:0 12px 25px rgba(0,0,0,.15);

}

.small-box{

border-radius:18px;

transition:.3s;

overflow:hidden;

box-shadow:0 10px 20px rgba(0,0,0,.08);

}

.small-box:hover{

transform:translateY(-5px);

box-shadow:0 15px 35px rgba(0,0,0,.15);

}

.small-box .icon{

font-size:65px;

opacity:.18;

}

.card{

border:none;

border-radius:18px;

box-shadow:0 10px 20px rgba(0,0,0,.08);

}

.table thead{

background:#198754;

color:white;

}

</style>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h2 class="dashboard-title">

Dashboard Mahasiswa

</h2>

<p class="dashboard-subtitle">

Halo,

<b><?= $_SESSION['nama']; ?></b>

👋

</p>

<div class="welcome-card">

<h3>

<i class="fas fa-user-graduate"></i>

Selamat Datang di RoomBook

</h3>

<p>

Lakukan peminjaman ruangan kampus dengan mudah dan pantau status pengajuan Anda secara realtime.

</p>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="row">

<!-- ===========================
TOTAL BOOKING
=========================== -->

<div class="col-lg-3 col-md-6">

<div class="small-box bg-gradient-info">

<div class="inner">

<h3><?= $totalBooking ?></h3>

<p>Total Booking</p>

</div>

<div class="icon">

<i class="fas fa-calendar-alt"></i>

</div>

</div>

</div>

<!-- ===========================
PENDING
=========================== -->

<div class="col-lg-3 col-md-6">

<div class="small-box bg-gradient-warning">

<div class="inner">

<h3><?= $totalPending ?></h3>

<p>Pending</p>

</div>

<div class="icon">

<i class="fas fa-clock"></i>

</div>

</div>

</div>

<!-- ===========================
APPROVED
=========================== -->

<div class="col-lg-3 col-md-6">

<div class="small-box bg-gradient-success">

<div class="inner">

<h3><?= $totalApproved ?></h3>

<p>Approved</p>

</div>

<div class="icon">

<i class="fas fa-check-circle"></i>

</div>

</div>

</div>

<!-- ===========================
REJECTED
=========================== -->

<div class="col-lg-3 col-md-6">

<div class="small-box bg-gradient-danger">

<div class="inner">

<h3><?= $totalRejected ?></h3>

<p>Rejected</p>

</div>

<div class="icon">

<i class="fas fa-times-circle"></i>

</div>

</div>

</div>

</div>

<!-- ===========================
QUICK INFO
=========================== -->

<div class="row mt-3">

<div class="col-md-4">

<div class="card">

<div class="card-body text-center">

<i class="fas fa-calendar-plus fa-3x text-primary mb-3"></i>

<h5>Ajukan Booking</h5>

<p class="text-muted">

Pilih ruangan sesuai kebutuhan kegiatan Anda.

</p>

<a href="rooms/index.php" class="btn btn-primary btn-sm">

Booking Sekarang

</a>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card">

<div class="card-body text-center">

<i class="fas fa-history fa-3x text-success mb-3"></i>

<h5>Riwayat Booking</h5>

<p class="text-muted">

Lihat seluruh pengajuan yang pernah dilakukan.

</p>

<a href="bookings/index.php" class="btn btn-success btn-sm">

Lihat Riwayat

</a>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card">

<div class="card-body text-center">

<i class="fas fa-user-circle fa-3x text-info mb-3"></i>

<h5>Profil Saya</h5>

<p class="text-muted">

Perbarui data diri dan informasi akun Anda.

</p>

<a href="profile/index.php" class="btn btn-info btn-sm">

Buka Profil

</a>

</div>

</div>

</div>

</div>

<!-- ===========================
BOOKING TERBARU
=========================== -->

<div class="card mt-4">

<div class="card-header">

<h3 class="card-title">

<i class="fas fa-history text-success"></i>

5 Booking Terbaru

</h3>

</div>

<div class="card-body table-responsive">

<table class="table table-hover">

<thead>

<tr>

<th>Ruangan</th>

<th>Tanggal</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($bookingTerbaru)){ ?>

<tr>

<td><?= $row['nama_ruang']; ?></td>

<td><?= date('d-m-Y',strtotime($row['tanggal'])); ?></td>

<td>

<?php

if($row['status']=="Pending"){

echo "<span class='badge badge-warning'>Pending</span>";

}elseif($row['status']=="Approved"){

echo "<span class='badge badge-success'>Approved</span>";

}else{

echo "<span class='badge badge-danger'>Rejected</span>";

}

?>

</td>

<td>

<a
href="bookings/detail.php?id=<?= $row['id_booking']; ?>"
class="btn btn-info btn-sm">

<i class="fas fa-eye"></i>

Detail

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

<!-- ===========================
GRAFIK STATUS BOOKING
=========================== -->

<div class="card">

<div class="card-header">

<h3 class="card-title">

<i class="fas fa-chart-pie text-success"></i>

Statistik Status Booking

</h3>

</div>

<div class="card-body">

<canvas id="statusChart" height="100"></canvas>

</div>

</div>

</div>

</section>

</div>

<?php

include '../includes/mahasiswa/footer.php';
include '../includes/mahasiswa/scripts.php';

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx=document.getElementById('statusChart');

new Chart(ctx,{

type:'doughnut',

data:{

labels:[
'Pending',
'Approved',
'Rejected'
],

datasets:[{

data:[
<?= $totalPending ?>,
<?= $totalApproved ?>,
<?= $totalRejected ?>
],

backgroundColor:[
'#ffc107',
'#198754',
'#dc3545'
],

hoverOffset:15,

borderWidth:2,

borderColor:'#ffffff'

}]

},

options:{

responsive:true,

plugins:{

legend:{

position:'bottom',

labels:{

font:{
size:13
},

padding:20

}

}

},

cutout:'60%'

}

});

</script>