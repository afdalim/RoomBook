<?php

include '../../auth/cek_login.php';

if($_SESSION['role'] != 'admin'){
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$idUser=$_SESSION['id_user'];

$query=mysqli_query($conn,"
SELECT *
FROM users
WHERE id_user='$idUser'
");

$data=mysqli_fetch_assoc($query);

include '../../includes/admin/header.php';
include '../../includes/admin/navbar.php';
include '../../includes/admin/sidebar.php';

?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h2 class="mt-3">

<i class="fas fa-user-shield text-primary"></i>

Profil Admin

</h2>

<p class="text-muted">

Informasi akun administrator RoomBook

</p>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="row">

<div class="col-lg-4">

<div class="card">

<div class="card-body text-center">

<img

src="https://ui-avatars.com/api/?name=<?= urlencode($data['nama']); ?>&background=0D6EFD&color=fff&size=220&bold=true"

class="rounded-circle shadow"

style="width:170px;height:170px;">

<h3 class="mt-3">

<?= $data['nama']; ?>

</h3>

<span class="badge badge-danger">

Administrator

</span>

<hr>

<p class="text-muted">

Terdaftar sejak

</p>

<b>

<?= date('d F Y',strtotime($data['created_at'])); ?>

</b>

<br><br>

<a
href="edit.php"
class="btn btn-primary btn-block">

<i class="fas fa-user-edit"></i>

Edit Profil

</a>

<br>

<a
href="edit.php#password"
class="btn btn-outline-danger btn-block mt-2">

<i class="fas fa-key"></i>

Ganti Password

</a>

</div>

</div>

</div>

<div class="col-lg-8">

<div class="card">

<div class="card-header bg-primary">

<h5 class="mb-0 text-white">

<i class="fas fa-id-card"></i>

Informasi Admin

</h5>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="220">

Nama

</th>

<td>

<?= $data['nama']; ?>

</td>

</tr>

<tr>

<th>

Email

</th>

<td>

<?= $data['email']; ?>

</td>

</tr>

<tr>

<th>

Nomor HP

</th>

<td>

<?= $data['no_hp']; ?>

</td>

</tr>

<tr>

<th>

Role

</th>

<td>

<span class="badge badge-danger">

Administrator

</span>

</td>

</tr>

<tr>

<th>

Tanggal Bergabung

</th>

<td>

<?= date('d F Y H:i',strtotime($data['created_at'])); ?>

</td>

</tr>

</table>

</div>

</div>

<div class="row">

<div class="col-md-4">

<div class="small-box bg-primary">

<div class="inner">

<h4>

Admin

</h4>

<p>Status</p>

</div>

<div class="icon">

<i class="fas fa-user-shield"></i>

</div>

</div>

</div>

<div class="col-md-4">

<div class="small-box bg-success">

<div class="inner">

<h4>

<?= $data['email']; ?>

</h4>

<p>Email</p>

</div>

<div class="icon">

<i class="fas fa-envelope"></i>

</div>

</div>

</div>

<div class="col-md-4">

<div class="small-box bg-info">

<div class="inner">

<h4>

<?= $data['no_hp']; ?>

</h4>

<p>No HP</p>

</div>

<div class="icon">

<i class="fas fa-phone"></i>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</section>

</div>

<?php

include '../../includes/admin/footer.php';
include '../../includes/admin/scripts.php';

?>