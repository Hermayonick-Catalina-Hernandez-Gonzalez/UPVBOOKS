<?php

function registrar($nombre, $apellidos, $fechaNacimiento, $genero, $email, $username, $password) {
    $GLOBALS["password"] = $password;
    include("connection.php");

    $passwordSalt = strtoupper(bin2hex(random_bytes(32)));
	$passwordEncrypted = strtoupper(hash("sha512", ($GLOBALS["password"] . $passwordSalt)));
    echo "<script type='text/javascript'>console.log('PE: ". $passwordEncrypted ."')</script>";

    $sql = "INSERT INTO `usuarios` (`id`, `username`, `email`, `password`, `password_encrypted`, `password_salt`, `nombre`, `apellidos`, `genero`, `fecha_nacimiento`, `fecha_hora_registro`, `activo`) VALUES (default,?,?,?,?,?,?,?,?,?,NOW(),1)";

    $sqlParams = [$username, $email, $GLOBALS["password"], $passwordEncrypted, $passwordSalt, $nombre, $apellidos, $genero, $fechaNacimiento];

    try {
        $stmt = $connection->prepare($sql);
		$stmt->execute($sqlParams);
        return true;
    } catch (Exception $e) {
        return false;
    }
}

?>