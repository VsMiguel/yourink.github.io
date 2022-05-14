<?php
session_start();
if (!isset($_SESSION["usuario"])) {
	echo "redirigiendo...";
	header("location:index.php");
}else {
	// print_r($_SESSION["usuario"]);
}
?>