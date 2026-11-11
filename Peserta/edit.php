<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}
include "../koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM peserta WHERE peserta_id='$id'");
$p = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    mysqli_query($koneksi, "UPDATE peserta SET
        nama_peserta='$_POST[nama]',
        username='$_POST[username]',
        password='$_POST[password]',
        no_hp='$_POST[no_hp]',
        alamat='$_POST[alamat]',
        status='$_POST[status]'
        WHERE peserta_id='$id'
    ");
    header("Location: peserta.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Peserta</title>
<style>
body {
    background:
        linear-gradient(rgba(0,0,0,.65), rgba(0,0,0,.65)),
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
input, select, button {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
}
button {
    background: orange;
    color: white;
    border: none;
    border-radius: 6px;
}
</style>
</head>

<body>
<div class="form">
<h3>Edit Peserta</h3>
<form method="post">
<input type="text" name="nama" value="<?= $p['nama_peserta']; ?>" required>
<input type="text" name="username" value="<?= $p['username']; ?>" required>
<input type="text" name="password" value="<?= $p['password']; ?>" required>
<input type="text" name="no_hp" value="<?= $p['no_hp']; ?>" required>
<input type="text" name="alamat" value="<?= $p['alamat']; ?>" required>

<select name="status">
    <option <?= $p['status']=='Aktif'?'selected':''; ?>>Aktif</option>
    <option <?= $p['status']=='Nonaktif'?'selected':''; ?>>Nonaktif</option>
</select>

<button name="update">Update</button>
</form>
</div>
</body>
</html>
