<?php
require "../php/connection.php";

$usuario = filter_input(INPUT_POST, "usuario");
$password = filter_input(INPUT_POST, "password");

$passwordSalt = strtoupper(bin2hex(random_bytes(32)));
$passwordEncrypted = strtoupper(hash("sha512", ($password . $passwordSalt)));

$sql = "UPDATE usuarios SET password_salt = ?, password_encrypted = ? WHERE username = ?";
$params = [$passwordSalt, $passwordEncrypted, $usuario];

$stmt = $connection->prepare($sql);
if ($stmt->execute($params)) {
    header("Location: ../vistas/login.php");
} else {
    echo "Ocurrió un error";
}

?>