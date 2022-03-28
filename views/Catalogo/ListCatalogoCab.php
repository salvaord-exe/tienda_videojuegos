<?php

require_once("../../Controllers/CatalogoCabController.php");

$object = new CatalogoCabController();



try {
    if (isset($_GET['action']) && $_GET['action'] == "list") {
        $lstObjects = ($object->index());
    }
} catch (Exception $e) {
    echo "Problema al cargar la pagina";
}

if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $object->delete($_GET['idCatCab']);
    header("Location: ListCatalogoCab.php?action=list");
    die();
}

if (isset($_GET['action']) && $_GET['action'] == "search") {
    $lstObjects = ($object->searchByText($_POST['param']));
}

include("../Templates/header.php");
?>

<main>
    <div class="container">
        <div class="card mt-2">
            <div class="card-header d-flex justify-content-between">
                <h3>Lista de Catalogos Cabecera</h3>
                <a href="./ShowCatalogoCab.php?action=show" class="btn btn-success">Crear CatalogoCab +</a>
            </div>
            <div class="card-body">
            
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-dark">
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Fecha Creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($lstObjects as $varObject) {
                            echo "<tr>";
                            echo "<td>" . $varObject['id'] . "</td>";
                            echo "<td>" . $varObject['nombre_cabecera'] . "</td>";
                            echo "<td>" . $varObject['descripcion'] . "</td>";
                            echo "<td>" . $varObject['estado'] . "</td>";
                            echo "<td>" . $varObject['fecha_creacion'] . "</td>";
                            
                            echo '<td class="d-flex justify-content-around">';
                            echo '<a class="btn btn-warning" href="ShowCatalogoCab.php?idCatCab=' . $varObject['id'] . '&action=edit">Editar</a>';
                            echo '<a class="btn btn-danger" href="ListCatalogoCab.php?idCatCab=' . $varObject['id'] . '&action=delete">Eliminar</a>';
                            echo "</td>";
                            echo "</tr>";
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php
include("../Templates/footer.php");
?>