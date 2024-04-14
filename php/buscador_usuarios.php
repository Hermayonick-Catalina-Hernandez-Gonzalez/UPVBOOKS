<?php
require "../php/sesion_requerida.php";
require "../php/connection.php";

// Obtener el texto de búsqueda del cuerpo de la solicitud POST
$texto_busqueda = filter_input(INPUT_POST, "texto");

// Construir la consulta SQL (usar consultas preparadas para seguridad)
$sql = "SELECT * FROM usuarios WHERE username LIKE ? OR nombre LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->execute(["%$texto_busqueda%", "%$texto_busqueda%"]);

// Comprobar si hay resultados
if ($stmt->rowCount() > 0) {
    // Generar el HTML de los resultados
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='perfil-usuario'>";
        echo "<img src='" . $row['foto_perfil'] . "' alt='Foto de Usuario' class='foto-usuario'>";
        echo "<span class='nombre-usuario'>" . $row['username'] . "</span>";
        echo "</div>";
    }
} else {
    echo "No se encontraron usuarios.";
}
?>