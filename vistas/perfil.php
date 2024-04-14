<?php
require "../php/sesion_requerida.php";
require "../php/connection.php";

$body = [];

$sqlUsuario = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $connection->prepare($sqlUsuario);
$stmt->execute([$usuarioID]);

$resultadoUsuario = $stmt->fetch();
$body["usuario_id"] = $resultadoUsuario["id"];
$body["username"] = $resultadoUsuario["username"];
$body["nombreCompleto"] = $nombreCompleto;
$body["genero"] = $resultadoUsuario["genero"];
$body["fecha_nacimiento"] = $resultadoUsuario["fecha_nacimiento"];
$body["foto_perfil"] = $resultadoUsuario["foto_perfil"];

$sqlSeguidores = "SELECT COUNT(*) FROM seguidores WHERE usuario_siguiendo_id = ?";
$stmt = $connection->prepare($sqlSeguidores);
$stmt->execute([$usuarioID]);

$body["cantidad_seguidores"] = $stmt->fetchColumn();

$sqlSiguiendo = "SELECT COUNT(*) FROM seguidores WHERE usuario_seguidor_id = ?";
$stmt = $connection->prepare($sqlSiguiendo);
$stmt->execute([$usuarioID]);

$body["cantidad_siguiendo"] = $stmt->fetchColumn();

$sqlPublicaciones = "SELECT * FROM fotos WHERE usuario_subio_id = ?";
$stmt = $connection->prepare($sqlPublicaciones);
$stmt->execute([$usuarioID]);

$publicaciones = $stmt->fetchAll();
$body["cantidad_publicaciones"] = $stmt->rowCount();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi perfil</title>
  <link rel="icon" href="../img/Logo.png" type="image/x-icon">
  <link rel="stylesheet" href="../css/stylesPerfil.css">
</head>

<body>
  <div class="panel">
    <div class="opcion" id="lydch"><a href="#"><img src="../img/Logo.png" alt="LYDCH"
          style="width: 60px; height: 60px;"><span style="font-size: larger; font-weight: bold;">LYDCH</span></a></div>
    <div class="espacio"></div>
    <div class="opcion"><a href="./inicio.php"><img src="../img/Inicio.png" alt="Inicio"><span>Inicio</span></a></div>
    <div class="opcion"><a href="./buscador.html"><img src="../img/Buscador.png"
          alt="Buscador"><span>Buscador</span></a></div>
    <div class="opcion"><a href="./crear.html"><img src="../img/Crear.png" alt="Crear"><span>Crear</span></a></div>
    <div class="opcion" id="perfil"><a href="./perfil.php"><img src="../img/usuario.png"
          alt="Perfil"><span>Perfil</span></a></div>
    <div class="opcion"><a href="login.php"><img src="../img/Salir.png" alt="Salir"><span>Salir</span></a></div>
  </div>

  <div class="contenedor">
    <div class="perfil">
      <div class="foto-usuario">
        <img src="../img/fotoUsuario.jpg" alt="Foto de Usuario">
      </div>

      <div class="info-usuario">
        <div class="nombre-usuario"><?=$body["username"] ?></div>
        <button class="editar-perfil"><a href="./editarperfil.php">Editar</a></button>
      </div>

      <div class="informacion-usuario">
        Genero y fecha de nacimiento
      </div>
      
      <div class="datos-usuario">
        <span class="informacion-detallada"><?=$body["cantidad_publicaciones"] ?> publicaciones</span>
        <span class="informacion-detallada"><?=$body["cantidad_seguidores"] ?> seguidores</span>
        <span class="informacion-detallada"><?=$body["cantidad_siguiendo"] ?> seguidos</span>
      </div>

      <div class="galeria">
        <div class="imagen-container">
          <img src="../fotos/publicacion1.jpg" alt="Publicación 1">
          <button class="borrar-foto">Borrar foto</button>
        </div>
        <div class="imagen-container">
          <img src="../fotos/publicacion1.jpg" alt="Publicación 1">
          <button class="borrar-foto">Borrar foto</button>
        </div>
        <div class="imagen-container">
          <img src="../fotos/publicacion1.jpg" alt="Publicación 1">
          <button class="borrar-foto">Borrar foto</button>
        </div>
        <div class="imagen-container">
          <img src="../fotos/publicacion1.jpg" alt="Publicación 1">
          <button class="borrar-foto">Borrar foto</button>
        </div>
        <div class="imagen-container">
          <img src="../fotos/publicacion1.jpg" alt="Publicación 1">
          <button class="borrar-foto">Borrar foto</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>