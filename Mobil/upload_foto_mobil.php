<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['login'])) {
    http_response_code(401);
    exit;
}

if (!empty($_FILES['foto']['name']) && isset($_POST['mobil_id'])) {
    $mobil_id = intval($_POST['mobil_id']); // Ensure it's an integer
    
    // Tentukan path folder
    $upload_dir = __DIR__ . "/../assets/img/mobil/";
    
    // Buat folder jika belum ada
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    // Generate nama file
    $foto = time() . '_' . basename($_FILES['foto']['name']);
    $path = $upload_dir . $foto;
    
    // Validasi tipe file
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $file_ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    
    if (!in_array($file_ext, $allowed)) {
        http_response_code(400);
        echo "invalid_file_type";
        exit;
    }
    
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $path)) {
        // Cek apakah kolom foto sudah ada
        $check_column = mysqli_query($koneksi, "SHOW COLUMNS FROM mobil LIKE 'foto'");
        
        if (mysqli_num_rows($check_column) == 0) {
            // Kolom belum ada, tambahkan terlebih dahulu
            $add_column = "ALTER TABLE mobil ADD COLUMN foto VARCHAR(255) DEFAULT ''";
            if (!mysqli_query($koneksi, $add_column)) {
                http_response_code(500);
                echo "column_add_error: " . mysqli_error($koneksi);
                exit;
            }
        }
        
        // Update database dengan foto
        $foto_escaped = mysqli_real_escape_string($koneksi, $foto);
        $query = "UPDATE mobil SET foto='$foto_escaped' WHERE mobil_id=$mobil_id";
        $result = mysqli_query($koneksi, $query);
        
        if($result) {
            // Output hanya "success" tanpa whitespace
            echo "success";
            exit();
        } else {
            http_response_code(500);
            echo "database_error: " . mysqli_error($koneksi);
            exit();
        }
    } else {
        http_response_code(400);
        echo "upload_failed: " . $_FILES['foto']['error'];
        exit();
    }
} else {
    http_response_code(400);
    echo "invalid_request";
    exit();
}
?>
