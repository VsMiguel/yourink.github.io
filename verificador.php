<?php
include "config/config.php";
include "config/conexion.php";
include "carrito.php";
include "layouts/header.php";


$ClientID = "Abn5Z1KnGiuVD7VGNFHn9n8hfb7YeWdu0rWOEY17zOxgdDxAU5f1XW5HbVNejGK9pDyKU82_ke7XqzEu";
$Secret = "EBJ_Fhsw3ANRGG_kmAagvwOn4pnhcusNn4oALvsDd9nkMVu6JjZzfpR7H_tihrvNYNqUn45foDbsIers";

$Login = curl_init("https://api.sandbox.paypal.com/v1/oauth2/token");

curl_setopt($Login, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($Login, CURLOPT_USERPWD, $ClientID . ":" . $Secret);
curl_setopt($Login, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

$Respuesta = curl_exec($Login);
$objRespuesta = json_decode($Respuesta);
$AccessToken = $objRespuesta->access_token;

// print_r($AccessToken);

$venta = curl_init("https://api.sandbox.paypal.com/v1/payments/payment/" . $_GET['paymentID']);
curl_setopt($venta, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $AccessToken));
curl_setopt($venta, CURLOPT_RETURNTRANSFER, TRUE);

$RespuestaVenta = curl_exec($venta);

// print_r($RespuestaVenta);

$objDatosTransaccion = json_decode($RespuestaVenta);

// print_r($objDatosTransaccion->payer->payer_info->email);

$state = $objDatosTransaccion->state;
$emai = $objDatosTransaccion->payer->payer_info->email;
$total = $objDatosTransaccion->transactions[0]->amount->total;
$currency = $objDatosTransaccion->transactions[0]->amount->currency;
$custom = $objDatosTransaccion->transactions[0]->custom;

$total = $total / 0.00024;

// print_r($custom);

$clave = explode("#", $custom);
$SID = $clave[0];
$claveVenta = openssl_decrypt($clave[1], COD, KEY);

curl_close($venta);
curl_close($Login);

if ($state == "approved") {
	$mensajePaypal = "<h3>Pago aprobado</h3>";
	$sentencia = $pdo->prepare("UPDATE `ventas`
								SET `paypaldatos` = :paypaldatos, `status` = 'pendiente'
								WHERE `ventas`.`id` = :id;");
	$sentencia->bindParam(":id", $claveVenta);
	$sentencia->bindParam(":paypaldatos", $RespuestaVenta);
	$sentencia->execute();

	$sentencia = $pdo->prepare("UPDATE `ventas` SET status='completo'
                                WHERE ClaveTransaccion=:ClaveTransaccion
                                AND Total=:TOTAL
                                AND ID=:ID");
	$sentencia->bindParam(':ClaveTransaccion', $SID);
	$sentencia->bindParam(':TOTAL', $total);
	$sentencia->bindParam(':ID', $claveVenta);
	$sentencia->execute();

	$completado = $sentencia->rowCount();
	session_destroy();
} else {
	$mensajePaypal = "<h3>Hay un problema con el pago de paypal</h3>";
}
?>
<div class="p-5 mb-4 bg-light rounded-3">
	<div class="container-fluid py-5 text-center">
		<h1 class="display-5 fw-bold">¡Listo!</h1>
		<p class="lead">Jumbo helper text</p>
		<hr class="my-2">
		<p><?php echo $mensajePaypal ?></p>
		<p class="lead">
			<a class="btn btn-primary btn-lg" href="index.php" role="button">Seguir comprando</a>
		</p>
	</div>
</div>


<!-- <table class="table">
	<thead>
		<tr>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td scope="row"><span>Descripción</span></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td scope="row"></td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table> -->

