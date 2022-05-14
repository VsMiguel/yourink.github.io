<?php
include "config/config.php";
include "config/conexion.php";
include "carrito.php";
include "layouts/header.php";
?>

<?php
if ($_POST) {
	$total = 0;
	$SID = session_id();
	$Correo = $_POST['correo'];
	$Nombre = $_POST['nombre'];
	$Apellido =  $_POST['apellido'];
	$Direccion =  $_POST['direccion'];
	$Numero =  $_POST['numero'];
	$Ciudad =  $_POST['ciudad'];
	$CodigoP =  $_POST['codigop'];
	foreach ($_SESSION['CARRITO'] as $indice => $producto) {
		$total = $total + ($producto['PRECIO'] * $producto['CANTIDAD']);
	}
	$sentencia = $pdo->prepare("INSERT INTO `ventas` (`id`, `ClaveTransaccion`, `paypaldatos`, `fecha`, `nombre`, `apellido`, `correo`, `direccion`, `numero`, `ciudad`, `codigop`, `total`, `status`) 
	VALUES (NULL, :ClaveTransaccion, '', NOW(), :Nombre, :Apellido, :Correo, :Direccion, :Numero, :Ciudad, :CodigoP, :Total, 'pendiente');");
	$sentencia->bindParam(":ClaveTransaccion", $SID);
	$sentencia->bindParam(":Nombre", $Nombre);
	$sentencia->bindParam(":Apellido", $Apellido);
	$sentencia->bindParam(":Correo", $Correo);
	$sentencia->bindParam(":Direccion", $Direccion);
	$sentencia->bindParam(":Numero", $Numero);
	$sentencia->bindParam(":Ciudad", $Ciudad);
	$sentencia->bindParam(":CodigoP", $CodigoP);
	$sentencia->bindParam(":Total", $total);
	$sentencia->execute();
	$IDVenta = $pdo->lastInsertId();
	foreach ($_SESSION['CARRITO'] as $indice => $producto) {
		$sentencia = $pdo->prepare("INSERT INTO
		`detalleventa` (`ID`, `IDVENTA`, `IDPRODUCTO`, `PRECIOUNITARIO`, `CANTIDAD`, `ENVIADO`)
		VALUES (NULL, :IDVENTA, :IDPRODUCTO, :PRECIOUNITARIO, :CANTIDAD, '0');");
		$sentencia->bindParam(":IDVENTA", $IDVenta);
		$sentencia->bindParam(":IDPRODUCTO", $producto['ID']);
		$sentencia->bindParam(":PRECIOUNITARIO", $producto['PRECIO']);
		$sentencia->bindParam(":CANTIDAD", $producto['CANTIDAD']);
		$sentencia->execute();
	}
}

?>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<style>
	/* Media query for mobile viewport */
	@media screen and (max-width: 400px) {
		#paypal-button-container {
			width: 100%;
		}
	}

	/* Media query for desktop viewport */
	@media screen and (min-width: 400px) {
		#paypal-button-container {
			width: 250px;
			display: inline-block;
		}
	}
</style>
<div class="p-5 mb-4 bg-light rounded-3">
	<div class="container-fluid py-5 text-center">
		<h1 class="display-5 fw-bold">¡Paso Final!</h1>
		<hr class="my-4">
		<p>Estasapunto de pagar con paypal la cantidad de:
		<h3>$ <?php echo number_format($total); ?></h3>
		</p>
		<p>Los productos seran enviados una vez que se procese el pago <br>
			<strong>(Para aclaraciones: correo@gmail.com)</strong>
		</p>
		<div id="paypal-button-container"></div>
	</div>
</div>

<script>
	paypal.Button.render({
		env: 'sandbox', // sandbox | production
		style: {
			label: 'checkout', // checkout | credit | pay | buynow | generic
			size: 'responsive', // small | medium | large | responsive
			shape: 'pill', // pill | rect
			color: 'blue' // gold | blue | silver | black
		},

		// PayPal Client IDs - replace with your own
		// Create a PayPal app: https://developer.paypal.com/developer/applications/create

		client: {
			sandbox: 'Abn5Z1KnGiuVD7VGNFHn9n8hfb7YeWdu0rWOEY17zOxgdDxAU5f1XW5HbVNejGK9pDyKU82_ke7XqzEu',
			production: 'AWp6AQGVbCxuI_i6u6tAZMMKw59tovZEOk918R0PjWK0Ez8Z3sBYekeUe0OihTRSU7zH6sEksn832KfF'
		},

		// Wait for the PayPal button to be clicked

		payment: function(data, actions) {
			return actions.payment.create({
				payment: {
					transactions: [{
						amount: {
							total: '<?php echo number_format($total * 0.00024) ?>',
							currency: 'USD'
						},
						description: "Compra de productos YourInk: $<?php echo number_format($total); ?>",
						custom: "<?php echo $SID; ?>#<?php echo openssl_encrypt($IDVenta, COD, KEY); ?>"
					}]
				}
			});
		},

		// Wait for the payment to be authorized by the customer

		onAuthorize: function(data, actions) {
			return actions.payment.execute().then(function() {
				console.log(data);
				window.location = "verificador.php?paymentToken=" + data.paymentToken + "&paymentID=" + data.paymentID;
			});
		}

	}, '#paypal-button-container');
</script>