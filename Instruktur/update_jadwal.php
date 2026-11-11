<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role']!='instruktur') {
    header("Location: ../login.php");
    exit;
}

include "../koneksi.php";

$id   = $_GET['id'] ?? '';
$aksi = $_GET['aksi'] ?? '';

if($aksi=='setuju'){
    $approval='disetujui';
}elseif($aksi=='tolak'){
    $approval='ditolak';
}else{
    header("Location: jadwal.php");
    exit;
}

mysqli_query($koneksi,"
UPDATE jadwal 
SET approval='$approval'
WHERE jadwal_id='$id'
");

header("Location: jadwal.php");
