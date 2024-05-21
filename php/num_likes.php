<?php
require "./connection.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    $errores[] = "Parámetro id no especificado";
    echo json_encode(["errores" => $errores]);
    exit();  // Fin de la ejecución.
}

$sql = "SELECT `likes` FROM `fotos_v` WHERE `id` = ? AND `eliminado` = 0";
$stmt = $connection->prepare($sql);
$stmt->execute([$id]);

$registro_like = $stmt->fetch();

if ($stmt->rowCount() > 0) {
    http_response_code(200);
    echo json_encode($registro_like["likes"]);
    exit();
} else {
    http_response_code(200);
    echo json_encode(0);
    exit();
}
