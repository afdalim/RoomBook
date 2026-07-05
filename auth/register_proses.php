<?php

include '../config/koneksi.php';

$nama = $_POST['nama'];
$nim = $_POST['nim'];
$prodi = $_POST['prodi'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$password = $_POST['password'];
$konfirmasi = $_POST['konfirmasi'];

if($password != $konfirmasi){

    echo "
    <script>
        alert('Konfirmasi password tidak sesuai!');
        window.location='register.php';
    </script>
    ";

    exit;
}

// Baru di-hash setelah password dan konfirmasi cocok
$password = password_hash($password, PASSWORD_DEFAULT);

$cek_email = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$email'"
);

if(mysqli_num_rows($cek_email) > 0){

    echo "
    <script>
        alert('Email sudah digunakan!');
        window.location='register.php';
    </script>
    ";

    exit;
}

$cek_nim = mysqli_query($conn,
    "SELECT * FROM users WHERE nim='$nim'"
);

if(mysqli_num_rows($cek_nim) > 0){

    echo "
    <script>
        alert('NIM sudah terdaftar!');
        window.location='register.php';
    </script>
    ";

    exit;
}

$query = mysqli_query($conn,

"INSERT INTO users
(
nama,
nim,
prodi,
email,
no_hp,
password,
role
)

VALUES

(
'$nama',
'$nim',
'$prodi',
'$email',
'$no_hp',
'$password',
'mahasiswa'
)

");

if($query){

    echo "
    <script>
        alert('Registrasi berhasil!');
        window.location='login.php';
    </script>
    ";

}else{

    echo "
    <script>
        alert('Registrasi gagal!');
        window.location='register.php';
    </script>
    ";

}