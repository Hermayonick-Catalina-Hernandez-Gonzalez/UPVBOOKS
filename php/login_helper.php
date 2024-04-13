<?php

function autentificar($username, $password) {
    $GLOBALS["password"] = $password;
    include("connection.php");

    echo "<script type='text/javascript'>console.log('User: ". $username ."')</script>";
    echo "<script type='text/javascript'>console.log('Pass: ". $GLOBALS["password"] ."')</script>";

    if (!$username || !$GLOBALS["password"]) return false;

    $sqlCmd = "SELECT * FROM usuarios WHERE username = ?";
    $sqlParams = [$username]; 
    
    $stmt = $connection->prepare($sqlCmd); 
    $stmt->execute($sqlParams); 
    $result = $stmt->fetchAll(); 

    if (!$result) return false;

    $usuario = $result[0];

    if ($usuario["password"] != $GLOBALS["password"]) return false;

    return [
        "id" => $usuario['id'], 
        "username" => $usuario["username"], 
        "email" => $usuario["email"], 
        "nombre" => $usuario["nombre"], 
        "apellidos" => $usuario["apellidos"],
    ];
}

?>
