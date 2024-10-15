<?php
require "../php/registro_helper.php";

session_start();
$mensaje = "";

if ($_POST) {
    // Limpiar y validar los campos de entrada
    $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_STRING);
    $apellidos = filter_input(INPUT_POST, "apellido", FILTER_SANITIZE_STRING);
    $fechaNacimiento = filter_input(INPUT_POST, "fecha-nacimiento", FILTER_SANITIZE_STRING);
    $genero = filter_input(INPUT_POST, "genero", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "correo", FILTER_VALIDATE_EMAIL);
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    $confirm_password = filter_input(INPUT_POST, "confirm_password", FILTER_SANITIZE_STRING);
    
    // Foto por defecto
    $foto_perfil = "default_profile.png";  // Foto por defecto si no se sube una

    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
        // Procesar la foto de perfil subida
        $foto_tmp = $_FILES['foto_perfil']['tmp_name'];
        $foto_extension = pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION);
        $foto_nombre = "profile_" . uniqid() . "." . $foto_extension;

        // Subir la foto de perfil al servidor (directorio 'uploads/')
        $foto_destino = "../fotos_perfil/" . $foto_nombre;
        move_uploaded_file($foto_tmp, $foto_destino);

        // Asignar el nombre de la foto subida
        $foto_perfil = $foto_nombre;
    }

    // Validaciones
    if ($email === false) {
        $mensaje = "Correo electrónico no válido.";
    } elseif ($password !== $confirm_password) {
        $mensaje = "Las contraseñas no coinciden.";
    } elseif (!esMayorDeEdad($fechaNacimiento)) {
        $mensaje = "Debes ser mayor de edad para registrarte.";
    } else {
        // Registrar el usuario con la foto de perfil
        $registrar = registrar($nombre, $apellidos, $fechaNacimiento, $genero, $email, $username, $password, $foto_perfil);
        if ($registrar) {
            header('Location: ./login.php');
            exit;
        } else {
            $mensaje = "Ocurrió un error al registrar el usuario.";
        }
    }
}

// Función para verificar la edad
function esMayorDeEdad($fechaNacimiento) {
    try {
        $fechaNacimiento = new DateTime($fechaNacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fechaNacimiento)->y;
        return $edad >= 18;
    } catch (Exception $e) {
        return false; // Si hay un error en la fecha, no dejar continuar
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
    <script src="../js/validarEdad.js"></script>
</head>
<body>
    <div class="card">
        <h1>Registrarse</h1>
        <form class="ingresos" action="registrarse.php" method="post" enctype="multipart/form-data">
            <label id="error-label"><?php echo htmlspecialchars($mensaje); ?></label>
            <label>Nombre:</label>
            <input type="text" placeholder="Usuario..." name="nombre" required>
            <label>Apellido:</label>
            <input type="text" placeholder="Apellido..." name="apellido">
            <label>Fecha de Nacimiento:</label>
            <input type="date" id="fecha-nacimiento" name="fecha-nacimiento" required>
            <label>Genero:</label>
            <select id="genero" name="genero" required>
                <option value="" disabled selected>Selecciona tu género...</option>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
                <option value="X">Prefiero no especificar</option>
            </select>

            <label>Correo electrónico:</label>
            <input type="email" placeholder="Correo electrónico..." name="correo" required>
            <label>Username:</label>
            <input type="text" placeholder="Username..." name="username" required>
            <label>Contraseña:</label>
            <input type="password" placeholder="Contraseña..." name="password" required>
            <label>Confirmar Contraseña:</label>
            <input type="password" placeholder="Confirmar contraseña..." name="confirm_password" required>
            
            <label>Foto de perfil:</label>
            <input type="file" name="foto_perfil" accept="image/*">
            
            <div class="cont-btn">
                <button type="submit" class="registrar">Registrar</button>
                <button type="button" class="salir" onclick="window.location.href = 'login.php'">Salir</button>
            </div>
        </form>
    </div>
</body>
</html>