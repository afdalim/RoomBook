<?php

include '../../auth/cek_login.php';

if($_SESSION['role']!='admin'){
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$query=mysqli_query($conn,"
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

ORDER BY b.created_at DESC
");

include '../../includes/admin/header.php';
include '../../includes/admin/navbar.php';
include '../../includes/admin/sidebar.php';

?>

<div class="content-wrapper">

<section class="content">

<div class="container-fluid pt-3">

<div class="card">

<div class="card-header">

<h3>Pengajuan Peminjaman</h3>

</div>

<div class="card-body">

<table class="table table-striped table-hover datatable">

<thead>

<tr>

<th>No</th>

<th>Mahasiswa</th>

<th>Ruangan</th>

<th>Tanggal</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($row=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++ ?></td>

<td>

<?= $row['nama']; ?>

<br>

<small><?= $row['nim']; ?></small>

</td>

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
href="detail.php?id=<?= $row['id_booking']; ?>"
class="btn btn-info btn-sm">

Detail

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</section>

</div>

<?php

include '../../includes/admin/footer.php';
include '../../includes/admin/scripts.php';

?>