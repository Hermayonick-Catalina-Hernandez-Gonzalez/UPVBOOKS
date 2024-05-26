<?php
require "./php/sesion_requerida.php";
require "./php/connection.php";


$sql = "SELECT * FROM fotos_v f WHERE (
    f.usuario_subio_id = ? OR f.usuario_subio_id IN (
    SELECT usuario_siguiendo_id
    FROM seguidores
    WHERE usuario_seguidor_id = ?)
) AND f.eliminado = 0 ORDER BY f.fecha_subido DESC;";

$stmt = $connection->prepare($sql);
$stmt->execute([$usuarioID, $usuarioID]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="icon" href="img/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/stylesInicio.css">
</head>

<body>
    <div class="panel">
        <div class="opcion" id="lydch"><a href="#"><img src="./img/Logo.png" alt="LYDCH" style="width: 60px; height: 60px;"><span style="font-size: larger; font-weight: bold;">LYDCH</span></a></div>
        <div class="espacio"></div>
        <div class="opcion"><a href="index.php"><img src="./img/Inicio.png" alt="Inicio"><span>Inicio</span></a>
        </div>
        <div class="opcion"><a href="./vistas/buscador.html"><img src="./img/Buscador.png" alt="Buscador"><span>Buscador</span></a></div>
        <div class="opcion"><a href="vistas/crear.php"><img src="./img/Crear.png" alt="Crear"><span>Crear</span></a></div>
        <div class="opcion" id="perfil"><a href="vistas/perfil.php"><img src="./img/usuario.png" alt="Perfil"><span>Perfil</span></a></div>
        <div class="opcion"><a href="php/logout.php"><img src="./img/Salir.png" alt="Salir"><span>Salir</span></a></div>
    </div>

    <div class="usuario-publicacion">
        <?php if($stmt->rowCount() > 0){
            $publicaciones = $stmt->fetchAll();
            foreach($publicaciones as $publicacion){ 
                $sqlUsuario = "SELECT foto_perfil FROM usuarios WHERE id = ?";
                $stmt = $connection->prepare($sqlUsuario);
                $stmt->execute([$publicacion["usuario_subio_id"]]);
                $resultadoUsuario = $stmt->fetch();
            ?>
            <div class="publicacion">
            <div class="info-usuario">
                <div class="nombre"><img src="fotos_perfil/<?=$resultadoUsuario["foto_perfil"] ?>" alt="Inicio"><span><?=$publicacion["usuario_subio_username"] ?></span>
                    <!-- <button class="mas-opciones">...</button> -->
                </div>

                <p><?=$publicacion["descripcion"] ?></p>

                <div class="foto-publicacion">
                    <img src="fotos/<?=$publicacion["secure_id"] . "." . $publicacion["extension"] ?>" alt="<?=$publicacion["nombre_archivo"] ?>">
                </div>

                <div class="reaccion" id="like" data-id="<?= $publicacion["id"]?>">
                    <img src="./img/Like.png" alt="Like">
                </div>

                <div class="interacciones">
                    <span class="likes"></span>
                </div>
            </div>
        </div>
            <?php }
        } ?>
        
    </div>
    <script src="./js/scriptInicio.js"></script>
</body>

</html>