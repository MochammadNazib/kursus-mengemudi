<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../koneksi.php";

/* CEK APAKAH DATA TERKIRIM */
if(!isset($_POST['nama_instruktur'])){
    die("FORM TIDAK TERKIRIM");
}

/* QUERY SIMPAN */
$query = mysqli_query($koneksi, "
INSERT INTO instruktur
(nama_instruktur, username, password, no_hp, keahlian)
VALUES
(
'$_POST[nama_instruktur]',
'$_POST[username]',
'$_POST[password]',
'$_POST[no_hp]',
'$_POST[keahlian]'
)
");

/* CEK QUERY */
if(!$query){
    die("GAGAL SIMPAN: ".mysqli_error($koneksi));
}

echo "DATA BERHASIL DISIMPAN <br>";
echo "<a href='instruktur.php'>Kembali</a>";