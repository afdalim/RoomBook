<?php

session_start();
include '../config/koneksi.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query($conn,
"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($query)==1){

    $user = mysqli_fetch_assoc($query);

    if(password_verify($password,$user['password'])){

        $_SESSION['login']=true;
        $_SESSION['id_user']=$user['id_user'];
        $_SESSION['nama']=$user['nama'];
        $_SESSION['role']=$user['role'];

        if($user['role']=="admin"){

            header("Location: ../admin/dashboard.php");

        }else{

            header("Location: ../mahasiswa/dashboard.php");

        }

    }else{

        echo "<script>
        alert('Password salah');
        window.location='login.php';
        </script>";

    }

}else{

    echo "<script>
    alert('Email tidak ditemukan');
    window.location='login.php';
    </script>";

}