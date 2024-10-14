<?php
function registrar($nombre, $apellidos, $fechaNacimiento, $genero, $email, $username, $password) {
    include("connection.php"); // Incluir la conexión a la base de datos

    try {
        // Generar Salt y encriptar la contraseña
        $passwordSalt = bin2hex(random_bytes(32));  // Genera un salt seguro
        $passwordEncrypted = hash("sha512", $password . $passwordSalt);  // Hashea la contraseña con el salt

        // Prepara la consulta de inserción con todos los campos mencionados
        $sql = "INSERT INTO `usuarios` 
            (`username`, `email`, `password`, `password_salt`, `nombre`, `apellidos`, `genero`, `fecha_nacimiento`, `fecha_hora_registro`, `activo`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)";

        // Parámetros a insertar en la tabla
        $sqlParams = [
            $username,             // username
            $email,                // email
            $passwordEncrypted,    // password (hasheada)
            $passwordSalt,         // password_salt
            $nombre,               // nombre
            $apellidos,            // apellidos
            $genero,               // genero
            $fechaNacimiento,      // fecha_nacimiento
            1                      // activo (indica si la cuenta está activa)
        ];

        // Preparar y ejecutar la consulta
        $stmt = $connection->prepare($sql);
        $stmt->execute($sqlParams);

        return true; // Retornar true si todo sale bien
    } catch (Exception $e) {
        // Registrar el error si ocurre
        error_log($e->getMessage());
        return false;
    } finally {
        // Cerrar la conexión
        $stmt = null;
        $connection = null;
    }
}
?>
