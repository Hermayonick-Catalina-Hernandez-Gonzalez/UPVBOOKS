<?php
require "../php/login_helper.php";

session_start();

if ($_POST) {
    $username = filter_input(INPUT_POST, "username");  // Obtener el valor del username
    $password = filter_input(INPUT_POST, "password");  // Obtener el valor de la contraseña

    // Verificar que se recibieron ambos campos
    if (!$username || !$password) {
        $mensaje = "Por favor, ingresa ambos campos.";
    } else {
        // Llamar a la función de autentificación
        $loggear = autentificar($username, $password);

        // Si no se pudo autenticar, mostrar mensaje de error
        if (!$loggear) {
            $mensaje = "Usuario o contraseña incorrectos";
        } else {
            // Si se autentica correctamente, guardar la información en la sesión
            $_SESSION["id"] = $loggear["id"];
            $_SESSION["username"] = $loggear["username"];
            $_SESSION["email"] = $loggear["email"];
            $_SESSION["nombre"] = $loggear["nombre"];
            $_SESSION["apellidos"] = $loggear["apellidos"];

            // Redirigir a la página principal (index.php)
            header("Location: ../index.php");
            exit();  // Asegurarse de que no se ejecute más código después de la redirección
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="icon" href="../img/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/stylelogin.css">
    <script src="../js/mensajeError.js"></script>
</head>
<body>
    <div class="card">
        <h1>UPVBOOKS</h1>
        <div class="circ-img">
            <img src="../img/Logo.png" />
        </div>
        <form class="ingresos" action="login.php" method="post">
            <!-- Mostrar mensaje de error en caso de login fallido -->
            <p id="mensaje"><?php if (isset($mensaje)) echo $mensaje; ?></p>

            <label>Usuario:</label>
            <input type="text" placeholder="Usuario..." name="username" id="username" required>

            <label>Contraseña:</label>
            <input type="password" placeholder="Contraseña..." name="password" id="password" required>

            <p><a href="cambiarContrasena.php">¿Olvidaste tu contraseña?</a></p>

            <div class="cont-btn">
                <button type="submit">Iniciar</button>
            </div>
        </form>
        <p>Aún no tienes cuenta? <a href="registrarse.php">Regístrate</a></p>
    </div>
</body>
</html>