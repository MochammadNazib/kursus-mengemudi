<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<h2>Tambah Instruktur</h2>

<form action="create.php" method="post">
    Nama Instruktur <br>
    <input type="text" name="nama_instruktur" required><br><br>

    Username <br>
    <input type="text" name="username" required><br><br>

    Password <br>
    <input type="text" name="password" required><br><br>

    No HP <br>
    <input type="text" name="no_hp"><br><br>

    Keahlian <br>
    <input type="text" name="keahlian"><br><br>

    <button type="submit">Simpan</button>
    <a href="instruktur.php">Kembali</a>
</form>