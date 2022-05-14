<?php
include "config/config.php";
include "carrito.php";
include "layouts/header.php";
?>
<?php if (!empty($_SESSION['CARRITO'])) { ?>
	<div class="site-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 mb-5 mb-md-0">
					<h2 class="h3 mb-3 text-black">Detalles de compra</h2>
					<div class="p-3 p-lg-5 border">
						<form action="pagar.php" method="post">
							<div class="form-group">
								<label for="c_country" class="text-black">País/región <span class="text-danger">*</span></label>
								<select id="c_country" class="form-control">
									<option value="1">Colombia</option>
								</select>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="nombre" class="text-black">Nombre <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="nombre" name="nombre" require>
								</div>
								<div class="col-md-6">
									<label for="apellido" class="text-black">Apellido <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="apellido" name="apellido" require>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label for="correo" class="text-black">Correo <span class="text-danger">*</span></label>
									<input type="email" class="form-control" id="correo" name="correo" require>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<label for="direccion" class="text-black">Dirección <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" require>
								</div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Apartamento, suite, unidad, etc. (Opcional)">
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="ciudad" class="text-black">Ciudad <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="ciudad" name="ciudad" require>
								</div>
								<div class="col-md-6">
									<label for="codigop" class="text-black">Código postal <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="codigop" name="codigop" require>
								</div>
							</div>
							<div class="form-group row mb-5">
								<div class="col-md-12">
									<label for="numero" class="text-black">Telefono <span class="text-danger">*</span></label>
									<input type="tel" class="form-control" id="numero" name="numero" placeholder="Número de teléfono" require>
								</div>
							</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-5">
						<div class="col-md-12">
							<h2 class="h3 mb-3 text-black">Su pedido</h2>
							<div class="p-3 p-lg-5 border">
								<table class="table site-block-order-table mb-5">
									<thead>
										<th>Producto</th>
										<th>Total</th>
									</thead>
									<tbody>
										<?php $total = 0; ?>
										<?php foreach ($_SESSION['CARRITO'] as $indice => $producto) { ?>
											<tr>
												<td><?php echo $producto['NOMBRE'] ?><strong class="mx-2">x</strong> <?php echo $producto['CANTIDAD'] ?></td>
												<td><?php echo number_format($producto['PRECIO']) ?></td>
											</tr>
											<?php $total = $total + ($producto['PRECIO'] * $producto['CANTIDAD']); ?>
										<?php } ?>
										<tr>
											<td class="text-black font-weight-bold"><strong>Total</strong></td>
											<td class="text-black font-weight-bold"><strong>$<?php echo number_format($total) ?></strong></td>
										</tr>
									</tbody>
								</table>
								<div class="d-grid gap-2">
									<button class="btn btn-primary btn-lg btn-block" type="submit" name="btnAccion" value="proceder">Realizar pedido</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>


<?php include("./layouts/footer.php"); ?>