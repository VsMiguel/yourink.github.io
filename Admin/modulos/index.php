<?php
if (isset($_POST["btnLogin"])) {

	include("config/conexion.php");

	$Email = ($_POST['email']);
	$Pass = ($_POST['password']);

	$pass_c = sha1($Pass);

	$sentencia = $pdo->prepare("SELECT * FROM usuarios WHERE correo=:correo AND password='$pass_c'");
	$sentencia->bindParam("correo", $Email, PDO::PARAM_STR);
	// $sentencia->bindParam("password", $Pass, PDO::PARAM_STR);
	$sentencia->execute();

	$registro = $sentencia->fetch(PDO::FETCH_ASSOC);

	$numRegistros = $sentencia->rowCount();

	if ($numRegistros >= 1) {
		session_start();
		$_SESSION["usuario"] = $registro;
		echo "Bienvenido...";
		header("location:Vistapanel.php");
	} else {
		echo "No se encontraron registros...";
	}

	echo "<br/> hay que validar el correo y la contraseña";
}


//  INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `correo`, `password`, `foto`) VALUES (NULL, 'Miguel', 'Vargas', 'Miguelaglvs@gmail.com', '12345', 'foto.jpg');