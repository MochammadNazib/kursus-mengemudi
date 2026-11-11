<?php
session_start();
include "../koneksi.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$query = mysqli_query($koneksi, "
    SELECT * FROM admin 
    WHERE username='$username' AND password='$password'
");

if (!$query) {
    die("Query error: " . mysqli_error($koneksi));
}

$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['login'] = true;
    $_SESSION['role'] = 'admin';
    $_SESSION['admin_id'] = $data['admin_id'];
    $_SESSION['nama_admin'] = $data['nama_admin'];

    header("Location: dashboard.php");
    exit;
} else {
    echo "<script>
        alert('Username atau Password salah');
        window.location='login.php';
    </script>";
}
