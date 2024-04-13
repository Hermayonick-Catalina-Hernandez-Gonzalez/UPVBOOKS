<?php

function autentificar($username, $password) {
    if (!$username || !$password) return false;

    $sqlCmd = "SELECT * FROM usuarios WHERE username = ? ORDER BY id DESC";
    $sqlParams = [$username]; 
    
    $conn = getDbConnection(); 
    $stmt = $conn->prepare($sqlCmd); 
    $stmt->execute($sqlParams); 
    $r = $stmt->fetchAll(); 

    if (!$r) return false;

    $passwordMasSalt = $password . $usuario["password_salt"];
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
