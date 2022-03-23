<?php
include("../Templates/header.php");
require_once("../../Controllers/ProductoController.php");
?>

<?php

$object = new ProductoController();

if (isset($_GET) && !isset($_GET['action'])) {
    $varObject = $object->findByIdWhitManufacturer($_GET['id']);
} else {
    $varObject = $object->findByIdWhitManufacturer($_GET['id_producto']);
}

?>
<main class="container ">
    <div class="row mb-2 mt-4 ">
        <div class="col-md-8">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col-md-5 d-none d-lg-block">
                    <div class="border-bottom border-secondary">
                        <?php echo '<div class="card-img-top" style="height: 30rem; background-image: url(\'' . $urlServer . $varObject['dir_imagen'] . '\'); background-size:cover; background-position: center;"></div>'; ?>
                    </div>
                </div>
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="mb-0"><?php echo $varObject['nombre'] ?></h3>
                    <h5 class="mb-1 text-muted">Por: <?php echo $varObject['nombre_fabric_orig'] ?> </h5>
                    <p class="fs-5 card-text mb-auto mt-3"><?php echo $varObject['descripcion'] ?></p>
                    <div class="">
                        <p class="card-text fs-4">Calificación: <span class="bi-star-fill" style="color: #fcbe03;"></span> <?php echo  $varObject['calificacion'] ?>/5 </p>
                        <p class="card-text fs-4">Precio: $ <span id="precio-producto"><?php echo  $varObject['precio'] ?></span> </p>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">

                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="mb-0">¡Lo quiero!</h3>
                    <form action="CarritoCompra.php" method="post">
                        <?php
                        if (isset($_GET['id_producto']) && isset($_GET['cantProducto'])) {
                            echo "Cantidad de productos = ".$_GET['cantProducto'];
                            $cantProducto = $_GET['cantProducto'];
                            $subTotalProducto = $varObject['precio'] * $cantProducto;
                            $stateAgregarCarrito = "hidden";
                            $stateActualizarCarrito = "";
                        }else{
                            $cantProducto = "0";
                            $subTotalProducto = "0";
                            $stateAgregarCarrito = "";
                            $stateActualizarCarrito = "hidden";
                        }
                        ?>

                        <p class="fs-2 mt-3"><span class="fs-4">Cantidad:</span> <a href="" id="restar-cant" class="bi-dash-circle-fill" style="color: black;"></a> <span id="cant-carrito"><?php echo $cantProducto ?></span> <a href="" id="sumar-cant" class="bi-plus-circle-fill" style="color: black;"></a></p>
                        <p class="fs-3 mt-3"><span class="fs-4">Subtotal:</span> $<span id="sub-carrito"><?php echo $subTotalProducto ?></span> </p>
                        <input type="text" id="id" name="id" value="<?php echo $varObject['id'] ?>" hidden>
                        <input type="text" id="nombre_producto" name="nombre_producto" value="<?php echo $varObject['nombre'] ?>" hidden>
                        <input type="number" id="cantidad_producto" name="cantidad_producto" value="<?php echo $cantProducto ?>" hidden>
                        <input type="number" id="precio_producto" name="precio_producto" step=".01" hidden>
                        <input type="number" id="subtotal_producto" name="subtotal_producto" step=".01" value="<?php echo $subTotalProducto ?>" hidden>
                        <div class="">
                            <input class="btn btn-primary" type="submit" id="agregar_carrito" name="agregar_carrito" value="Agregar al Carrito" disabled <?php echo $stateAgregarCarrito; ?>>
                            <input class="btn btn-primary" type="submit" id="actualizar_carrito" name="actualizar_carrito" value="Actualizar Carrito"  <?php echo $stateActualizarCarrito; ?>>
                            <script>
                                document.write('<a class="btn btn-secondary" href="' + document.referrer + '">Cancelar</a>');
                            </script>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</main>

<script src="../../Assets/js/ShowProductoToByJs.js"></script>

<?php include("../Templates/footer.php") ?>