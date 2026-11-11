<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php";

$id = $_GET['id'];
mysqli_query($koneksi,"DELETE FROM tes WHERE tes_id='$id'");
header("Location: tes.php");
