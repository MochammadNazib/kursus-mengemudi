<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../koneksi.php";

/* CEK APAKAH DATA TERKIRIM */
if(!isset($_POST['nama_admin'])){
    die("FORM TIDAK TERKIRIM");
}

/* QUERY SIMPAN */
$query = mysqli_query($koneksi, "
INSERT INTO admin
(nama_admin, username, password, no_hp, email)
VALUES
(
'$_POST[nama_admin]',
'$_POST[username]',
'$_POST[password]',
'$_POST[no_hp]',
'$_POST[email]'
)
");

/* CEK QUERY */
if(!$query){
    die("GAGAL SIMPAN: ".mysqli_error($koneksi));
}

echo "DATA BERHASIL DISIMPAN <br>";
echo "<a href='admin.php'>Kembali</a>";