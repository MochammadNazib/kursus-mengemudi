<?php
session_start();
include "../koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi,"
    SELECT * FROM instruktur
    WHERE username='$username'
    AND password='$password'
");

$data = mysqli_fetch_assoc($query);

if($data){
    $_SESSION['login'] = true;
    $_SESSION['role']  = 'instruktur';
    $_SESSION['instruktur_id'] = $data['instruktur_id'];
    $_SESSION['nama_instruktur'] = $data['nama_instruktur'];
    $_SESSION['no_hp'] = $data['no_hp'];
    $_SESSION['keahlian'] = $data['keahlian'];

    header("Location: dashboard.php");
} else {
    echo "<script>
        alert('Username atau password salah');
        window.location='login.php';
    </script>";
}
