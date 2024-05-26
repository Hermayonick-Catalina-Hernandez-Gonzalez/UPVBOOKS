<?php
require "../php/registro_helper.php";

session_start();
$mensaje = "";

if($_POST) {
    $nombre = filter_input(INPUT_POST, "nombre");
    $apellidos = filter_input(INPUT_POST, "apellido");
    $fechaNacimiento = filter_input(INPUT_POST, "fecha-nacimiento");
    $genero = filter_input(INPUT_POST,"genero");
    $email = filter_input(INPUT_POST, "correo");
    $username = filter_input(INPUT_POST, "username");
    $password = filter_input(INPUT_POST, "password");

    $registrar = registrar($nombre, $apellidos, $fechaNacimiento, $genero, $email, $username, $password);
    if($registrar) {
        header('Location: ./login.php');
    } else {
        $mensaje = "Ocurrió un error";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="icon" href="../img/Logo.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/styleregister.css">
</head>
<body>
    <div class="card">
        <h1>Registrarse</h1>
        <form class="ingresos" action="registrarse.php" method="post">
            <label><?php echo $mensaje; ?></label>
            <label>Nombre:</label>
            <input type="text" placeholder="Usuario..." name="nombre" required>
            <label>Apellido:</label>
            <input type="text" placeholder="Apellido..." name="apellido">
            <label>Fecha de Nacimiento:</label>
            <input type="date" id="fecha-nacimiento" name="fecha-nacimiento" required>
            <label>Genero:</label>
            <select id="genero" name="genero">
                <option value="O">Seleeciona tu genero...</option>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
                <option value="X">Prefiero no especificar</option>
            </select>
            <label>Correo electrónico:</label>
            <input type="email" placeholder="Correo electrónico..." name="correo">
            <label>Username:</label>
            <input type="text" placeholder="Username..." name="username">
            <label>Contraseña:</label>
            <input type="password" placeholder="Contraseña..." name="password">
            <label>Confirmar Contraseña:</label>
            <input type="password" placeholder="Confirmar contraseña..." name="password">
            <div class="cont-btn">
                <button type="submit" class="registrar">Registrar</button>
                <button type="button" class="salir" onclick="window.location.href = 'login.php'">Salir</button>
            </div>
        </form>
    </div>
    
</body>
</html>

