<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'peserta') {
    header("Location: login.php");
    exit;
}
include "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tes Online</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    margin:0;
    font-family:Arial;
    background:linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
    url('../assets/img/bg_kursus.jpg') center/cover fixed;
}
.card{
    background:white;
    width:800px;
    margin:40px auto;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,.3);
}
h2{
    text-align:center;
    color:#1e90ff;
}
.soal{
    margin-bottom:25px;
    padding:15px;
    border-radius:10px;
    background:#f7f9fc;
}
.soal b{color:#333;}
label{
    display:block;
    margin:6px 0;
}
button{
    width:100%;
    padding:14px;
    background:#1e90ff;
    color:white;
    border:none;
    border-radius:10px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}
button:hover{background:#0d47a1;}
</style>
</head>

<body>
<div class="card">
<h2><i class="fa fa-pen"></i> Tes Online Kursus Mengemudi</h2>

<form action="proses_tes.php" method="post">
<?php
$no=1;
$q=mysqli_query($koneksi,"SELECT * FROM tes");
while($t=mysqli_fetch_assoc($q)){
?>
<div class="soal">
<b><?= $no++ ?>. <?= $t['soal'] ?></b>

<label><input type="radio" name="jawaban[<?= $t['tes_id'] ?>]" value="A" required> <?= $t['a'] ?></label>
<label><input type="radio" name="jawaban[<?= $t['tes_id'] ?>]" value="B"> <?= $t['b'] ?></label>
<label><input type="radio" name="jawaban[<?= $t['tes_id'] ?>]" value="C"> <?= $t['c'] ?></label>
<label><input type="radio" name="jawaban[<?= $t['tes_id'] ?>]" value="D"> <?= $t['d'] ?></label>
</div>
<?php } ?>

<button type="submit">Selesai Tes</button>
</form>
</div>
</body>
</html>
