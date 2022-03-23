<?php

use function PHPSTORM_META\type;

require_once("../../Controllers/ProductoController.php");

$object = new ProductoController();

session_start();

// Se crea session de carrito en caso de que no exista








try {
    if (isset($_GET['action']) && $_GET['action'] == "list") {
        $arrProducts = ($object->indexWithManufacturers());
        $lstObjects;

        //Se filtra los productos que ya existen en el carrito para que no se usen de nuevo

        if (isset($_SESSION['carrito_compra'])) {
            
            foreach ($arrProducts as $product) {
                
                $arrFiltered = array_filter($_SESSION['carrito_compra'], function ($var) use ($product) {
                    return ($var['id'] == $product['id']);
                });

                if(count($arrFiltered)==0){
                    $lstObjects[]=$product;
                }

            }
        } else {
            $lstObjects = $arrProducts;
        }
    }
} catch (Exception $e) {
    echo "Problema al cargar la pagina";
}


include("../Templates/header.php")
?>


<main>
    <section class="py-3 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <img src="../../Assets/img/logostroe.png" alt="logo_header">
            </div>
        </div>
    </section>
    <section>
        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php
                    foreach ($lstObjects as $object) {
                        echo '<div class="col">';
                        echo '    <div class="card shadow rounded">';
                        echo '        <div class="border-bottom border-secondary">';
                        echo '            <div class="card-img-top" style="height: 15rem; background-image: url(\'' . $urlServer . $object['dir_imagen'] . '\'); background-size:cover; background-position: center;"></div>';
                        echo '        </div>';
                        echo '        <div class="card-body">';
                        echo '            <h5 class="card-title">' . $object['nombre'] . '</h5>';
                        echo '            <h6 class="card-subtitle mb-2 text-muted">' . "Desarrollado por: " . $object['nombre_fabric_orig'] . '</h6>';
                        echo '            <p class="card-text">' . $object['descripcion'] . '</p>';
                        echo '            <div class="d-flex justify-content-between pe-2">';
                        echo '                <p class="card-text">Calificación: ' . $object['calificacion'] . '</p>';
                        echo '                <p class="card-text">Valor: $' . $object['precio'] . '</p>';
                        echo '            </div>';
                        echo '        </div>';
                        echo '        <div class="card-footer d-flex justify-content-center">';
                        echo '            <a class="btn btn-primary" href="ShowProductToBuy.php?id=' . $object['id'] . '">Ver Juego</a>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';
                    }


                    ?>



                </div>
            </div>
        </div>

    </section>
</main>

<?php include("../Templates/footer.php") ?>