<?php
session_start();
if ($_SESSION['role']!='admin') { header("Location: ../index.php"); exit; }
include "../koneksi.php";

$id=$_GET['id'];
mysqli_query($koneksi,"DELETE FROM instruktur WHERE instruktur_id='$id'");
header("Location: instruktur.php");
