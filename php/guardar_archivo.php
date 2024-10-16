<?php

// Importar los archivos necesarios para la ejecución
require "./config.php";
require "./sesion_requerida.php";
require "./connection.php";

header("Content-Type: application/json");

$errores = [];
$now = new DateTime();

// Validar que el usuario está autenticado
if (!$usuarioAutenticado) {
    $errores[] = "El usuario no se ha autenticado";
    echo json_encode(["errores" => $errores]);
    exit();
}

// Validar que se haya enviado el archivo en el request
if (empty($_FILES) || !isset($_FILES["foto"]) || empty($_FILES["foto"]["name"])) {
    $errores[] = "No se recibió el archivo a publicar.";
    echo json_encode(["errores" => $errores]);
    exit();
}

// Verificar si la carpeta de destino existe
if (!is_dir("C:/xampp/htdocs/xampp/UPVBOOKS/fotos/")) {
    echo json_encode(["error" => "Directorio no existe."]);
    exit();
}

// Obtener el array asociativo con los datos del archivo subido
$archivoSubido = $_FILES["foto"];
$descripcion = filter_input(INPUT_POST, "descripcion");
$descripcion = $descripcion && strlen(trim($descripcion)) ? trim($descripcion) : NULL;
$nombreArchivo = $archivoSubido["name"];
$nombreArchivoParts = explode(".", $nombreArchivo);
$extension = strtolower($nombreArchivoParts[count($nombreArchivoParts) - 1]);
$tamaño = $archivoSubido["size"];

// Validación del tipo de archivo que se subió
if (!in_array($extension, $EXT_ARCHIVOS_FOTOS)) {
    $errores[] = "El tipo de archivo no es el correcto, solo agregue imágenes.";
    echo json_encode(["errores" => $errores]);
    exit();
}

// Generar un nombre de archivo aleatorio
$nombreArchivoGuardado = strtoupper(bin2hex(random_bytes(32)));
$ruta = "C:/xampp/htdocs/xampp/UPVBOOKS/fotos/" . $nombreArchivoGuardado . "." . $extension;

// Intentar mover el archivo subido
$seGuardo = move_uploaded_file($archivoSubido["tmp_name"], $ruta);

// Verificar si se guardó correctamente
if (!$seGuardo) {
    $errores[] = "Ocurrió un error al guardar el archivo.";
    echo json_encode(["errores" => $errores]);
    exit();
}

// Obtener el SHA256 del archivo
$hashSha256 = strtoupper(hash_file("sha256", $ruta));
$fechaSubido = $now->format("Y-m-d H:i:s");

// Ejecutar la operación de insert en la base de datos
$sqlCmd = "INSERT INTO fotos (secure_id, extension, usuario_subio_id, nombre_archivo, tamaño, descripcion, fecha_subido) VALUES (?, ?, ?, ?, ?, ?, ?)";
$sqlParam = [$nombreArchivoGuardado, $extension, $usuarioID, $nombreArchivo, $tamaño, $descripcion, $fechaSubido];
$stmt = $connection->prepare($sqlCmd);
$stmt->execute($sqlParam);

// Obtener el id del registro insertado
$id = (int)$connection->lastInsertId();

// Responder con el resultado
$resObj = [
    "errores" => $errores,
    "archivo" => [
        "id" => $id,
        "nombreArchivo" => $nombreArchivo,
        "extension" => $extension,
        "descripcion" => $descripcion,
        "nombreArchivoGuardado" => $nombreArchivoGuardado,
        "fechaSubido" => $fechaSubido,
        "tamaño" => $tamaño
    ]
];

// Aquí es donde regresamos la respuesta como JSON
echo json_encode($resObj);
