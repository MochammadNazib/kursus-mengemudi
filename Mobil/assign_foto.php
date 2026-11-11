<?php
session_start();
include "koneksi.php";

// Automatic assign foto untuk mobil yang ada
$mobil_fotos = [
    'FORTUNER' => 'fortuner.svg',
    'AVANZA' => 'avanza.svg'
];

foreach($mobil_fotos as $nama_mobil => $foto) {
    $query = "UPDATE mobil SET foto='$foto' WHERE UPPER(nama_mobil) = UPPER('$nama_mobil') AND foto = ''";
    mysqli_query($koneksi, $query);
}

header("Location: mobil/mobil.php");
?>