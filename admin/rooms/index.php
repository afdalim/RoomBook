<?php
include '../../auth/cek_login.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

include '../../includes/admin/header.php';
include '../../includes/admin/navbar.php';
include '../../includes/admin/sidebar.php';

$data = mysqli_query($conn, "SELECT * FROM rooms ORDER BY id_room ASC");
?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">

<h3>Data Ruangan</h3>

<a href="tambah.php" class="btn btn-primary mb-3">
    <i class="fas fa-plus"></i> Tambah Ruangan
</a>

<table class="table table-striped table-hover datatable">

<thead class="table-dark">
<tr>
    <th>No</th>
    <th>Nama Ruangan</th>
    <th>Lokasi</th>
    <th>Kapasitas</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>

<?php
$no = 1;

while($row = mysqli_fetch_assoc($data)){
?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['nama_ruang']; ?></td>

<td><?= $row['lokasi']; ?></td>

<td><?= $row['kapasitas']; ?> Orang</td>

<td>

<?php

if($row['status']=="tersedia"){

    echo "<span class='badge badge-success'>Tersedia</span>";

}else{

    echo "<span class='badge badge-warning'>Maintenance</span>";

}

?>

</td>

<td>

<a href="edit.php?id=<?= $row['id_room']; ?>"
class="btn btn-warning btn-sm">

<i class="fas fa-edit"></i>

</a>

<a href="hapus.php?id=<?= $row['id_room']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus?')">

<i class="fas fa-trash"></i>

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>
</section>

</div>

<?php
include '../../includes/admin/footer.php';
include '../../includes/admin/scripts.php';
?>