<?php
include "../koneksi.php";

$id = $_GET['id'];
$status = $_GET['s'];

mysqli_query($koneksi,"
UPDATE pembayaran SET status='$status'
WHERE pembayaran_id='$id'
");

header("Location: pembayaran.php");
