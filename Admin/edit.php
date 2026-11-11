<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}
include "../koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM admin WHERE admin_id='$id'");
$a = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    mysqli_query($koneksi, "UPDATE admin SET
        nama_admin='$_POST[nama]',
        username='$_POST[username]',
        password='$_POST[password]',
        no_hp='$_POST[no_hp]',
        email='$_POST[email]'
        WHERE admin_id='$id'
    ");
    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Admin</title>
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
input, button {
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
<h3>Edit Admin</h3>
<form method="post">
<input type="text" name="nama" value="<?= $a['nama_admin']; ?>" required>
<input type="text" name="username" value="<?= $a['username']; ?>" required>
<input type="text" name="password" value="<?= $a['password']; ?>" required>
<input type="text" name="no_hp" value="<?= $a['no_hp']; ?>" required>
<input type="email" name="email" value="<?= $a['email']; ?>" required>
<button name="update">Update</button>
</form>
</div>
</body>
</html>
