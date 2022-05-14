<?php
include("config/sesiones.php");
include "config/conexion.php";
if (!isset($_POST)) {
	$categoria = $_POST['categoria'];

	$sentencia = $pdo->prepare("INSERT INTO `categorias` (`id`, `categoria`) VALUES (NULL, :categoria);");
	$sentencia->bindParam(":categoria", $categoria);
	$sentencia->execute();
} else {
	echo "<h3>Complete el formulario</h3>";
	header("locate:Vistacategorias.php");
}
