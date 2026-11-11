<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role']!='peserta') {
    header("Location: ../login.php");
    exit;
}
include "../koneksi.php";
$peserta_id = $_SESSION['peserta_id'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Jadwal Kursus Saya</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    margin:0;
    font-family:Arial;
    background:linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
    url('../assets/img/bg_kursus.jpg') center/cover;
}
.navbar{
    background:#1e90ff;
    color:white;
    padding:15px 25px;
    display:flex;
    justify-content:space-between;
}
.navbar a{color:white;text-decoration:none;margin-left:15px;font-weight:bold;}
.container{padding:30px;}
.card{
    background:white;
    padding:25px;
    border-radius:18px;
}
h2{text-align:center;color:#1e90ff;}
table{width:100%;border-collapse:collapse;}
th{background:#1e90ff;color:white;padding:10px;}
td{padding:10px;text-align:center;border-bottom:1px solid #ddd;}

.badge{padding:6px 10px;border-radius:6px;color:white;font-size:13px;}
.pending{background:#ffc107;color:black;}
.approved{background:#28a745;}
.rejected{background:#dc3545;}
.lunas{background:#1e90ff;}
.belum{background:#dc3545;}

.btn-bayar{
    background:#28a745;
    color:white;
    padding:7px 14px;
    border-radius:6px;
    text-decoration:none;
    font-weight:bold;
}
</style>
</head>

<body>

<div class="navbar">
    <div><i class="fa fa-calendar"></i> Jadwal Kursus</div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="container">
<div class="card">

<h2>Jadwal Kursus Saya</h2>

<table>
<tr>
    <th>Tanggal</th>
    <th>Jam</th>
    <th>Instruktur</th>
    <th>Mobil</th>
    <th>Approval</th>
    <th>Pembayaran</th>
    <th>Aksi</th>
</tr>

<?php
$q = mysqli_query($koneksi,"
    SELECT j.*, i.nama_instruktur, m.nama_mobil
    FROM jadwal j
    JOIN instruktur i ON j.instruktur_id=i.instruktur_id
    JOIN mobil m ON j.mobil_id=m.mobil_id
    WHERE j.peserta_id='$peserta_id'
    ORDER BY j.tanggal ASC
");

if(mysqli_num_rows($q)==0){
    echo "<tr><td colspan='7'>Belum ada jadwal</td></tr>";
}

while($d=mysqli_fetch_assoc($q)){
?>
<tr>
    <td><?= $d['tanggal'] ?></td>
    <td><?= $d['jam'] ?></td>
    <td><?= $d['nama_instruktur'] ?></td>
    <td><?= $d['nama_mobil'] ?></td>

    <!-- APPROVAL -->
    <td>
        <?php
        if($d['approval']=='pending'){
            echo "<span class='badge pending'>Pending</span>";
        }elseif($d['approval']=='disetujui'){
            echo "<span class='badge approved'>Disetujui</span>";
        }else{
            echo "<span class='badge rejected'>Ditolak</span>";
        }
        ?>
    </td>

    <!-- STATUS BAYAR -->
    <td>
        <?php
        if($d['status']=='lunas'){
            echo "<span class='badge lunas'>LUNAS</span>";
        }else{
            echo "<span class='badge belum'>BELUM</span>";
        }
        ?>
    </td>

    <!-- AKSI -->
    <td>
        <a class="btn-bayar"
           href="pembayaran.php?jadwal_id=<?= $d['jadwal_id'] ?>&total=<?= $d['harga'] ?>">
           BAYAR
        </a>
    </td>
</tr>
<?php } ?>

</table>
</div>
</div>
</body>
</html>
