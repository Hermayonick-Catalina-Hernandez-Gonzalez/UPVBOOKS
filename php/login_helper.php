<?php
function autentificar($username, $password) {
    include("connection.php");  // Conexión a la base de datos

    // Verificar que se hayan recibido los datos
    if (!$username || !$password) return false;

    // Consulta para obtener los datos del usuario
    $sqlCmd = "SELECT * FROM usuarios WHERE username = ?";
    $sqlParams = [$username];

    $stmt = $connection->prepare($sqlCmd); 
    $stmt->execute($sqlParams);
    $result = $stmt->fetchAll();  // Obtener el resultado de la consulta

    // Si no existe el usuario, retorna false
    if (!$result) return false;

    $usuario = $result[0];  // Tomar el primer resultado (usuario)

    // Verificar la contraseña con el salt
    $passwordMasSalt = $password . $usuario["password_salt"];  // Concatenar el salt con la contraseña
    $passwordEncrypted = strtoupper(hash("sha512", $passwordMasSalt));  // Generar el hash de la contraseña

    // Debugging: Verifica los valores de las contraseñas
    error_log("Password ingresada: " . $password);
    error_log("Password del usuario (con salt): " . $usuario["password"]);
    error_log("Password cifrada: " . $passwordEncrypted);

    // Compara la contraseña ingresada con la almacenada
    if ($usuario["password"] !== $passwordEncrypted) {
        // Si no coinciden, registrar un error en el log
        error_log("Contraseña no coincide.");
        return false;
    }

    // Si todo es correcto, retorna los datos del usuario
    return [
        "id" => $usuario['id'],
        "username" => $usuario["username"],
        "email" => $usuario["email"],
        "nombre" => $usuario["nombre"],
        "apellidos" => $usuario["apellidos"],
    ];
}

?>
