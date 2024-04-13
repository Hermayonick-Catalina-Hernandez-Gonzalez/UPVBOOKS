<?php

require "sesion.php";

if(!$usuarioAutenticado) {
    header("Location: ../vistas/login.html");
    exit();
}

?>