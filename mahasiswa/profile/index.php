<?php

include '../../auth/cek_login.php';

if($_SESSION['role'] != 'mahasiswa'){
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$idUser = $_SESSION['id_user'];

$query = mysqli_query($conn,"
SELECT *
FROM users
WHERE id_user='$idUser'
");

$data = mysqli_fetch_assoc($query);

include '../../includes/mahasiswa/header.php';
include '../../includes/mahasiswa/navbar.php';
include '../../includes/mahasiswa/sidebar.php';

?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h2 class="mt-3">

<i class="fas fa-user-circle text-primary"></i>

Profil Mahasiswa

</h2>

<p class="text-muted">

Informasi akun RoomBook Anda

</p>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="row">

<!-- FOTO -->

<div class="col-lg-4">

<div class="card">

<div class="card-body text-center">

<img

src="https://ui-avatars.com/api/?name=<?= urlencode($data['nama']); ?>&background=0D6EFD&color=ffffff&size=220&bold=true"

class="rounded-circle shadow"

style="width:170px;height:170px;">

<h3 class="mt-3">

<?= $data['nama']; ?>

</h3>

<span class="badge badge-primary">

<?= ucfirst($data['role']); ?>

</span>

<hr>

<p class="text-muted mb-1">

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

<!-- DATA -->

<div class="col-lg-8">

<div class="card">

<div class="card-header bg-primary">

<h5 class="mb-0 text-white">

<i class="fas fa-id-card"></i>

Informasi Mahasiswa

</h5>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="220">

Nama Lengkap

</th>

<td>

<?= $data['nama']; ?>

</td>

</tr>

<tr>

<th>

NIM

</th>

<td>

<?= $data['nim']; ?>

</td>

</tr>

<tr>

<th>

Program Studi

</th>

<td>

<?= $data['prodi']; ?>

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

<span class="badge badge-success">

<?= ucfirst($data['role']); ?>

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

<!-- CARD INFO -->

<div class="row">

<div class="col-md-4">

<div class="small-box bg-info">

<div class="inner">

<h4>

<?= $data['nim']; ?>

</h4>

<p>NIM</p>

</div>

<div class="icon">

<i class="fas fa-id-card"></i>

</div>

</div>

</div>

<div class="col-md-4">

<div class="small-box bg-success">

<div class="inner">

<h4>

<?= $data['prodi']; ?>

</h4>

<p>Program Studi</p>

</div>

<div class="icon">

<i class="fas fa-graduation-cap"></i>

</div>

</div>

</div>

<div class="col-md-4">

<div class="small-box bg-warning">

<div class="inner">

<h4>

<?= ucfirst($data['role']); ?>

</h4>

<p>Status Akun</p>

</div>

<div class="icon">

<i class="fas fa-user-check"></i>

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

include '../../includes/mahasiswa/footer.php';
include '../../includes/mahasiswa/scripts.php';

?>