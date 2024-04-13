<?php

function registrar($nombre, $apellidos, $fechaNacimiento, $genero, $email, $username, $password) {
    $GLOBALS["password"] = $password;
    $GLOBALS["email"] = $email;
    include("connection.php");

    $passwordSalt = strtoupper(bin2hex(random_bytes(32)));

    $sql = "INSERT INTO `usuarios` (`id`, `username`, `email`, `password`, `password_salt`, `nombre`, `apellidos`, `genero`, `fecha_nacimiento`, `fecha_hora_registro`, `activo`) VALUES (default,?,?,?,?,?,?,?,?,NOW(),1)";

    $sqlParams = [$username, $GLOBALS["email"], $GLOBALS["password"], $passwordSalt, $nombre, $apellidos, $genero, $fechaNacimiento];

    try {
        $stmt = $connection->prepare($sql);
		$stmt->execute($sqlParams);
        
        return true;
    } catch (Exception $e) {
        return false;
    }
}

?>