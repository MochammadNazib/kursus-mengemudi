<?php
include "../koneksi.php";
mysqli_query($koneksi,"DELETE FROM peserta WHERE peserta_id='$_GET[id]'");
header("location:peserta.php");