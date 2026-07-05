<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>RoomBook | Admin Panel</title>

<link rel="icon" href="/roombook/assets/img/logo_roombook.png">

<!-- Google Font -->

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Font Awesome -->

<link rel="stylesheet" href="/roombook/assets/adminlte/plugins/fontawesome-free/css/all.min.css">

<!-- AdminLTE -->

<link rel="stylesheet" href="/roombook/assets/adminlte/dist/css/adminlte.min.css">
<link rel="stylesheet"
href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet"
href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

<style>

.main-header{

box-shadow:0 3px 12px rgba(0,0,0,.08);

}

.main-header .nav-link{

display:flex;

align-items:center;

}

.dropdown-menu{

border:none;

border-radius:14px;

box-shadow:0 12px 30px rgba(0,0,0,.12);

}

.dropdown-item{

padding:10px 18px;

}

.dropdown-item:hover{

background:#f5f8ff;

}

</style>

<style>

*{
    font-family:'Poppins',sans-serif;
}

/* Background */

body{

    background:#f4f6f9;

}

/* Navbar */

.main-header{

    border:none;

    box-shadow:0 2px 12px rgba(0,0,0,.08);

}

/* Sidebar */

.main-sidebar{

    background:linear-gradient(180deg,#0d6efd,#1d4ed8);

}

.brand-link{

    background:transparent;

    border-bottom:1px solid rgba(255,255,255,.15);

}

.brand-link span{

    color:white;

    font-weight:700;

    font-size:20px;

}

.nav-sidebar .nav-link{

    color:#ecf0f1;

    border-radius:10px;

    margin:4px 10px;

    transition:.25s;

}

.nav-sidebar .nav-link:hover{

    background:rgba(255,255,255,.18);

}

.nav-sidebar .nav-link.active{

    background:white;

    color:#0d6efd !important;

    font-weight:600;

}

/* Card */

.card{

    border:none;

    border-radius:18px;

    box-shadow:0 8px 25px rgba(0,0,0,.08);

}

.card-header{

    background:white;

    border:none;

    font-weight:600;

}

/* Button */

.btn{

    border-radius:30px;

    font-weight:600;

    padding:8px 20px;

}

/* Table */

.table thead{

    background:#0d6efd;

    color:white;

}

.table{

    border-radius:12px;

    overflow:hidden;

}

/* Small Box */

.small-box{

    border-radius:18px;

    box-shadow:0 10px 25px rgba(0,0,0,.08);

}

.small-box .icon{

    top:15px;

    font-size:55px;

}

/* Badge */

.badge{

    padding:7px 14px;

    border-radius:20px;

    font-size:12px;

}

/* Content */

.content-wrapper{

    background:#f4f6f9;

}

/* Scroll */

::-webkit-scrollbar{

    width:8px;

}

::-webkit-scrollbar-thumb{

    background:#0d6efd;

    border-radius:20px;

}

</style>

<style>

.brand-link{

height:65px;

display:flex;

align-items:center;

}

.brand-text{

font-size:22px;

}

.nav-sidebar .nav-link{

border-radius:10px;

margin-bottom:5px;

transition:.25s;

}

.nav-sidebar .nav-link:hover{

background:#0d6efd;

color:white;

}

.user-panel{

border-bottom:1px solid rgba(255,255,255,.15);

}

.user-panel img{

width:42px;

height:42px;

}

.user-panel .info{

padding-top:2px;

}

.main-sidebar{

box-shadow:3px 0 15px rgba(0,0,0,.12);

}

</style>

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

<div class="wrapper">