<?php
session_start();
if ($_SESSION['role']!='admin') { header("Location: ../index.php"); exit; }
include "../koneksi.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(
    mysqli_query($koneksi,"SELECT * FROM instruktur WHERE instruktur_id='$id'")
);

if(isset($_POST['update'])){
    mysqli_query($koneksi,"UPDATE instruktur SET
        nama_instruktur='$_POST[nama]',
        no_hp='$_POST[no_hp]',
        keahlian='$_POST[keahlian]'
        WHERE instruktur_id='$id'
    ");
    header("Location: instruktur.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Instruktur</title>
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
button{background:orange;color:white;border:none}
</style>
</head>
<body>

<form method="post">
<h2>Edit Instruktur</h2>
<input name="nama" value="<?= $data['nama_instruktur'] ?>">
<input name="no_hp" value="<?= $data['no_hp'] ?>">
<input name="keahlian" value="<?= $data['keahlian'] ?>">
<button name="update">Update</button>
</form>

</body>
</html>
