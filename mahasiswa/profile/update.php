<?php

include '../../auth/cek_login.php';

if($_SESSION['role'] != 'mahasiswa'){
    header("Location: ../../auth/login.php");
    exit;
}

include '../../config/koneksi.php';

$idUser = $_SESSION['id_user'];

$nama    = mysqli_real_escape_string($conn, trim($_POST['nama']));
$prodi   = mysqli_real_escape_string($conn, trim($_POST['prodi']));
$email   = mysqli_real_escape_string($conn, trim($_POST['email']));
$no_hp   = mysqli_real_escape_string($conn, trim($_POST['no_hp']));

$password    = trim($_POST['password']);
$konfirmasi  = trim($_POST['konfirmasi']);

/* ===========================
   VALIDASI
=========================== */

if(empty($nama) || empty($prodi) || empty($email) || empty($no_hp)){

    echo "
    <script>
    alert('Semua data wajib diisi.');
    history.back();
    </script>
    ";

    exit;

}

if(!filter_var($email,FILTER_VALIDATE_EMAIL)){

    echo "
    <script>
    alert('Format email tidak valid.');
    history.back();
    </script>
    ";

    exit;

}

/* ===========================
   PASSWORD
=========================== */

if(!empty($password)){

    if($password != $konfirmasi){

        echo "
        <script>
        alert('Konfirmasi password tidak sama.');
        history.back();
        </script>
        ";

        exit;

    }

    $passwordHash = password_hash($password,PASSWORD_DEFAULT);

    mysqli_query($conn,"
    UPDATE users

    SET

    nama='$nama',
    prodi='$prodi',
    email='$email',
    no_hp='$no_hp',
    password='$passwordHash'

    WHERE id_user='$idUser'
    ");

}else{

    mysqli_query($conn,"
    UPDATE users

    SET

    nama='$nama',
    prodi='$prodi',
    email='$email',
    no_hp='$no_hp'

    WHERE id_user='$idUser'
    ");

}

/* ===========================
   UPDATE SESSION
=========================== */

$_SESSION['nama'] = $nama;

/* ===========================
   BERHASIL
=========================== */

echo "
<script>

alert('Profil berhasil diperbarui.');

window.location='index.php';

</script>
";

?>