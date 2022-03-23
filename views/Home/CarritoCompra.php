<?php
session_start();

require_once("../../Controllers/ProductoController.php");


if (isset($_SESSION['carrito_compra'])) {
    if (isset($_POST['agregar_carrito'])) {
        array_push($_SESSION['carrito_compra'], $_POST);
        header("Location: CarritoCompra.php");
        
    } else {
        if (isset($_POST['actualizar_carrito'])) {

            $prodUpdate = array_filter($_SESSION['carrito_compra'], function ($var) {
                return ($var['id'] == $_POST['id']);
            });
            $_SESSION['carrito_compra'][key($prodUpdate)] = $_POST;
            header("Location: CarritoCompra.php");
            
        }
    }
} else {
    if (isset($_POST['agregar_carrito'])) {
        $_SESSION['carrito_compra'][] = $_POST;
        header("Location: CarritoCompra.php");
        die();
    } else {
    }
}


if (isset($_GET['action']) && $_GET['action'] == "delete") {

    unset($_SESSION['carrito_compra'][$_GET['key_producto']]);
    header("Location: CarritoCompra.php");
    die();
}



if (isset($_GET['action']) && $_GET['action'] == "clean_cart") {
    if (isset($_SESSION['carrito_compra'])) {
        unset($_SESSION['carrito_compra']);
    }
}


include("../Templates/header.php");
?>



<main class="container">



    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Aviso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fs-3"> Debe iniciar sesión para poder realizar una compra.  </p> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="Login.php">Iniciar Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-2 mt-4 ">
        <?php
        if (isset($errorMessage)) {
            echo '
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Error de Ingreso</strong> <br>' . $errorMessage . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
        }
        ?>
        <div class="col-md-8">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Carrito</h4>
                        <div>
                            <a class="btn btn-danger" href="?action=clean_cart">Limpiar Carrito</a>
                            <a class="btn btn-primary" href="home.php?action=list">Agregar Producto</a>
                        </div>


                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr class="">
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Valor Unitario</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $cantTotal = 0;
                                $totalPagar = 0;
                                if (isset($_SESSION['carrito_compra'])) {
                                    $arrProductos = $_SESSION['carrito_compra'];
                                    //(isset($_SESSION['carrito_compra'])) ? var_dump($_SESSION['carrito_compra']) : '';
                                    $cantTotal = 0;
                                    $totalPagar = 0;
                                    foreach ($arrProductos as $key => $varProducto) {
                                        $cantTotal += $varProducto['cantidad_producto'];
                                        $totalPagar += $varProducto['subtotal_producto'];
                                        echo
                                        '<tr>
                                            <td>' . $varProducto['id'] . '</td>
                                            <td>' . $varProducto['nombre_producto'] . '</td>
                                            <td> $' . $varProducto['precio_producto'] . '</td>
                                            <td>' . $varProducto['cantidad_producto'] . '</td>
                                            <td> $' . $varProducto['subtotal_producto'] . '</td>
                                            <td class="d-flex justify-content-around">
                                                <a class="btn btn-warning btn-sm" href="ShowProductToBuy.php?action=edit&id_producto=' . $varProducto['id'] . '&cantProducto=' . $varProducto['cantidad_producto'] . '"><span class="bi-pen-fill"></span></a>
                                                <a class="btn btn-danger btn-sm" href="?action=delete&key_producto=' . $key . '"><span class="bi-trash-fill"></span></a>                
                                            </td>
                                        </tr>';
                                    }
                                }


                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">

                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="mb-0">Resumen</h3>
                    <form action="CarritoCompra.php?action=clean_cart" method="post">

                        <p class="fs-2 mt-3"><span class="fs-4">Cantidad:</span> <?php echo $cantTotal; ?> </p>
                        <p class="fs-3 mt-3"><span class="fs-4">Total a Pagar:</span> $<?php echo $totalPagar; ?></p>

                        <div class="">
                            <input class="btn btn-primary" type="submit" id="realizar_compra" name="realizar_compra" value="Realizar Compra 💵">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Realizar Compra Inicio Sesión
                            </button>

                            <a class="btn btn-secondary" href="home.php?action=list">Cancelar</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</main>

<?php
include("../Templates/footer.php");
?>