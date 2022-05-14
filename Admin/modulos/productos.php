<?php
include "config/conexion.php";
include("config/sesiones.php");
if (!isset($_POST)) {
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$precion =  $_POST['precion'];
	$precior =  $_POST['precior'];
	$cantidad =  $_POST['cantidad'];
	$imagen =  $_POST['imagen'];
	$categoria =  $_POST['categoria'];

	$sentencia = $pdo->prepare("INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio_normal`, `precio_rebajado`, `cantidad`, `imagen`, `id_categoria`)
	VALUES (NULL, :nombre, :descripcion, :precion, :precior, :cantidad, :imagen, :categoria);");
	$sentencia->bindParam(":nombre", $nombre);
	$sentencia->bindParam(":descripcion", $descripcion);
	$sentencia->bindParam(":precion", $precion);
	$sentencia->bindParam(":precior", $precior);
	$sentencia->bindParam(":cantidad", $cantidad);
	$sentencia->bindParam(":imagen", $imagen);
	$sentencia->bindParam(":categoria", $categoria);
	$sentencia->execute();

}
// $sentencia = $pdo->prepare("DELETE FROM productos WHERE id = `$registro['id']`");