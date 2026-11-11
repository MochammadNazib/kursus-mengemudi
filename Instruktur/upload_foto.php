<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['instruktur_id'])) {
    header("Location: login.php");
    exit;
}

$instruktur_id = $_SESSION['instruktur_id'];

if (!empty($_FILES['foto']['name'])) {

    $foto = time().'_'.$_FILES['foto']['name'];
    $path = "../assets/img/instruktur/".$foto;

    move_uploaded_file($_FILES['foto']['tmp_name'], $path);

    mysqli_query($koneksi,"
        UPDATE instruktur SET foto='$foto'
        WHERE instruktur_id='$instruktur_id'
    ");

    $_SESSION['foto'] = $foto;
}

header("Location: dashboard.php");
