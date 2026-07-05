<?php

include '../../config/koneksi.php';

$id=$_GET['id'];

mysqli_query($conn,
"DELETE FROM rooms WHERE id_room='$id'");

header("Location:index.php");