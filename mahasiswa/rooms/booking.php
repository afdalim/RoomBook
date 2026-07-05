<?php

include '../../auth/cek_login.php';

include '../../config/koneksi.php';

$id=$_GET['id'];

$data=mysqli_query($conn,"SELECT * FROM rooms WHERE id_room='$id'");

$room=mysqli_fetch_assoc($data);

include '../../includes/mahasiswa/header.php';
include '../../includes/mahasiswa/navbar.php';
include '../../includes/mahasiswa/sidebar.php';

?>

<div class="content-wrapper">

<section class="content">

<div class="container-fluid pt-3">

<div class="card">

<div class="card-header">

<h3>

Booking
<?= $room['nama_ruang']; ?>

</h3>

</div>

<div class="card-body">

<form action="proses_booking.php" method="POST">

<input
type="hidden"
name="id_room"
value="<?= $room['id_room']; ?>">

<input
type="hidden"
name="id_user"
value="<?= $_SESSION['id_user']; ?>">

<div class="mb-3">

<label>Organisasi</label>

<input
type="text"
name="organisasi"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Nama Kegiatan</label>

<input
type="text"
name="nama_kegiatan"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Tanggal</label>

<input
type="date"
name="tanggal"
class="form-control"
required>

</div>

<div class="row">

<div class="col">

<label>Jam Mulai</label>

<input
type="time"
name="jam_mulai"
class="form-control"
required>

</div>

<div class="col">

<label>Jam Selesai</label>

<input
type="time"
name="jam_selesai"
class="form-control"
required>

</div>

</div>

<br>

<div class="mb-3">

<label>Jumlah Peserta</label>

<input
type="number"
name="jumlah_peserta"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Keperluan</label>

<textarea
name="keperluan"
class="form-control"
rows="4"></textarea>

</div>

<button
class="btn btn-success">

Ajukan Peminjaman

</button>

</form>

</div>

</div>

</div>

</section>

</div>

<?php

include '../../includes/mahasiswa/footer.php';
include '../../includes/mahasiswa/scripts.php';

?>