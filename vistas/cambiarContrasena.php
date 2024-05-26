<?php

require "../php/connection.php";
require "../php/cambiarContrasena.php";

$mensaje = "";

if($_POST){
    $usuario = filter_input(INPUT_POST, "usuario");
    $password = filter_input(INPUT_POST, "password");

    $sqlCheckUser = "SELECT COUNT(*) FROM usuarios WHERE username = ?";
    $stmtCheckUser = $connection->prepare($sqlCheckUser);
    $stmtCheckUser->execute([$usuario]);
    
    $userExists = $stmtCheckUser->fetchColumn();
    if($userExists){
        $datos = cambiarContrasena($usuario, $password);
    } else {
        $mensaje = "El usuario no existe";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar contraseña</title>
    <link rel="icon" href="../img/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/cambiarContrasena.css">
    <script src="../js/verificarCotrasena.js"></script>
</head>
<body>
    <div class="card">
        <h1>Cambiar contraseña</h1>
        <div class="circ-img">
            <img src="../img/Logo.png" />
        </div>
        <form class="ingresos" action="cambiarContrasena.php" method="post">
            <p> <?php echo $mensaje; ?> </p>
            <label>Usuario</label>
            <input type="text" placeholder="Usuario..." name="usuario" id="usuario">
            <label>Contraseña:</label>
            <input type="password" placeholder="Contraseña..." name="password" id="password">
            <label>Confirmar contraseña:</label>
            <input type="password" placeholder="Contraseña..." onkeyup="verificar();" name="conf_password" id="conf_password">
            <div class="cont-btn">
                <button type="submit">Cambiar</button>
            </div>
        </form>
    </div>
    
</body>
</html>
