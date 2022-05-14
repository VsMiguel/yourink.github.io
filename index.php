<?php
include "config/config.php";
include "config/conexion.php";
include "carrito.php";
include "layouts/header.php";
?>
<!-- Header -->
<header class="container-slider">
    <div class="slider" id="slider">
        <div class="slider__section">
            <img src="assets/img/87fcd098d14162c6c7f2a9463d6a4b33.jpg" alt="" class="slider__img">
            <div class="slider__content">
                <h2 class="slider__title">Tenis personalizados</h2>
                <p class="slider__txt">Hasta el 50% de descuento</p>
                <a href="" class="btn-shop">SHOP NOW</a>
            </div>
        </div>
        <div class="slider__section">
            <img src="assets/img/fbb2a59cb94b9b7f6730ea6292a956c9.jpg" alt="" class="slider__img">
            <div class="slider__content">
                <h2 class="slider__title">Estilos </h2>
                <p class="slider__txt">Prediseñados</p>
                <a href="" class="btn-shop">SHOP NOW</a>
            </div>
        </div>
        <div class="slider__section">
            <img src="assets/img/signup@3x.jpg" alt="" class="slider__img">
            <div class="slider__content">
                <h2 class="slider__title">Diseña tu propio</h2>
                <p class="slider__txt">estilo</p>
                <a href="" class="btn-shop">SHOP NOW</a>
            </div>
        </div>
        <div class="slider__section">
            <img src="assets/img/dae2bd_8d504648f2ae4f3e92313f62ea394bca_mv2.jpg" alt="" class="slider__img">
        </div>
    </div>
    <div class="slider__btn slider__btn--right" id="btn-right">&#62;</div>
    <div class="slider__btn slider__btn--left" id="btn-left">&#60;</div>
</header>
<!-- Fin header -->
<!-- Categorias -->
<!-- Fin categorias -->
<!-- Productos -->
<section class="page-section bg-light" id="producto">
    <div class="container">
        <br>
        <!-- <div class="alert alert-success"> -->
        <?php
        // echo $mensaje;
        ?>
        <!-- </div> -->
        <div class="row row-cols-1 row-cols-md-5 g-4">
            <?php
            $sentencia = $pdo->prepare("SELECT * FROM `productos`");
            $sentencia->execute();
            $listaProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($listaProductos as $producto) { ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="producto-item">
                            <a class="producto-link" data-bs-toggle="modal" href="#productoModal<?php echo $producto['id']; ?>">
                                <div class="producto-hover">
                                    <div class="producto-hover-content"><i class="fa-solid fa-eye fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/<?php echo $producto['imagen']; ?>" alt="..." />
                            </a>
                            <div class="producto-caption">
                                <div class="producto-caption-heading"><?php echo $producto['nombre']; ?></div>
                                <div class="producto-caption-subheading text-muted">$<?php echo number_format($producto['precio_normal']); ?></div>
                                <div class="d-grid gap-2 d-md-block">
                                    <form action="" method="post">
                                        <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['id'], COD, KEY); ?>">
                                        <input type="hidden" name="imagen" id="imagen" value="<?php echo openssl_encrypt($producto['imagen'], COD, KEY); ?>">
                                        <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'], COD, KEY); ?>">
                                        <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio_normal'], COD, KEY); ?>">
                                        <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">
                                        <a class="btn btn-primary" data-bs-toggle="modal" href="#productoModal<?php echo $producto['id']; ?>">Mas
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- Fin productos -->
<!-- Popup -->
<div class="pop-up modal fade">
    <div class="pop-up-wrap">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModal">-10% para ti</h5>
                    <button type="button" class="btn-close" id="close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Registra tu correo y recibe tu codigo de 10% descuento para tu
                        próxima
                        compra</p>
                    <form>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Correo...">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="exampleCheck1" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Estoy de
                                acuerdo
                                con los términos y condiciones</label>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin popup -->
<!-- modal producto -->
<?php foreach ($listaProductos as $producto) { ?>
    <div class="producto-modal modal fade" id="productoModal<?php echo $producto['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                <div class="container">
                    <div class="card card-solid">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <h3 class="d-inline-block d-sm-none"><?php echo $producto['nombre']; ?></h3>
                                    <div class="col-12">
                                        <img src="assets/img/<?php echo $producto['imagen']; ?>" width="400px" class="product-image" alt="Product Image">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h3 class="my-3"><?php echo $producto['nombre']; ?></h3>
                                    <p><?php echo $producto['descripcion']; ?></p>

                                    <hr>

                                    <form action="" method="post">
                                        <h4 class="mt-3">Cantidad</h4>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <div class="quantity">
                                                <input type="number" min="1" max="100" step="1" name="cantidad" id="cantidad" value="<?php echo 1; ?>">
                                            </div>
                                        </div>

                                        <div class="bg-gray py-2 px-3 mt-4">
                                            <h2 class="mb-0">
                                                $<?php echo number_format($producto['precio_rebajado']); ?>
                                            </h2>
                                            <h4 class="mt-0">
                                                <small><?php echo number_format($producto['precio_normal']); ?></small>
                                            </h4>
                                        </div>
                                        <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['id'], COD, KEY); ?>">
                                        <input type="hidden" name="imagen" id="imagen" value="<?php echo openssl_encrypt($producto['imagen'], COD, KEY); ?>">
                                        <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'], COD, KEY); ?>">
                                        <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio_normal'], COD, KEY); ?>">
                                        <button class="btn btn-primary " type="submit" name="btnAccion" value="Agregar"><i class="fa-solid fa-cart-plus me-1"></i> Agregar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php } ?>
<!-- fin modal producto -->
<!-- Footer-->
<?php include("layouts/footer.php"); ?>