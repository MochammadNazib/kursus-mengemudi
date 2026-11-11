<?php
session_start();
include "../koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi, "
    SELECT * FROM peserta 
    WHERE username='$username' AND password='$password'
");

$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['login'] = true;
    $_SESSION['role'] = 'peserta';
    $_SESSION['peserta_id'] = $data['peserta_id'];
    $_SESSION['nama_peserta'] = $data['nama_peserta'];

    header("Location: dashboard.php");
} else {
    echo "<script>
        alert('Username atau Password salah');
        window.location='login.php';
    </script>";
}
