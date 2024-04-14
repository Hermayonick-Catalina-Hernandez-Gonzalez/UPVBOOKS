<?php
require "../php/sesion_requerida.php";
require "../php/connection.php";

if(isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id']; // Obtener el ID del usuario de la sesión
} 

// Obtener las publicaciones de los usuarios seguidos desde la vista fotos_v
$sql_publicaciones_seguidos = "SELECT * FROM fotos_v WHERE usuario_subio_id IN (SELECT usuario_siguiendo_id FROM seguidores WHERE usuario_seguidor_id = :usuario_id AND eliminado = 0) AND eliminado = 0";
$stmt_publicaciones_seguidos = $connection->prepare($sql_publicaciones_seguidos);
$publicaciones_seguidos = $stmt_publicaciones_seguidos->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="icon" href="../img/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/stylesInicio.css">
</head>

<body>
    <div class="panel">
        <div class="opcion" id="lydch"><a href="#"><img src="../img/Logo.png" alt="LYDCH"
                    style="width: 60px; height: 60px;"><span
                    style="font-size: larger; font-weight: bold;">LYDCH</span></a></div>
        <div class="espacio"></div>
        <div class="opcion"><a href="./inicio.php"><img src="../img/Inicio.png" alt="Inicio"><span>Inicio</span></a>
        </div>
        <div class="opcion"><a href="./buscador.html"><img src="../img/Buscador.png"
                    alt="Buscador"><span>Buscador</span></a></div>
        <div class="opcion"><a href="./crear.html"><img src="../img/Crear.png" alt="Crear"><span>Crear</span></a></div>
        <div class="opcion" id="perfil"><a href="./perfil.html"><img src="../img/usuario.png"
                    alt="Perfil"><span>Perfil</span></a></div>
        <div class="opcion"><a href="login.php"><img src="../img/Salir.png" alt="Salir"><span>Salir</span></a></div>
    </div>

    <div class="usuario-publicacion">

            <div class="publicacion">
                <div class="info-usuario">
                    <div class="nombre">
                        <span><?= $publicacion['usuario_subio_username'] ?></span>
                        <button class="mas-opciones">...</button>
                    </div>

                    <div class="foto-publicacion">
                        <img src="../fotos/<?= $publicacion['archivo'] ?>" alt="Foto de Publicación">
                    </div>

                    <div class="reaccion">
                        <img src="../img/Like.png" alt="Like">
                    </div>

                    <div class="interacciones">
                        <span class="likes"><?= $publicacion['likes'] ?> likes</span>
                    </div>

                    <div class="comentarios">
                        <div class="comentario">
                            <img src="../img/fotoUsuario.jpg" alt="comentario">
                            <span>¿Donde andas?</span>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</body>

</html>
