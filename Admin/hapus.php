<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../koneksi.php";

/* CEK ID */
if(!isset($_GET['id'])){
    die("ID TIDAK ADA");
}

$id = $_GET['id'];

/* DELETE */
$hapus = mysqli_query($koneksi, "DELETE FROM admin WHERE admin_id='$id'");

if(!$hapus){
    die("GAGAL HAPUS: ".mysqli_error($koneksi));
}

header("location: admin.php");