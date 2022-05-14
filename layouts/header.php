<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1,
			shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Carrito de Compras</title>
	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
	<!-- Fuentes e iconos-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- Localcss -->
	<link href="assets/css/main.css" rel="stylesheet" />
</head>

<body>
	<!-- Nav -->
	<nav>
		<div class="mobile">
			<div class="header">
				<a href="index.php"><img src="./assets/img/logo.png" width="250" alt=""></a>
				<div class="icons">
					<a href=""></a>
					<a href=""><span class="material-icons">&#xe853;</span></a>
				</div>
			</div>
		</div>
		<ul>
			<li><a href="index.php"><img src="./assets/img/logo.png" width="220" /></a></li>
		</ul>
		<ul>
			<div class="btn-group dropstart">
				<button type="button" class="btn btn-outline-info btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
					<i class="fa-solid fa-cart-shopping fa-1x"></i>
					<span class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-info" id="carrito">
						<?php
						echo (empty($_SESSION['CARRITO'])) ? 0 : count($_SESSION['CARRITO']);
						?>
				</button>
				<ul class="dropdown-menu">
					<section class="site-section">
						<div class="container-md">
							<div class="row mb-12">
								<form class="col-md-12" method="post">
									<div class="site-blocks-table list-group table-responsive">
										<?php if (!empty($_SESSION['CARRITO'])) { ?>
											<table class="table table-ligth table-bordered">
												<thead>
													<tr>
														<th whidth="15" class="text-center">Producto</th>
														<th whidth="20" class="text-center">Precio</th>
														<th whidth="20" class="text-center">Cantidad</th>
														<th whidth="5" class="text-center">Total</th>
														<th class="text-center">Eliminar</th>
													</tr>
												</thead>
												<tbody>
													<?php $total = 0; ?>
													<?php foreach ($_SESSION['CARRITO'] as $indice => $producto) { ?>
														<tr>
															<td whidth="15" class="text-center align-center"><img src="assets/img/<?php echo $producto['IMAGEN'] ?>" width="50px" alt="Close modal" /> <?php echo $producto['NOMBRE'] ?></td>
															<td whidth="20" class="text-center"><?php echo number_format($producto['PRECIO']) ?></td>
															<td whidth="20" class="text-center"><?php echo $producto['CANTIDAD'] ?></td>
															<td whidth="5" class="text-center"><?php echo number_format($producto['PRECIO'] * $producto['CANTIDAD']) ?></td>
															<form action="" method="post">
																<input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY); ?>">
																<td class="text-center"><button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar"><i class="fa-solid fa-delete-left"></i></button></td>
															</form>
														</tr>
														<?php $total = $total + ($producto['PRECIO'] * $producto['CANTIDAD']); ?>
													<?php } ?>
												</tbody>
											</table>
											<div class="d-grid gap-2">
												<a href="mostrarcarrito.php" class="btn btn-primary" id="btnCarrito">Iniciar compra</a>
											</div>
										<?php } else { ?>
											<li>
												<a class="dropdown-item disabled">
													Tu carrito está vacío.
												</a>
											</li>
										<?php } ?>
									</div>
								</form>
							</div>
						</div>
					</section>
				</ul>
			</div>
		</ul>
	</nav>
	<!-- Fin Nav -->