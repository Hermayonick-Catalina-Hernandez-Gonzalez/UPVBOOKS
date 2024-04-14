<?php

// Import de los archivos de código necesarios para la ejecución 
require "../config.php";  // Configuraciones generales de la aplicación
require "./sesion.php";  // para acceder a las variables de sesión
require "./connection.php";  // para el acceso a datos

// Indicamos que la respuesta es de tipo JSON, porque la petición a esta ejecución
// será por AJAX
header("Content-Type: application/json");

$errores = [];  // Array para guardar los errores obtenidos.
$now = new DateTime();  // fecha hora actual de la ejecución

// Se valida que el usuario está autenticado, de lo contrario se regresa un
// json con el error (usuario no autenticado)
if (!$USUARIO_AUTENTICADO) {
    $errores[] = "Usuario no autenticado";
    echo json_encode(["errores" => $errores]);
    exit();  // Fin de la ejecución.
}

// Se obtiene el parámetro "id" enviado en la petición post
$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
if (!$id) {
    $errores[] = "Parámetro id no especificado";
    echo json_encode(["errores" => $errores]);
    exit();  // Fin de la ejecución.
}

// Consulta a DB, tabla de archivos, el registro del archivo por el id
$sqlCmd = "SELECT * FROM archivos WHERE id = ?";
$sqlParam = [$id];
$stmt = $connection->prepare($sqlCmd);
$stmt->execute($sqlParam);
$archivo = $stmt->fetch();

// Si no existe el registro del archivo según el id proporcionado, se regresa
// un error indicando esto
if (!$archivo) {
    $errores[] = "No existe registro de archivo con Id $id";
    echo json_encode(["errores" => $errores]);
    exit();  // Fin de la ejecución.
}

// Si el archivo ya ha sido borrado, no hay necesidad de volverlo a borrar,
// por lo que se termina la ejecución y se regresa un array vacio de errores
if ($archivo["fecha_borrado"]) {
    echo json_encode(["errores" => $errores]);
    exit();  // Fin de la ejecución.
}

// Realizamos la operación de borrar del archivo en DB, la cual será una 
// operación "soft delete", marcando un campo (fecha_borrado) para indicar que
// ese registro ya fue borrado
$sqlCmd = "UPDATE archivos SET fecha_borrado = ?, usuario_borro_id = ? WHERE id = ?";
$fechaBorrado = $now->format("Y-m-d H:i:s");
$sqlParam = [$fechaBorrado, $USUARIO_ID, $id];
$stmt = $db->prepare($sqlCmd);
$stmt->execute($sqlParam);

// Se guarda la operación de borrar como un registro en tabla
// archivos_log_general
$sqlCmd =  // Sentencia SQL del Insert en archivos_log_general
        "INSERT INTO archivos_log_general " .
        "    (archivo_id, usuario_id, fecha_hora, accion_realizada, " .
        "     ip_realiza_operacion)" .
        "  VALUES (?, ?, ?, ?, ?)";
$accionRealizada = "BORRAR";
$sqlParam = [  // array con los datos a guardar, según los placeholders '?'
    $id, $USUARIO_ID, $fechaBorrado, $accionRealizada, $REQUEST_IP_ADDRESS
];
$stmt = $db->prepare($sqlCmd);  // obtenemos el statement de la ejecución
$stmt->execute($sqlParam);  // ejecutamos el statement con los parámetros

// Obtenemos el id del registro insertado en archivos_log_general, por si lo ocupamos
$idEnLog = (int)$db->lastInsertId();  // la función regresa string, convertimos a int

// Regresamos la respuesta JSON que lo único que contendrá es un array empty
// de los errores, que si llegamos aquí no hay errores
echo json_encode(["errores" => $errores]); 
