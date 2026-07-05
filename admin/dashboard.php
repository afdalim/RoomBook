<?php

include '../auth/cek_login.php';

if($_SESSION['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit;
}

include '../config/koneksi.php';

/*=====================================
TOTAL DATA
=====================================*/

$totalRuangan = mysqli_num_rows(
mysqli_query($conn,"
SELECT * FROM rooms
"));

$totalMahasiswa = mysqli_num_rows(
mysqli_query($conn,"
SELECT *
FROM users
WHERE role='mahasiswa'
"));

$totalBooking = mysqli_num_rows(
mysqli_query($conn,"
SELECT *
FROM bookings
"));

$totalPending = mysqli_num_rows(
mysqli_query($conn,"
SELECT *
FROM bookings
WHERE status='Pending'
"));

$totalApproved = mysqli_num_rows(
mysqli_query($conn,"
SELECT *
FROM bookings
WHERE status='Approved'
"));

$totalRejected = mysqli_num_rows(
mysqli_query($conn,"
SELECT *
FROM bookings
WHERE status='Rejected'
"));

/*=====================================
BOOKING TERBARU
=====================================*/

$bookingTerbaru = mysqli_query($conn,"

SELECT

b.*,

u.nama,

r.nama_ruang

FROM bookings b

JOIN users u
ON b.id_user=u.id_user

JOIN rooms r
ON b.id_room=r.id_room

ORDER BY b.created_at DESC

LIMIT 5

");

/*=====================================
DATA GRAFIK
=====================================*/

$grafik = mysqli_query($conn,"

SELECT

MONTH(created_at) AS bulan,

COUNT(*) AS total

FROM bookings

WHERE YEAR(created_at)=YEAR(CURDATE())

GROUP BY MONTH(created_at)

ORDER BY MONTH(created_at)

");

$dataGrafik=[];

while($g=mysqli_fetch_assoc($grafik)){

$dataGrafik[(int)$g['bulan']]=$g['total'];

}

$label=[];

$nilai=[];

for($i=1;$i<=12;$i++){

$label[]=date("M",mktime(0,0,0,$i,1));

$nilai[]=isset($dataGrafik[$i]) ? $dataGrafik[$i] : 0;

}

include '../includes/admin/header.php';
include '../includes/admin/navbar.php';
include '../includes/admin/sidebar.php';

?>

<style>

.content-header{
margin-bottom:20px;
}

.dashboard-title{
font-size:30px;
font-weight:700;
color:#2c3e50;
margin-bottom:5px;
}

.dashboard-subtitle{
color:#6c757d;
font-size:15px;
margin-bottom:25px;
}

.welcome-card{

background:linear-gradient(135deg,#4e73df,#224abe);

border-radius:20px;

padding:28px;

color:#fff;

box-shadow:0 12px 25px rgba(0,0,0,.15);

margin-bottom:25px;

}

.welcome-card h3{

font-weight:700;

margin-bottom:10px;

}

.welcome-card p{

margin:0;

opacity:.95;

}

.small-box{

border-radius:18px;

overflow:hidden;

transition:.3s;

box-shadow:0 10px 25px rgba(0,0,0,.08);

}

.small-box:hover{

transform:translateY(-6px);

box-shadow:0 18px 35px rgba(0,0,0,.18);

}

.small-box .icon{

font-size:70px;

top:15px;

opacity:.18;

}

.card{

border:none;

border-radius:18px;

box-shadow:0 10px 25px rgba(0,0,0,.08);

}

.card-header{

background:#fff;

border-bottom:1px solid #eee;

padding:18px 22px;

font-weight:600;

}

.table thead{

background:#0d6efd;

color:#fff;

}

.table tbody tr:hover{

background:#f8fbff;

transition:.2s;

}

.badge{

padding:7px 12px;

font-size:12px;

border-radius:20px;

}

</style>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h2 class="dashboard-title">

Dashboard Admin

</h2>

<p class="dashboard-subtitle">

Selamat datang kembali,

<b><?= $_SESSION['nama']; ?></b>

👋

</p>

<div class="welcome-card">

<h3>

<i class="fas fa-university"></i>

RoomBook STIKOM Yos Sudarso

</h3>

<p>

Kelola data ruangan, pengajuan peminjaman, laporan, dan aktivitas mahasiswa dalam satu dashboard.

</p>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="row">

<!-- ===========================
TOTAL RUANGAN
=========================== -->

<div class="col-lg-4 col-md-6">

<div class="small-box bg-gradient-info">

<div class="inner">

<h3><?= $totalRuangan ?></h3>

<p>Total Ruangan</p>

</div>

<div class="icon">

<i class="fas fa-door-open"></i>

</div>

</div>

</div>

<!-- ===========================
TOTAL MAHASISWA
=========================== -->

<div class="col-lg-4 col-md-6">

<div class="small-box bg-gradient-primary">

<div class="inner">

<h3><?= $totalMahasiswa ?></h3>

<p>Total Mahasiswa</p>

</div>

<div class="icon">

<i class="fas fa-user-graduate"></i>

</div>

</div>

</div>

<!-- ===========================
TOTAL BOOKING
=========================== -->

<div class="col-lg-4 col-md-6">

<div class="small-box bg-gradient-success">

<div class="inner">

<h3><?= $totalBooking ?></h3>

<p>Total Pengajuan</p>

</div>

<div class="icon">

<i class="fas fa-calendar-check"></i>

</div>

</div>

</div>

<!-- ===========================
PENDING
=========================== -->

<div class="col-lg-4 col-md-6">

<div class="small-box bg-gradient-warning">

<div class="inner">

<h3><?= $totalPending ?></h3>

<p>Menunggu Persetujuan</p>

</div>

<div class="icon">

<i class="fas fa-hourglass-half"></i>

</div>

</div>

</div>

<!-- ===========================
APPROVED
=========================== -->

<div class="col-lg-4 col-md-6">

<div class="small-box bg-gradient-success">

<div class="inner">

<h3><?= $totalApproved ?></h3>

<p>Disetujui</p>

</div>

<div class="icon">

<i class="fas fa-check-circle"></i>

</div>

</div>

</div>

<!-- ===========================
REJECTED
=========================== -->

<div class="col-lg-4 col-md-6">

<div class="small-box bg-gradient-danger">

<div class="inner">

<h3><?= $totalRejected ?></h3>

<p>Ditolak</p>

</div>

<div class="icon">

<i class="fas fa-times-circle"></i>

</div>

</div>

</div>

</div>

<!-- ===========================
RINGKASAN
=========================== -->

<div class="row mt-2">

<div class="col-lg-12">

<div class="card">

<div class="card-body">

<div class="row text-center">

<div class="col-md-3">

<h4 class="text-primary">

<?= $totalBooking ?>

</h4>

<p>Total Pengajuan</p>

</div>

<div class="col-md-3">

<h4 class="text-warning">

<?= $totalPending ?>

</h4>

<p>Pending</p>

</div>

<div class="col-md-3">

<h4 class="text-success">

<?= $totalApproved ?>

</h4>

<p>Approved</p>

</div>

<div class="col-md-3">

<h4 class="text-danger">

<?= $totalRejected ?>

</h4>

<p>Rejected</p>

</div>

</div>

</div>

</div>

</div>

</div>

<!-- ===========================
PENGAJUAN TERBARU
=========================== -->

<div class="card mt-4">

<div class="card-header">

<h3 class="card-title">

<i class="fas fa-history text-primary"></i>

5 Pengajuan Terbaru

</h3>

</div>

<div class="card-body table-responsive">

<table class="table table-hover">

<thead>

<tr>

<th>Mahasiswa</th>

<th>Ruangan</th>

<th>Tanggal</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php while($row=mysqli_fetch_assoc($bookingTerbaru)){ ?>

<tr>

<td><?= $row['nama']; ?></td>

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

class="btn btn-sm btn-info">

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
GRAFIK
=========================== -->

<div class="card">

<div class="card-header">

<h3 class="card-title">

<i class="fas fa-chart-bar text-success"></i>

Grafik Pengajuan Tahun <?= date('Y'); ?>

</h3>

</div>

<div class="card-body">

<canvas id="bookingChart" height="90"></canvas>

</div>

</div>

</div>

</section>

</div>

<?php

include '../includes/admin/footer.php';

include '../includes/admin/scripts.php';

?>

<script>

const ctx=document.getElementById('bookingChart');

new Chart(ctx,{

type:'bar',

data:{

labels:[<?= "'".implode("','",$label)."'" ?>],

datasets:[{

label:'Jumlah Pengajuan',

data:[<?= implode(",",$nilai); ?>],

backgroundColor:[
'#0d6efd',
'#198754',
'#ffc107',
'#dc3545',
'#6610f2',
'#20c997',
'#fd7e14',
'#6f42c1',
'#0dcaf0',
'#198754',
'#0d6efd',
'#ffc107'
],

borderRadius:10,

borderSkipped:false

}]

},

options:{

responsive:true,

plugins:{

legend:{

display:false

}

},

scales:{

y:{

beginAtZero:true,

ticks:{

precision:0

}

},

x:{

grid:{

display:false

}

}

}

}

});

</script>