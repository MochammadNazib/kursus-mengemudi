<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(
    mysqli_query($koneksi,"SELECT * FROM jadwal WHERE jadwal_id='$id'")
);

if(isset($_POST['update'])){
    mysqli_query($koneksi,"UPDATE jadwal SET
        peserta_id='$_POST[peserta]',
        instruktur_id='$_POST[instruktur]',
        mobil_id='$_POST[mobil]',
        tanggal='$_POST[tanggal]',
        jam='$_POST[jam]',
        status='$_POST[status]'
        WHERE jadwal_id='$id'
    ");
    header("Location: jadwal.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Jadwal</title>
<style>
body{
background:linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
url('../assets/img/bg_kursus.jpg');
background-size:cover;
font-family:Arial;
}
.form{
width:420px;margin:60px auto;
background:white;padding:25px;
border-radius:12px;
}
input,select,button{
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
<h3>Edit Jadwal Kursus</h3>

<form method="post">

<select name="peserta">
<?php
$p=mysqli_query($koneksi,"SELECT * FROM peserta");
while($r=mysqli_fetch_assoc($p)){
$sel = ($r['peserta_id']==$data['peserta_id'])?'selected':'';
echo "<option value='$r[peserta_id]' $sel>$r[nama_peserta]</option>";
}
?>
</select>

<select name="instruktur">
<?php
$i=mysqli_query($koneksi,"SELECT * FROM instruktur");
while($r=mysqli_fetch_assoc($i)){
$sel = ($r['instruktur_id']==$data['instruktur_id'])?'selected':'';
echo "<option value='$r[instruktur_id]' $sel>$r[nama_instruktur]</option>";
}
?>
</select>

<select name="mobil">
<?php
$m=mysqli_query($koneksi,"SELECT * FROM mobil");
while($r=mysqli_fetch_assoc($m)){
$sel = ($r['mobil_id']==$data['mobil_id'])?'selected':'';
echo "<option value='$r[mobil_id]' $sel>$r[nama_mobil]</option>";
}
?>
</select>

<input type="date" name="tanggal" value="<?= $data['tanggal'] ?>" required>
<input type="time" name="jam" value="<?= $data['jam'] ?>" required>

<select name="status">
<option <?= ($data['status']=='Terjadwal')?'selected':'' ?>>Terjadwal</option>
<option <?= ($data['status']=='Selesai')?'selected':'' ?>>Selesai</option>
</select>

<button name="update">Update</button>

</form>
</div>
</body>
</html>
