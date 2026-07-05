<?php

include '../../auth/cek_login.php';

if($_SESSION['role'] != 'admin'){
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

include '../../includes/admin/header.php';
include '../../includes/admin/navbar.php';
include '../../includes/admin/sidebar.php';

?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h2 class="mt-3">

<i class="fas fa-user-edit text-primary"></i>

Edit Profil Admin

</h2>

<p class="text-muted">

Perbarui informasi akun RoomBook Anda.

</p>

</div>

</section>

<section class="content">

<div class="container-fluid">

<form action="update.php" method="POST">

<input
type="hidden"
name="id_user"
value="<?= $data['id_user']; ?>">

<div class="row">

<!-- FOTO -->

<div class="col-lg-4">

<div class="card">

<div class="card-body text-center">

<img

src="https://ui-avatars.com/api/?name=<?= urlencode($data['nama']); ?>&background=0D6EFD&color=fff&size=220&bold=true"

class="rounded-circle shadow"

style="width:170px;height:170px;">

<h4 class="mt-3">

<?= $data['nama']; ?>

</h4>

<span class="badge badge-primary">

<?= ucfirst($data['role']); ?>

</span>

<hr>

<p class="text-muted">

Avatar dibuat otomatis berdasarkan nama.

</p>

</div>

</div>

</div>

<!-- FORM -->

<div class="col-lg-8">

<div class="card">

<div class="card-header bg-primary">

<h5 class="mb-0 text-white">

<i class="fas fa-edit"></i>

Form Edit Profil

</h5>

</div>

<div class="card-body">

<div class="form-group">

<label>Nama Lengkap</label>

<input
type="text"
name="nama"
class="form-control"
required
value="<?= $data['nama']; ?>">

</div>


<div class="form-group">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required
value="<?= $data['email']; ?>">

</div>

<div class="form-group">

<label>Nomor HP</label>

<input
type="text"
name="no_hp"
class="form-control"
required
value="<?= $data['no_hp']; ?>">

</div>

<hr id="password">

<h5>

<i class="fas fa-lock text-danger"></i>

Ganti Password

</h5>

<p class="text-muted">

Kosongkan jika tidak ingin mengganti password.

</p>

<div class="form-group">

<label>Password Baru</label>

<input
type="password"
name="password"
class="form-control">

</div>

<div class="form-group">

<label>Konfirmasi Password</label>

<input
type="password"
name="konfirmasi"
class="form-control">

</div>

<br>

<button
type="submit"
class="btn btn-primary">

<i class="fas fa-save"></i>

Simpan Perubahan

</button>

<a
href="index.php"
class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

</div>

</div>

</div>

</div>

</form>

</div>

</section>

</div>

<?php

include '../../includes/mahasiswa/footer.php';
include '../../includes/mahasiswa/scripts.php';

?>