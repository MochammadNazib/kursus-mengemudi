<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}
include "../koneksi.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(
    mysqli_query($koneksi,"SELECT * FROM tes WHERE tes_id='$id'")
);

if(isset($_POST['update'])){
    mysqli_query($koneksi,"UPDATE tes SET
        soal='$_POST[soal]',
        a='$_POST[a]',
        b='$_POST[b]',
        c='$_POST[c]',
        d='$_POST[d]',
        jawaban='$_POST[jawaban]'
        WHERE tes_id='$id'
    ");
    header("Location: tes.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Tes</title>
<style>
body{
background:linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
url('../assets/img/bg_kursus.jpg');
background-size:cover;
font-family:Arial;
}
.form{
width:500px;margin:60px auto;
background:white;padding:25px;
border-radius:12px;
}
input,textarea,select,button{
width:100%;padding:8px;margin-bottom:10px;
}
button{
background:orange;color:white;border:none;
border-radius:6px;
}

</style>
</head>

<body>
<div class="form">
<h3>Edit Soal Tes</h3>

<form method="post">
<textarea name="soal" required><?= $data['soal'] ?></textarea>
<input type="text" name="a" value="<?= $data['a'] ?>" required>
<input type="text" name="b" value="<?= $data['b'] ?>" required>
<input type="text" name="c" value="<?= $data['c'] ?>" required>
<input type="text" name="d" value="<?= $data['d'] ?>" required>

<select name="jawaban">
<option <?=($data['jawaban']=='A')?'selected':''?>>A</option>
<option <?=($data['jawaban']=='B')?'selected':''?>>B</option>
<option <?=($data['jawaban']=='C')?'selected':''?>>C</option>
<option <?=($data['jawaban']=='D')?'selected':''?>>D</option>
</select>

<button name="update">Update</button>
</form>
</div>
</body>
</html>
