<?php

$usuarioAutenticado = false;
$usuarioID = NULL;
$usuario = NULL;
$email = NULL;
$nombre = NULL;
$apellidos = NULL;
$nombreCompleto = NULL;

if (isset($_SESSION["id"])) {
    $usuarioAutenticado = true;
    $usuarioID = $_SESSION["id"];
    $usuario = $_SESSION["username"];
    $email = $_SESSION["email"];
    $nombre = $_SESSION["nombre"];
    $apellidos = $_SESSION["apellidos"];
    $nombreCompleto = $apellidos ? "$nombre $apellidos" : $nombre;
}

?>