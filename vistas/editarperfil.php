<?php
require "../php/sesion_requerida.php";
require "../php/connection.php";

$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->execute([$usuarioID]);

$result = $stmt->fetchAll();

if (!$result) {
    $mensaje = "No se encontraron datos";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="icon" href="../img/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/stylesditarperfil.css">
</head>

<body>
    <div class="card">
        <h1>Editar Perfil</h1>
        <p><?php if (isset($mensaje)) echo $mensaje; ?></p>
        <form class="ingresos" action="../php/modificarDatos.php" method="post" enctype="multipart/form-data">
            <label for="imagen">Cambia tu foto de perfil:</label>
            <input type="file" name="imagen" id="imagen">
            <label for="nombre">Nombre:</label>
            <input type="text" placeholder="Usuario..." name="nombre" id="nombre" value="<?php if (!isset($mensaje)) echo $result[0]["nombre"]; ?>" required>
            <label for="">Apellidos:</label>
            <input type="text" placeholder="Apellido..." name="apellidos" id="apellidos" value="<?php if (!isset($mensaje)) echo $result[0]["apellidos"]; ?>">
            <label for="fecha-nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha-nacimiento" name="fecha-nacimiento" value="<?php if (!isset($mensaje)) echo $result[0]["fecha_nacimiento"]; ?>">
            <label>Genero:</label>
            <?php
            if (!isset($mensaje)) {
            ?>
                <select id="genero" name="genero">
                    <option value="O" <?= ($result[0]["genero"] === "O") ? 'selected' : '' ?>>Seleciona tu genero...</option>
                    <option value="M" <?= ($result[0]["genero"] === "M") ? 'selected' : '' ?>>Masculino</option>
                    <option value="F" <?= ($result[0]["genero"] === "F") ? 'selected' : '' ?>>Femenino</option>
                    <option value="X" <?= ($result[0]["genero"] === "X") ? 'selected' : '' ?>>Prefiero no especificar</option>
                </select>
            <?php
            } else {
            ?>
                <select id="genero" name="genero">
                    <option value="O">Seleciona tu genero...</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                    <option value="X">Prefiero no especificar</option>
                </select>
            <?php
            }
            ?>
            <label for="correo">Correo:</label>
            <input type="email" placeholder="Correo..." id="correo" name="correo" value="<?=(!isset($mensaje)) ? $result[0]["email"] : '' ?>" required>
            <div class="cont-btn">
                <button type="submit" class="salir">Salir</button>
                <button type="submit" class="guardar">Modificar</button>
            </div>
        </form>
    </div>

</body>

</html>