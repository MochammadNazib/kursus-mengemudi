<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);
include "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mobil</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background:
                linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)),
                url('../assets/img/bg_kursus.jpg');
            background-size: cover;
            background-position: center;
        }

        .navbar {
            background: #1e90ff;
            color: white;
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            font-weight: bold;
        }

        .container {
            padding: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #1e90ff;
        }

        .btn {
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-size: 14px;
        }

        .btn-add {
            background: #28a745;
            display: inline-block;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: #1e90ff;
            color: white;
            padding: 10px;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        table td:nth-child(2) {
            text-align: center;
        }

        .mobil-cell {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            flex-direction: row-reverse;
        }

        .mobil-foto {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            border: 2px solid #1e90ff;
            flex-shrink: 0;
            cursor: pointer;
            transition: 0.3s;
        }

        .mobil-foto:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(30, 144, 255, 0.4);
        }

        .btn-edit { background: orange; }
        .btn-delete { background: red; }

        .back {
            margin-top: 15px;
            display: inline-block;
            background: gray;
        }

        /* Modal Style */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,.5);
            align-items: center;
            justify-content: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 350px;
            box-shadow: 0 10px 30px rgba(0,0,0,.3);
        }

        .modal-content h3 {
            color: #1e90ff;
            margin-top: 0;
        }

        .modal-content input[type="file"] {
            display: block;
            margin: 15px 0;
            padding: 10px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
        }

        .modal-content button {
            width: 48%;
            padding: 10px;
            margin: 5px 1%;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: .3s;
        }

        .btn-upload-modal {
            background: #1e90ff;
            color: white;
        }

        .btn-upload-modal:hover {
            background: #0d47a1;
        }

        .btn-batal {
            background: #dc3545;
            color: white;
        }

        .btn-batal:hover {
            background: #c82333;
        }

        .logo-center {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            pointer-events: none;
        }

        .logo-center img {
            width: 260px;
            max-width: 80%;
            opacity: 0.15;
            filter: grayscale(20%);
        }
    </style>
</head>

<body>

<div class="logo-center">
    <img src="../assets/img/logo.png" alt="Logo Kursus">
</div>

<div class="navbar">
    <div><i class="fa-solid fa-car"></i> Kursus Mengemudi</div>
    <div>
        <a href="../dashboard.php">Dashboard</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <div class="card">
        <h2>Data Mobil</h2>

        <a href="add.php" class="btn btn-add">
            <i class="fa-solid fa-plus"></i> Tambah Mobil
        </a>

        <?php
        // Auto-assign foto jika belum ada
        $mobil_fotos = [
            'FORTUNER' => 'fortuner.svg',
            'AVANZA' => 'avanza.svg'
        ];

        foreach($mobil_fotos as $nama_mobil => $foto) {
            mysqli_query($koneksi, "UPDATE mobil SET foto='$foto' WHERE UPPER(nama_mobil) = UPPER('$nama_mobil') AND (foto = '' OR foto IS NULL)");
        }
        ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Nama Mobil</th>
                <th>Tipe</th>
                <th>Transmisi</th>
                <th>Plat Nomor</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM mobil");
            if(!$query){
                die("QUERY ERROR: ".mysqli_error($koneksi));
            }

            while($m = mysqli_fetch_assoc($query)){
            ?>
            <tr>
                <td><?= $m['mobil_id']; ?></td>
                <td>
                    <div class="mobil-cell">
                        <?php 
                            $mobil_foto = isset($m['foto']) ? $m['foto'] : '';
                            $foto_path = '../assets/img/mobil/' . $mobil_foto;
                            
                            if (!empty($mobil_foto) && file_exists(__DIR__ . '/../assets/img/mobil/' . $mobil_foto)) {
                                $foto = $foto_path . '?' . time();
                            } else {
                                $foto = '../assets/img/default-car.svg';
                            }
                        ?>
                        <img src="<?= $foto; ?>" alt="<?= $m['nama_mobil']; ?>" class="mobil-foto" onclick="openUploadModal(<?= $m['mobil_id']; ?>, '<?= $m['nama_mobil']; ?>')">
                        <span><?= $m['nama_mobil']; ?></span>
                    </div>
                </td>
                <td><?= $m['tipe']; ?></td>
                <td><?= $m['transmisi']; ?></td>
                <td><?= $m['plat_nomor']; ?></td>
                <td><?= $m['status']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $m['mobil_id']; ?>" class="btn btn-edit">Edit</a>
                    <a href="hapus.php?id=<?= $m['mobil_id']; ?>" class="btn btn-delete"
                       onclick="return confirm('Yakin hapus data mobil?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <a href="../dashboard.php" class="btn back">Kembali</a>
    </div>
</div>

<!-- Modal Upload Foto -->
<div id="uploadModal" class="modal">
    <div class="modal-content">
        <h3>Ganti Foto Mobil</h3>
        <p id="mobilName"></p>
        <form id="formUpload" enctype="multipart/form-data">
            <input type="hidden" id="mobilId" name="mobil_id">
            <input type="file" id="fotoInput" name="foto" accept="image/*" required>
            <button type="button" class="btn-upload-modal" onclick="uploadFoto()">Upload</button>
            <button type="button" class="btn-batal" onclick="closeUploadModal()">Batal</button>
        </form>
    </div>
</div>

<script>
function openUploadModal(mobilId, mobilName){
    document.getElementById('uploadModal').classList.add('show');
    document.getElementById('mobilId').value = mobilId;
    document.getElementById('mobilName').textContent = 'Mobil: ' + mobilName;
    document.getElementById('fotoInput').value = '';
}

function closeUploadModal(){
    document.getElementById('uploadModal').classList.remove('show');
    document.getElementById('fotoInput').value = '';
}

function uploadFoto(){
    const fileInput = document.getElementById('fotoInput');
    const file = fileInput.files[0];
    const mobilId = document.getElementById('mobilId').value;
    
    if(!file){
        alert('Pilih foto terlebih dahulu');
        return;
    }
    
    const formData = new FormData();
    formData.append('foto', file);
    formData.append('mobil_id', mobilId);
    
    fetch('upload_foto_mobil.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        return response.text().then(text => {
            if (!response.ok) {
                throw new Error(text || 'Upload gagal');
            }
            return text;
        });
    })
    .then(data => {
        const trimmedData = data.trim();
        
        if(trimmedData === 'success') {
            alert('Foto berhasil diupload!');
            closeUploadModal();
            setTimeout(() => {
                location.reload();
            }, 300);
        } else {
            alert('Error upload: ' + trimmedData);
        }
    })
    .catch(error => {
        alert('Error: ' + error.message);
    });
}

document.getElementById('uploadModal')?.addEventListener('click', function(e){
    if(e.target === this){
        closeUploadModal();
    }
});
</script>

</body>
</html>
