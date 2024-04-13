<?php

function autentificar($username, $password) {
    $GLOBALS["password"] = $password;
    include("connection.php");

    if (!$username || !$GLOBALS["password"]) return false;

    $sqlCmd = "SELECT * FROM usuarios WHERE username = ?";
    $sqlParams = [$username]; 
    
    $stmt = $connection->prepare($sqlCmd); 
    $stmt->execute($sqlParams); 
    $result = $stmt->fetchAll(); 

    if (!$result) return false;

    $usuario = $result[0];

	$passwordMasSalt = $GLOBALS["password"] . $usuario["password_salt"];
	$passwordEncrypted = strtoupper(hash("sha512", $passwordMasSalt));

    if ($usuario["password_encrypted"] != $passwordEncrypted) return false;

    return [
        "id" => $usuario['id'], 
        "username" => $usuario["username"], 
        "email" => $usuario["email"], 
        "nombre" => $usuario["nombre"], 
        "apellidos" => $usuario["apellidos"],
    ];
}

?>
