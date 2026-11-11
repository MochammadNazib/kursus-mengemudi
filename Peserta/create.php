<?php
include "../koneksi.php";
mysqli_query($koneksi,"INSERT INTO peserta VALUES(
NULL,
'$_POST[nama]',
'$_POST[username]',
'$_POST[password]',
'$_POST[no_hp]',
)");
header("location:peserta.php");