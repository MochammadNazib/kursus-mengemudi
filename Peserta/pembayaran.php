<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role']!='peserta') {
    header("Location: ../login.php");
    exit;
}

include "../koneksi.php";

if (!isset($_GET['jadwal_id']) || !isset($_GET['total'])) {
    echo "<script>
        alert('Data pembayaran tidak valid');
        window.location='jadwal.php';
    </script>";
    exit;
}

$jadwal_id  = $_GET['jadwal_id'];
$total      = $_GET['total'];
$peserta_id = $_SESSION['peserta_id'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pembayaran Kursus</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    margin:0;
    font-family:Arial;
    background:
        linear-gradient(rgba(0,0,0,.65), rgba(0,0,0,.65)),
        url('../assets/img/bg_kursus.jpg') center/cover;
}
.card{
    background:white;
    width:420px;
    margin:80px auto;
    padding:30px;
    border-radius:18px;
    box-shadow:0 15px 40px rgba(0,0,0,.3);
}
h2{
    text-align:center;
    color:#1e90ff;
    margin-bottom:25px;
}
label{
    font-weight:bold;
    display:block;
    margin-top:15px;
}
select, button{
    width:100%;
    padding:12px;
    margin-top:8px;
    border-radius:10px;
    border:1px solid #ccc;
    font-size:15px;
}
.total{
    font-size:18px;
    margin-bottom:15px;
    text-align:center;
}
button{
    background:#1e90ff;
    color:white;
    border:none;
    margin-top:20px;
    font-weight:bold;
    cursor:pointer;
}
button:hover{
    background:#0d47a1;
}
.back{
    display:block;
    margin-top:15px;
    text-align:center;
    text-decoration:none;
    color:#555;
}
.back:hover{color:#000;}

.bank{
    display:none;
}
</style>
</head>

<body>

<div class="card">
<h2><i class="fa fa-credit-card"></i> Pembayaran Kursus</h2>

<div class="total">
    Total Bayar<br>
    <b>Rp <?= number_format($total,0,',','.') ?></b>
</div>

<form method="post" action="proses_pembayaran.php">

    <!-- METODE -->
    <label>Metode Pembayaran</label>
    <select name="metode" id="metode" required onchange="pilihMetode()">
        <option value="">-- Pilih Metode --</option>
        <option value="Transfer">Transfer</option>
        <option value="Cash">Cash</option>
    </select>

    <!-- BANK -->
    <div class="bank" id="bank">
        <label>Pilih Bank</label>
        <select name="bank">
            <option value="">-- Pilih Bank --</option>
            <option value="BCA">BCA</option>
            <option value="BRI">BRI</option>
            <option value="Mandiri">Mandiri</option>
        </select>
    </div>

    <input type="hidden" name="jadwal_id" value="<?= $jadwal_id ?>">
    <input type="hidden" name="total" value="<?= $total ?>">

    <button type="submit">
        <i class="fa fa-check"></i> BAYAR
    </button>
</form>

<a href="jadwal.php" class="back">
    <i class="fa fa-arrow-left"></i> Kembali ke Jadwal
</a>
</div>

<script>
function pilihMetode(){
    let metode = document.getElementById("metode").value;
    let bank   = document.getElementById("bank");

    if(metode === "Transfer"){
        bank.style.display = "block";
    }else{
        bank.style.display = "none";
    }
}
</script>

</body>
</html>
