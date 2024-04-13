<?php
$nombreServidor = "localhost";
$userBD = "root";
$password = "";
$nombreBD = "foto_blog";

try {
  $connection = new PDO("mysql:host=$nombreServidor;dbname=$nombreBD", $userBD, $password);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>
