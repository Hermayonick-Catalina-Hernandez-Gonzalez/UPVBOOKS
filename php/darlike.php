<?php 

require "Config/conexion.php";
require "Config/configuraciones.php";

session_start();
$usuario_id = $_SESSION['usuario_id'];

$data = json_decode(file_get_contents('php://input'), true);
$idarchivo = $data['id'];

$stmt = $conn->prepare("SELECT * FROM `likes` WHERE `Id_archivo` = ?");

$stmt->execute([$idarchivo]);
$result = $stmt->fetchAll();

$respuesta = "";

if ($result){// Aumentar likes

	$datos = $result[0];
	$cantidad = $datos["likes"];

	$sql = "UPDATE `likes` SET `likes` = ? WHERE `Id_archivo` = ?";

	try {
		$stmt = $conn->prepare($sql);
		$stmt->execute([($cantidad+1),$idarchivo]);

		$respuesta = array('mensaje' => 'Datos recibidos correctamente');
	} catch (Exception $e) {
		$respuesta = array('mensaje' => 'Datos no recibidos correctamente');
	}	

}else{// Iniciar likes

	$sql = "INSERT INTO `likes`(`id`, `Id_archivo`, `likes`) VALUES (default, ?, 1)";

	try {
		$stmt = $conn->prepare($sql);
		$stmt->execute([$idarchivo]);

		$respuesta = array('mensaje' => 'Datos recibidos correctamente');
	} catch (Exception $e) {
		$respuesta = array('mensaje' => 'Datos no recibidos correctamente');
	}	

}

echo json_encode($respuesta);

?>