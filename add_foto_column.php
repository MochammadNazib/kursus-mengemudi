<?php
include "koneksi.php";

// Query untuk tambah kolom foto
$sql = "ALTER TABLE mobil ADD COLUMN foto VARCHAR(255) DEFAULT ''";

if (mysqli_query($koneksi, $sql)) {
    echo "Kolom 'foto' berhasil ditambahkan ke tabel mobil!<br>";
    echo "<a href='Mobil/mobil.php'>Lanjut ke Data Mobil</a>";
} else {
    $error = mysqli_error($koneksi);
    
    // Cek apakah kolom sudah ada
    if (strpos($error, 'Duplicate column') !== false) {
        echo "Kolom 'foto' sudah ada di tabel mobil.<br>";
        echo "<a href='Mobil/mobil.php'>Lanjut ke Data Mobil</a>";
    } else {
        echo "Error: " . $error . "<br>";
        
        // Debug: Show table columns
        echo "<h3>Kolom yang ada di tabel mobil:</h3>";
        $result = mysqli_query($koneksi, "DESCRIBE mobil");
        echo "<pre>";
        while ($row = mysqli_fetch_assoc($result)) {
            print_r($row);
        }
        echo "</pre>";
    }
}

mysqli_close($koneksi);
?>
