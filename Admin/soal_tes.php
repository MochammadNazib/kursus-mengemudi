<?php
session_start();
if ($_SESSION['role']!='admin') { header("Location: ../index.php"); exit; }
include "../koneksi.php";

/* TAMBAH */
if(isset($_POST['tambah'])){
    mysqli_query($koneksi,"INSERT INTO tes VALUES(
        NULL,
        '$_POST[soal]',
        '$_POST[a]',
        '$_POST[b]',
        '$_POST[c]',
        '$_POST[d]',
        '$_POST[jawaban]'
    )");
}

/* EDIT */
if(isset($_POST['update'])){
    mysqli_query($koneksi,"UPDATE tes SET
        soal='$_POST[soal]',
        a='$_POST[a]',
        b='$_POST[b]',
        c='$_POST[c]',
        d='$_POST[d]',
        jawaban='$_POST[jawaban]'
        WHERE tes_id='$_POST[id]'
    ");
}

/* HAPUS */
if(isset($_GET['hapus'])){
    mysqli_query($koneksi,"DELETE FROM tes WHERE tes_id='$_GET[hapus]'");
}

/* DATA EDIT */
$edit = null;
if(isset($_GET['edit'])){
    $edit = mysqli_fetch_assoc(
        mysqli_query($koneksi,"SELECT * FROM tes WHERE tes_id='$_GET[edit]'")
    );
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Soal Tes</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
/* STYLE SAMA */
body{margin:0;font-family:Arial;background:
linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
url('../assets/img/bg_kursus.jpg') center/cover;}
.navbar{background:#1e90ff;color:#fff;padding:15px 25px;
display:flex;justify-content:space-between;align-items:center}
.navbar a{color:#fff;text-decoration:none;margin-left:15px;font-weight:bold}
.container{padding:30px}
.card{background:#fff;padding:25px;border-radius:15px}
h2{color:#1e90ff;text-align:center}
table{width:100%;border-collapse:collapse}
th{background:#1e90ff;color:#fff;padding:10px}
td{padding:10px;border-bottom:1px solid #ddd;text-align:center}
.btn-edit{background:orange;color:#fff;padding:5px 8px;border-radius:5px;text-decoration:none}
.btn-delete{background:red;color:#fff;padding:5px 8px;border-radius:5px;text-decoration:none}
input,textarea,select{width:100%;padding:8px;margin:5px 0}
button{background:#1e90ff;color:#fff;border:none;padding:10px;border-radius:6px}
</style>
</head>

<body>
<div class="navbar">
<div><i class="fa fa-pen"></i> Soal Tes</div>
<div><a href="dashboard.php">Dashboard</a></div>
</div>

<div class="container">
<div class="card">

<h2><?= $edit?'Edit Soal':'Tambah Soal' ?></h2>

<form method="post">
<input type="hidden" name="id" value="<?= $edit['tes_id'] ?? '' ?>">
<textarea name="soal" required><?= $edit['soal'] ?? '' ?></textarea>
<input name="a" placeholder="Jawaban A" value="<?= $edit['a'] ?? '' ?>">
<input name="b" placeholder="Jawaban B" value="<?= $edit['b'] ?? '' ?>">
<input name="c" placeholder="Jawaban C" value="<?= $edit['c'] ?? '' ?>">
<input name="d" placeholder="Jawaban D" value="<?= $edit['d'] ?? '' ?>">
<select name="jawaban">
<option>a</option><option>b</option><option>c</option><option>d</option>
</select>
<button name="<?= $edit?'update':'tambah' ?>">
<?= $edit?'Update':'Tambah' ?>
</button>
</form>

<hr>

<h2>Daftar Soal</h2>
<table>
<tr><th>No</th><th>Soal</th><th>Jawaban</th><th>Aksi</th></tr>
<?php
$no=1;
$q=mysqli_query($koneksi,"SELECT * FROM tes");
while($s=mysqli_fetch_assoc($q)){
?>
<tr>
<td><?= $no++ ?></td>
<td><?= $s['soal'] ?></td>
<td><?= strtoupper($s['jawaban']) ?></td>
<td>
<a href="?edit=<?= $s['tes_id'] ?>" class="btn-edit">Edit</a>
<a href="?hapus=<?= $s['tes_id'] ?>" class="btn-delete"
onclick="return confirm('Hapus soal?')">Hapus</a>
</td>
</tr>
<?php } ?>
</table>

</div>
</div>
</body>
</html>
<?php
session_start();

