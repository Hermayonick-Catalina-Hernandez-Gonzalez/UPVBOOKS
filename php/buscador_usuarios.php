<?php
require "../php/sesion_requerida.php";
require "../php/connection.php";

// Obtener el texto de búsqueda del cuerpo de la solicitud POST
$texto_busqueda = filter_input(INPUT_POST, "texto");

// Inicializar la consulta SQL y los parámetros de vinculación
$sql = "SELECT * FROM usuarios WHERE username LIKE :texto OR nombre LIKE :texto";
$params = [':texto' => "%$texto_busqueda%"]; // Agregar '%' para buscar coincidencias parciales

// Ejecutar la consulta SQL
$stmt = $connection->prepare($sql);
$stmt->execute($params);

// Comprobar si hay resultados
if ($stmt->rowCount() > 0) {
    // Generar el HTML de los resultados
    echo "<ul>"; // Inicia la lista
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<li class='perfil-usuario'>"; // Inicia un elemento de lista
        // Mostrar la imagen de perfil si existe
        if (!empty($row['foto_perfil'])) {
            echo "<img src='data:image/jpeg;base64," . base64_encode($row['foto_perfil']) . "' alt='Foto de Usuario' class='foto-usuario'>";
        }
        echo "<span class='nombre-usuario'>" . $row['username'] . "</span>";
        echo "</li>"; // Cierra el elemento de lista
    }
    echo "</ul>"; // Cierra la lista
} else {
    echo "No se encontraron usuarios.";
}
?>
