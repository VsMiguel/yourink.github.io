<?php
session_start();
$mensaje = "";
if (isset($_POST['btnAccion'])) {
    switch ($_POST['btnAccion']) {
        case 'Agregar':
            if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                $ID = openssl_decrypt($_POST['id'], COD, KEY);
                $mensaje .= "Ok id correcto " . $ID . "<br/>";
            } else {
                $mensaje .= "Upps.. algo pasa con el cantidad" . $ID . "<br/>";
                break;
            }
            if (is_string(openssl_decrypt($_POST['imagen'], COD, KEY))) {
                $IMAGEN = openssl_decrypt($_POST['imagen'], COD, KEY);
                $mensaje .= "Ok imagen correcta " . $IMAGEN . "<br/>";
            } else {
                $mensaje .= "Upps.. algo pasa con la imagen" . $IMAGEN . "<br/>";
                break;
            }
            if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {
                $NOMBRE = openssl_decrypt($_POST['nombre'], COD, KEY);
                $mensaje .= "Ok nombre correcto " . $NOMBRE . "<br/>";
            } else {
                $mensaje .= "Upps.. algo pasa con el nombre";
                break;
            }
            if (is_numeric($_POST['cantidad'])) {
                $CANTIDAD = $_POST['cantidad'];
                $mensaje .= "Ok cantidad correcto " . $CANTIDAD . "<br/>";
            } else {
                $mensaje .= "Upps.. algo pasa con el cantidad";
                break;
            }
            if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
                $PRECIO = openssl_decrypt($_POST['precio'], COD, KEY);
                $mensaje .= "Ok precio " . $PRECIO;
            } else {
                $mensaje .= "Upps.. algo pasa con el precio";
                break;
            }

            if (!isset($_SESSION['CARRITO'])) {
                $producto = array(
                    'ID' => $ID,
                    'IMAGEN' => $IMAGEN,
                    'NOMBRE' => $NOMBRE,
                    'CANTIDAD' => $CANTIDAD,
                    'PRECIO' => $PRECIO
                );
                $_SESSION['CARRITO'][0] = $producto;
            } else {
                $idProductos = array_column($_SESSION['CARRITO'], "ID");
                if (in_array($ID, $idProductos)) {
                    $CANTIDAD = + 1;
                } else {
                    $numeroProductos = count($_SESSION['CARRITO']);
                    $producto = array(
                        'ID' => $ID,
                        'IMAGEN' => $IMAGEN,
                        'NOMBRE' => $NOMBRE,
                        'CANTIDAD' => $CANTIDAD,
                        'PRECIO' => $PRECIO
                    );
                    $_SESSION['CARRITO'][$numeroProductos] = $producto;
                }
            }
            $mensaje = print_r($_SESSION, true);


            break;
        case 'Eliminar':
            if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                $ID = openssl_decrypt($_POST['id'], COD, KEY);
                foreach ($_SESSION['CARRITO'] as $indice => $producto) {
                    if ($producto['ID'] == $ID) {
                        unset($_SESSION['CARRITO'][$indice]);
                    }
                }
            } else {
                $mensaje .= "Upps.. algo pasa con el cantidad" . $ID . "<br/>";
                break;
            }
            break;
    }
}
