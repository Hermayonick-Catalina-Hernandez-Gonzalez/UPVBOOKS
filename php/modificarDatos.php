<?php
require "sesion_requerida.php";
require "connection.php";

$nombre = filter_input(INPUT_POST, "nombre");
$apellidos = filter_input(INPUT_POST, "apellidos");
$genero = filter_input(INPUT_POST, "genero");
$fecha_Nac = filter_input(INPUT_POST, "fecha-nacimiento");
$email = filter_input(INPUT_POST, "correo");

if(!$nombre && !$email){
    $mensaje = "No se enviaron los datos requeridos";
    require "../vistas/editarperfil.php";
    exit();
}

$sql = "UPDATE usuarios SET nombre = ?, email = ?";
$params = [$nombre, $email];

if($apellidos){
    $sql .= ", apellidos = ?";
    $params[] = $apellidos;
}

if($genero){
    $sql .= ", genero = ?";
    $params[] = $genero;
}

if($fecha_Nac){
    $sql .= ", fecha_nacimiento = ?";
    $params[] = $fecha_Nac;
}

$sql .= "WHERE id = ?";
$params[] = $usuarioID;

$stmt = $connection->prepare($sql);
if($stmt->execute($params)){
    header("Location: ../vistas/perfil.php");
}else{
    $mensaje = "No se pudo modificar la informacion";
    require "../vistas/editarperfil.php";
    exit();
}
