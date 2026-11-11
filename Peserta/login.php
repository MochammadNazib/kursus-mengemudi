<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Peserta</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    min-height:100vh;
    background:linear-gradient(rgba(0,0,0,.6),rgba(0,0,0,.6)),
    url('../assets/img/bg_kursus.jpg') center/cover;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:Arial;
}
.login-box{
    background:#fff;
    padding:30px;
    width:350px;
    border-radius:12px;
    text-align:center;
}
input{
    width:100%;
    padding:10px;
    margin:10px 0;
    border-radius:6px;
    border:1px solid #ccc;
}
button{
    width:100%;
    padding:10px;
    background:#1e90ff;
    color:white;
    border:none;
    border-radius:6px;
    font-weight:bold;
}
button:hover{background:#0d47a1;}
</style>
</head>
<body>

<div class="login-box">
<h2><i class="fa fa-user"></i> Login Peserta</h2>

<form method="post" action="proses_login.php">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

</div>
</body>
</html>
