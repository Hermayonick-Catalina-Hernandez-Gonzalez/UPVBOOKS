<?php

function cambiarContrasena($usuario, $password){

    $GLOBALS["password"] = $password;
    include ("connection.php");

    $passwordSalt = strtoupper(bin2hex(random_bytes(32)));
    $passwordEncrypted = strtoupper(hash("sha512", ($GLOBALS["password"] . $passwordSalt)));

    $sqlUpdate = "UPDATE usuarios SET password_salt = ?, password_encrypted = ? WHERE username = ?";
    $paramsUpdate = [$passwordSalt, $passwordEncrypted, $usuario];

    $stmtUpdate = $connection->prepare($sqlUpdate);
    if ($stmtUpdate->execute($paramsUpdate)) {
        header("Location: ../vistas/login.php");
    } else {
        $mensaje = "Ocurrió un error al actualizar la contraseña";
    }
}
?>
