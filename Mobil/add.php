<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
}
include "../koneksi.php";

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $tipe = $_POST['tipe'];
    $transmisi = $_POST['transmisi'];
    $plat = $_POST['plat'];
    $status = $_POST['status'];
    $foto = '';
    
    // Handle file upload
    if (!empty($_FILES['foto']['name'])) {
        $foto = time() . '_' . $_FILES['foto']['name'];
        $path = "../assets/img/mobil/" . $foto;
        move_uploaded_file($_FILES['foto']['tmp_name'], $path);
    }
    
    mysqli_query($koneksi, "INSERT INTO mobil VALUES (
        NULL,
        '$nama',
        '$tipe',
        '$transmisi',
        '$plat',
        '$status',
        '$foto'
    )");
    header("Location: mobil.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Mobil</title>
<style>
body {
    font-family: Arial;
    background: #f4f6f8;
}

.form {
    width: 400px;
    margin: 40px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
}

input, select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
}

button {
    padding: 10px;
    width: 100%;
    background: #27ae60;
    color: white;
    border: none;
    border-radius: 5px;
}
</style>
</head>

<body>
<div class="form">
<h3>Tambah Mobil</h3>

<form method="post" enctype="multipart/form-data">
<input type="text" name="nama" placeholder="Nama Mobil" required>
<input type="text" name="tipe" placeholder="Tipe Mobil" required>

<select name="transmisi">
    <option>Manual</option>
    <option>Matic</option>
</select>

<input type="text" name="plat" placeholder="Plat Nomor" required>

<select name="status">
    <option>Tersedia</option>
    <option>Dipakai</option>
</select>

<input type="file" name="foto" accept="image/*" placeholder="Upload Foto Mobil">

<button name="simpan">Simpan</button>
</form>
</div>
</body>
</html>
