<?php
include '../../auth/cek_login.php';

if($_SESSION['role']!='admin'){
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM rooms WHERE id_room='$id'");
$row = mysqli_fetch_assoc($data);

include '../../includes/admin/header.php';
include '../../includes/admin/navbar.php';
include '../../includes/admin/sidebar.php';
?>

<div class="content-wrapper">

<section class="content">

<div class="container-fluid pt-3">

<div class="card">

<div class="card-header">
<h4>Edit Ruangan</h4>
</div>

<div class="card-body">

<form action="proses_edit.php" method="POST">

<input type="hidden" name="id_room" value="<?= $row['id_room']; ?>">

<div class="mb-3">
<label>Nama Ruangan</label>
<input type="text"
class="form-control"
name="nama_ruang"
value="<?= $row['nama_ruang']; ?>"
required>
</div>

<div class="mb-3">
<label>Lokasi</label>
<input type="text"
class="form-control"
name="lokasi"
value="<?= $row['lokasi']; ?>"
required>
</div>

<div class="mb-3">
<label>Kapasitas</label>
<input type="number"
class="form-control"
name="kapasitas"
value="<?= $row['kapasitas']; ?>"
required>
</div>

<div class="mb-3">
<label>Fasilitas</label>
<textarea
class="form-control"
name="fasilitas"
rows="4"><?= $row['fasilitas']; ?></textarea>
</div>

<div class="mb-3">
<label>Status</label>

<select name="status" class="form-control">

<option value="tersedia"
<?= $row['status']=="tersedia" ? "selected" : "" ?>>

Tersedia

</option>

<option value="maintenance"
<?= $row['status']=="maintenance" ? "selected" : "" ?>>

Maintenance

</option>

</select>

</div>

<button class="btn btn-success">

Update

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