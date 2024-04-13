<?php

function autentificar($username, $password) {
    include("connection.php");

    if (!$username || !$password) return false;

    $sqlCmd = "SELECT * FROM usuarios WHERE username = ?";
    $sqlParams = [$username]; 
    
    $stmt = $connection->prepare($sqlCmd); 
    $stmt->execute($sqlParams); 
    $r = $stmt->fetchAll(); 

    if (!$r) return false;

    if ($usuario["password"] != $password) return false;

    return [
        "id" => $usuario['id'], 
        "username" => $usuario["username"], 
        "email" => $usuario["email"], 
        "nombre" => $usuario["nombre"], 
        "apellidos" => $usuario["apellidos"],
    ];
}

?>
