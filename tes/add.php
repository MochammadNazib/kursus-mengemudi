<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}
include "../koneksi.php";

if(isset($_POST['simpan'])){
    mysqli_query($koneksi,"INSERT INTO tes VALUES(
        NULL,
        '$_POST[soal]',
        '$_POST[a]',
        '$_POST[b]',
        '$_POST[c]',
        '$_POST[d]',
        '$_POST[jawaban]'
    )");
    header("Location: tes.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Tes</title>
<style>
body{
background:linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
url('../assets/img/bg_kursus.jpg');
background-size:cover;
font-family:Arial;
}
.form{
width:500px;
margin:60px auto;
background:white;
padding:25px;
border-radius:12px;
}
input,textarea,select,button{
width:100%;
padding:8px;
margin-bottom:10px;
}
button{
background:#28a745;
color:white;
border:none;
border-radius:6px;
}
</style>
</head>

<body>
<div class="form">
<h3>Tambah Soal Tes</h3>

<form method="post">
<textarea name="soal" placeholder="Soal" required></textarea>
<input type="text" name="a" placeholder="Jawaban A" required>
<input type="text" name="b" placeholder="Jawaban B" required>
<input type="text" name="c" placeholder="Jawaban C" required>
<input type="text" name="d" placeholder="Jawaban D" required>

<select name="jawaban">
<option>A</option>
<option>B</option>
<option>C</option>
<option>D</option>
</select>

<button name="simpan">Simpan</button>
</form>
</div>
</body>
</html>
