<?php
session_start();
if ($_SESSION['role']!='admin') { header("Location: ../index.php"); exit; }
include "../koneksi.php";

if(isset($_POST['simpan'])){
    mysqli_query($koneksi,"INSERT INTO instruktur VALUES(
        NULL,
        '$_POST[nama]',
        '$_POST[username]',
        '$_POST[password]',
        '$_POST[no_hp]',
        '$_POST[keahlian]'
    )");
    header("Location: instruktur.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Tambah Instruktur</title>
<style>
body{font-family:Arial;background:#f4f4f4}
form{
    background:white;
    width:400px;
    margin:60px auto;
    padding:30px;
    border-radius:12px;
}
input,button{
    width:100%;
    padding:10px;
    margin:8px 0;
}
button{background:#1e90ff;color:white;border:none}
</style>
</head>
<body>

<form method="post">
<h2>Tambah Instruktur</h2>
<input name="nama" placeholder="Nama" required>
<input name="username" placeholder="Username" required>
<input name="password" placeholder="Password" required>
<input name="no_hp" placeholder="No HP" required>
<input name="keahlian" placeholder="Keahlian" required>
<button name="simpan">Simpan</button>
</form>

</body>
</html>
