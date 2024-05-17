<?php

function registrar($nombre, $apellidos, $fechaNacimiento, $genero, $email, $username, $password) {
    $GLOBALS["password"] = $password;
    include("connection.php");

    $passwordSalt = strtoupper(bin2hex(random_bytes(32)));
	$passwordEncrypted = strtoupper(hash("sha512", ($GLOBALS["password"] . $passwordSalt)));

    $sql = "INSERT INTO `usuarios` (`username`, `email`, `password_encrypted`, `password_salt`, `nombre`, `apellidos`, `genero`, `fecha_nacimiento`, `fecha_hora_registro`, `activo`, `foto_perfil`) VALUES (?,?,?,?,?,?,?,?, NOW(),?,?)";

    $sqlParams = [$username, $email, $passwordEncrypted, $passwordSalt, $nombre, $apellidos, $genero, $fechaNacimiento,1,"image.png"];

    try {
        $stmt = $connection->prepare($sql);
		$stmt->execute($sqlParams);
        return true;
    } catch (Exception $e) {
        //echo $e;
        return false;
    }
}

?>