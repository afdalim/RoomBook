<?php

include '../../auth/cek_login.php';

if($_SESSION['role']!='admin'){
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$tanggalAwal="";
$tanggalAkhir="";

$where="";

if(isset($_GET['filter'])){

    $tanggalAwal=$_GET['tanggal_awal'];
    $tanggalAkhir=$_GET['tanggal_akhir'];

    $where="WHERE tanggal BETWEEN '$tanggalAwal' AND '$tanggalAkhir'";

}

/* ======================
STATISTIK
====================== */

$total=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total
FROM bookings
$where
"));

$pending=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total
FROM bookings
$where
".($where=="" ? " WHERE " : " AND ")."
status='Pending'
"));

$approved=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total
FROM bookings
$where
".($where=="" ? " WHERE " : " AND ")."
status='Approved'
"));

$rejected=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total
FROM bookings
$where
".($where=="" ? " WHERE " : " AND ")."
status='Rejected'
"));

/* ======================
DATA
====================== */

$data=mysqli_query($conn,"
SELECT

b.*,

u.nama,

u.nim,

r.nama_ruang

FROM bookings b

JOIN users u
ON b.id_user=u.id_user

JOIN rooms r
ON b.id_room=r.id_room

$where

ORDER BY tanggal DESC,jam_mulai ASC
");

include '../../includes/admin/header.php';
include '../../includes/admin/navbar.php';
include '../../includes/admin/sidebar.php';

?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h2 class="mt-3">

Laporan Peminjaman Ruangan

</h2>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<h4>Filter Laporan</h4>

</div>

<div class="card-body">

<form method="GET">

<div class="row">

<div class="col-md-4">

<label>Tanggal Awal</label>

<input
type="date"
name="tanggal_awal"
class="form-control"
value="<?= $tanggalAwal ?>"
required>

</div>

<div class="col-md-4">

<label>Tanggal Akhir</label>

<input
type="date"
name="tanggal_akhir"
class="form-control"
value="<?= $tanggalAkhir ?>"
required>

</div>

<div class="col-md-4">

<label>&nbsp;</label>

<br>

<button
name="filter"
class="btn btn-primary">

<i class="fas fa-search"></i>

Tampilkan

</button>

<a
href="index.php"
class="btn btn-secondary">

Reset

</a>

</div>

</div>

</form>

</div>

</div>

<div class="row">

<div class="col-md-3">

<div class="small-box bg-info">

<div class="inner">

<h3><?= $total['total']; ?></h3>

<p>Total Pengajuan</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="small-box bg-warning">

<div class="inner">

<h3><?= $pending['total']; ?></h3>

<p>Pending</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="small-box bg-success">

<div class="inner">

<h3><?= $approved['total']; ?></h3>

<p>Approved</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="small-box bg-danger">

<div class="inner">

<h3><?= $rejected['total']; ?></h3>

<p>Rejected</p>

</div>

</div>

</div>

</div>

<div class="card">

<div class="card-header">

<h4>

Data Laporan

</h4>

</div>

<div class="card-body table-responsive">

<table class="table table-striped table-hover datatable">

<thead>

<tr>

<th>No</th>

<th>Tanggal</th>

<th>Mahasiswa</th>

<th>NIM</th>

<th>Ruangan</th>

<th>Kegiatan</th>

<th>Jam</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($d=mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++ ?></td>

<td><?= date('d-m-Y',strtotime($d['tanggal'])) ?></td>

<td><?= $d['nama'] ?></td>

<td><?= $d['nim'] ?></td>

<td><?= $d['nama_ruang'] ?></td>

<td><?= $d['nama_kegiatan'] ?></td>

<td>

<?= date('H:i',strtotime($d['jam_mulai'])) ?>

-

<?= date('H:i',strtotime($d['jam_selesai'])) ?>

</td>

<td>

<?php

if($d['status']=="Pending"){

echo "<span class='badge badge-warning'>Pending</span>";

}elseif($d['status']=="Approved"){

echo "<span class='badge badge-success'>Approved</span>";

}else{

echo "<span class='badge badge-danger'>Rejected</span>";

}

?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

<?php

if($tanggalAwal!=""){

?>

<a

href="cetak.php?tanggal_awal=<?= $tanggalAwal ?>&tanggal_akhir=<?= $tanggalAkhir ?>"

class="btn btn-danger">

<i class="fas fa-file-pdf"></i>

Cetak PDF

</a>

<?php } ?>

</div>

</section>

</div>

<?php

include '../../includes/admin/footer.php';
include '../../includes/admin/scripts.php';

?>