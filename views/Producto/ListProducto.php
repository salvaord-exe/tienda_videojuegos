<?php

require_once("../../Controllers/ProductoController.php");

$object = new ProductoController();


try {
    if (isset($_GET['action']) && $_GET['action'] == "list") {
        $lstObjects = ($object->index());
    }
} catch (Exception $e) {
    echo "Problema al cargar la pagina";
}

if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $object->delete($_GET['id']);
    header("Location: ListProducto.php?action=list");
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
                <h3>Lista de Productos</h3>
                <a href="./ShowProducto.php?action=show" class="btn btn-success">Crear Producto +</a>
            </div>
            <div class="card-body">
                <form action="?action=search" method="post">
                    <div class="form-group col-sm-4 mb-2 d-flex">
                        <input type="text" class="form-control " id="param" name="param">
                        <input type="submit" class="ms-2 btn btn-primary" value="Buscar">
                        <a href="?action=list" class="ms-2 btn btn-secondary">Todos</a>
                    </div>

                </form>

                <table class="table table-bordered">
                    <thead>
                        <tr class="table-dark">
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Calificacion</th>
                            <th>Fecha Creación</th>
                            <th>Acciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($lstObjects as $varObject) {
                            echo "<tr>";
                            echo "<td>" . $varObject['id'] . "</td>";
                            echo "<td>" . $varObject['nombre'] . "</td>";
                            echo "<td>" . $varObject['precio'] . "</td>";
                            echo "<td>" . $varObject['calificacion'] . "</td>";
                            echo "<td>" . $varObject['fecha_creacion'] . "</td>";
                            echo '<td class="d-flex justify-content-around">';
                            echo '<a class="btn btn-warning" href="ShowProducto.php?id=' . $varObject['id'] . '&action=edit">Editar</a>';
                            echo '<a class="btn btn-danger" href="ListProducto.php?id=' . $varObject['id'] . '&action=delete">Eliminar</a>';
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