<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pilih Login</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    min-height:100vh;
    background:linear-gradient(rgba(0,0,0,.6),rgba(0,0,0,.6)),
    url('https://images.unsplash.com/photo-1503376780353-7e6692767b70');
    background-size:cover;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:Arial;
}
.login-box{
    background:white;
    padding:30px;
    width:350px;
    border-radius:12px;
    text-align:center;
}
a{
    display:block;
    margin:15px 0;
    padding:12px;
    background:#1e90ff;
    color:white;
    border-radius:6px;
    text-decoration:none;
    font-weight:bold;
}
a:hover{background:#0d47a1;}
</style>
</head>
<body>

<div class="login-box">
<h2><i class="fa-solid fa-car"></i> Pilih Login</h2>

<a href="admin/login.php">Login Admin</a>
<a href="instruktur/login.php">Login Instruktur</a>
<a href="peserta/login.php">Login Peserta</a>

</div>

</body>
</html>
