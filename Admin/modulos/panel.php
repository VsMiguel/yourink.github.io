<?php
include("config/sesiones.php");
include("config/conexion.php");

$sentencia = $pdo->prepare("SELECT count(*) totalventas, SUM(total) as ingresosventas FROM ventas WHERE paypaldatos<>''");
$sentencia->execute();
$registro = $sentencia->fetch(PDO::FETCH_ASSOC);
$totalVentas=$registro['totalventas'];
$ingresosVentas=$registro['ingresosventas'];

$sentencia = $pdo->prepare("SELECT count(*) totalventas FROM ventas WHERE paypaldatos=''");
$sentencia->execute();
$registro = $sentencia->fetch(PDO::FETCH_ASSOC);
$totalPendientes=$registro['totalventas'];

$sentencia = $pdo->prepare("SELECT nombre, apellidos, foto FROM usuarios");
$sentencia->execute();
$registro = $sentencia->fetch(PDO::FETCH_ASSOC);
$nombre=$registro['nombre'];
$apellidos=$registro['apellidos'];
$foto=$registro['foto'];

