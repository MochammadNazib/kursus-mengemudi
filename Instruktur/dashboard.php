<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['role']!='instruktur'){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Instruktur</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    margin:0;
    font-family:Arial;
    background:
    linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
    url('../assets/img/bg_kursus.jpg') center/cover fixed;
}

.navbar{
    background:#1e90ff;
    color:white;
    padding:15px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.navbar a{
    color:white;
    text-decoration:none;
    font-weight:bold;
}

.container{
    padding:30px;
    display:flex;
    justify-content:center;
}

.card{
    background:white;
    padding:30px;
    border-radius:15px;
    width:600px;
    box-shadow:0 8px 20px rgba(0,0,0,.2);
    display:flex;
    gap:30px;
    align-items:flex-start;
}

.foto-container{
    flex-shrink:0;
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:10px;
}

.foto-container img{
    width:150px;
    height:150px;
    border-radius:12px;
    object-fit:cover;
    border:4px solid #1e90ff;
    box-shadow:0 4px 10px rgba(0,0,0,.2);
}

.info-container{
    flex:1;
    text-align:left;
}

h2{
    color:#1e90ff;
    margin:0 0 15px 0;
}

.menu{
    margin-top:25px;
    display:grid;
    gap:15px;
}

.menu a{
    background:#1e90ff;
    color:white;
    padding:15px;
    border-radius:12px;
    text-decoration:none;
    font-weight:bold;
    transition:.3s;
    text-align:center;
}

.menu a:hover{
    background:#0d47a1;
    transform:translateY(-3px);
}

.btn-ubah-foto{
    display:inline-block;
    background:#28a745;
    color:white;
    padding:8px 14px;
    border-radius:8px;
    cursor:pointer;
    font-size:13px;
    border:none;
    font-weight:bold;
    transition:.3s;
}

.btn-ubah-foto:hover{
    background:#218838;
}

.modal{
    display:none;
    position:fixed;
    z-index:1000;
    left:0;
    top:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.5);
}

.modal.show{
    display:flex;
    align-items:center;
    justify-content:center;
}

.modal-content{
    background:white;
    padding:30px;
    border-radius:12px;
    width:350px;
    box-shadow:0 10px 30px rgba(0,0,0,.3);
}

.modal-content h3{
    color:#1e90ff;
    margin-top:0;
}

.modal-content input[type="file"]{
    display:block;
    margin:15px 0;
    padding:10px;
    width:100%;
    border:1px solid #ddd;
    border-radius:8px;
    box-sizing:border-box;
}

.modal-content button{
    width:48%;
    padding:10px;
    margin:5px 1%;
    border:none;
    border-radius:8px;
    font-weight:bold;
    cursor:pointer;
    transition:.3s;
}

.btn-upload-modal{
    background:#1e90ff;
    color:white;
}

.btn-upload-modal:hover{
    background:#0d47a1;
}

.btn-batal{
    background:#dc3545;
    color:white;
}

.btn-batal:hover{
    background:#c82333;
}
</style>
</head>

<body>

<div class="navbar">
    <div><i class="fa fa-user-tie"></i> Dashboard Instruktur</div>
    <a href="../logout.php">Logout</a>
</div>

<div class="container">
<div class="card">
    <div class="foto-container">
        <img id="fotoPreview" src="<?php 
        if(isset($_SESSION['foto']) && !empty($_SESSION['foto'])){
            echo '../assets/img/instruktur/'.$_SESSION['foto'];
        } else {
            echo '../assets/img/default-profile.svg';
        }
        ?>" alt="Foto Profil">
        <button class="btn-ubah-foto" onclick="openUploadModal()"><i class="fa fa-camera"></i> Ubah Foto</button>
    </div>

    <div class="info-container">
        <h2>Halo, <?= $_SESSION['nama_instruktur'] ?></h2>
        <p>No HP: <b><?= $_SESSION['no_hp'] ?></b></p>
        <p>Keahlian: <b><?= $_SESSION['keahlian'] ?></b></p>

        <div class="menu">
            <a href="jadwal.php"><i class="fa fa-calendar"></i> Jadwal Mengajar</a>
           <a href="peserta.php"><i class="fa fa-users"></i> Peserta Saya</a>

        </div>
    </div>

</div>
</div>

<!-- Modal Upload Foto -->
<div id="uploadModal" class="modal">
    <div class="modal-content">
        <h3>Ubah Foto Profil</h3>
        <form id="formUpload" enctype="multipart/form-data">
            <input type="file" id="fotoInput" name="foto" accept="image/*" required>
            <button type="button" class="btn-upload-modal" onclick="uploadFoto()">Upload</button>
            <button type="button" class="btn-batal" onclick="closeUploadModal()">Batal</button>
        </form>
    </div>
</div>

<script>
function openUploadModal(){
    document.getElementById('uploadModal').classList.add('show');
}

function closeUploadModal(){
    document.getElementById('uploadModal').classList.remove('show');
    document.getElementById('fotoInput').value = '';
}

function uploadFoto(){
    const fileInput = document.getElementById('fotoInput');
    const file = fileInput.files[0];
    
    if(!file){
        alert('Pilih foto terlebih dahulu');
        return;
    }
    
    const formData = new FormData();
    formData.append('foto', file);
    
    fetch('upload_foto.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        closeUploadModal();
        location.reload();
    })
    .catch(error => {
        alert('Error: ' + error);
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
