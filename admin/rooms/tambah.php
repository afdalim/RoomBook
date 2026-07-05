<?php
include '../../auth/cek_login.php';

if($_SESSION['role']!='admin'){
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

include '../../includes/admin/header.php';
include '../../includes/admin/navbar.php';
include '../../includes/admin/sidebar.php';
?>

<div class="content-wrapper">

<section class="content">

<div class="container-fluid pt-3">

<div class="card">

<div class="card-header">

<h4>Tambah Ruangan</h4>

</div>

<div class="card-body">

<form action="proses_tambah.php" method="POST">

<div class="mb-3">

<label>Nama Ruangan</label>

<input
type="text"
name="nama_ruang"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Lokasi</label>

<input
type="text"
name="lokasi"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Kapasitas</label>

<input
type="number"
name="kapasitas"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Fasilitas</label>

<textarea
name="fasilitas"
class="form-control"
rows="3"></textarea>

</div>

<div class="mb-3">

<label>Status</label>

<select name="status" class="form-control">

    <option value="tersedia">Tersedia</option>

    <option value="maintenance">Maintenance</option>

</select>

</div>

<button class="btn btn-primary">

Simpan

</button>

<a href="index.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

</section>

</div>

<?php
include '../../includes/admin/footer.php';
include '../../includes/admin/scripts.php';
?>