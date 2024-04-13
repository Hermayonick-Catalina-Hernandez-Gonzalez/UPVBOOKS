<?php
require "../php/connection.php";
require "../php/login_helper.php";
require "../php/sesion.php";

session_start();

if($_POST) {
    $username = filter_input(INPUT_POST, "nombre");
    $password = filter_input(INPUT_POST, "password");
    
    $datosUsuario = autentificar($username, $password);
    
    if (!$datosUsuario) {
        header('Location: login.php');
        exit();
    } 
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="icon" href="../img/Logo.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/stylelogin.css">
</head>
<body>
    <div class="card">
        <h1>LYDCH</h1>
        <div class="circ-img">
            <img src="../img/Logo.png" />
        </div>
        <form class="ingresos" action="login.php" method="post">
            <label>Usuario:</label>
            <input type="text" placeholder="Usuario..." name="nombre" id="nombre">
            <label>Contraseña:</label>
            <input type="password" placeholder="Contraseña..." name="password" id="password">
            <div class="cont-btn">
                <button type="submit">Iniciar</button>
            </div>
        </form>
        <p>Aun no tienes cuenta? <a href="registrarse.php">Regístrate</a></p>
    </div>
    
</body>
</html>