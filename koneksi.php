<?php
$koneksi = mysqli_connect(
    "localhost",
    "root",
    "",
    "kelompok_kursus_mengemudi"
);

if (!$koneksi) {
    die("Koneksi gagal");
}
?>