<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM mobil WHERE mobil_id='$id'");
$m = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $tipe = $_POST['tipe'];
    $transmisi = $_POST['transmisi'];
    $plat = $_POST['plat'];
    $status = $_POST['status'];
    
    // Handle file upload
    if (!empty($_FILES['foto']['name'])) {
        $foto = time() . '_' . $_FILES['foto']['name'];
        $path = "../assets/img/mobil/" . $foto;
        
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $path)) {
            mysqli_query($koneksi, "UPDATE mobil SET
                nama_mobil='$nama',
                tipe='$tipe',
                transmisi='$transmisi',
                plat_nomor='$plat',
                status='$status',
                foto='$foto'
                WHERE mobil_id='$id'
            ");
        }
    } else {
        mysqli_query($koneksi, "UPDATE mobil SET
            nama_mobil='$nama',
            tipe='$tipe',
            transmisi='$transmisi',
            plat_nomor='$plat',
            status='$status'
            WHERE mobil_id='$id'
        ");
    }
    header("Location: mobil.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Mobil</title>

<style>
body {
    background:
        linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)),
        url('../assets/img/bg_kursus.jpg');
    background-size: cover;
    font-family: Arial;
}

.form {
    width: 420px;
    margin: 60px auto;
    background: white;
    padding: 25px;
    border-radius: 12px;
}

input, select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
}

.foto-preview {
    width: 100%;
    max-width: 200px;
    height: 150px;
    object-fit: cover;
    border-radius: 6px;
    border: 2px solid #1e90ff;
    margin-bottom: 10px;
}

button {
    padding: 10px;
    width: 100%;
    background: orange;
    color: white;
    border: none;
    border-radius: 6px;
}
</style>
</head>

<body>

<div class="form">
<h3>Edit Data Mobil</h3>

<?php 
$foto = isset($m['foto']) && !empty($m['foto']) ? '../assets/img/mobil/'.$m['foto'] : '../assets/img/default-car.svg';
?>
<img src="<?= $foto; ?>" alt="Foto Mobil" class="foto-preview">

<form method="post" enctype="multipart/form-data">
<input type="text" name="nama" value="<?= $m['nama_mobil']; ?>" required>
<input type="text" name="tipe" value="<?= $m['tipe']; ?>" required>

<select name="transmisi">
    <option <?= $m['transmisi']=='Manual'?'selected':''; ?>>Manual</option>
    <option <?= $m['transmisi']=='Matic'?'selected':''; ?>>Matic</option>
</select>

<input type="text" name="plat" value="<?= $m['plat_nomor']; ?>" required>

<select name="status">
    <option <?= $m['status']=='Tersedia'?'selected':''; ?>>Tersedia</option>
    <option <?= $m['status']=='Dipakai'?'selected':''; ?>>Dipakai</option>
</select>

<input type="file" name="foto" accept="image/*">

<button name="update">Update</button>
</form>
</div>

</body>
</html>
