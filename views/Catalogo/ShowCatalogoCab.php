<?php
require_once("../../Controllers/CatalogoCabController.php");
require_once("../../Controllers/CatalogoDetController.php");


$object = new CatalogoCabController();
$objectCatDet = new CatalogoDetController();

if (isset($_GET['action']) && $_GET['action'] == "create") {
    $result = $object->create($_REQUEST);
    echo $result;
    header("Location: ListCatalogoCab.php?action=list");
    die();
}

if (isset($_GET['action']) && $_GET['action'] == "show") {
    include("../Templates/header.php");
}

if (isset($_GET['action']) && $_GET['action'] == "edit" || $_GET['action'] == "deleteCat") {
    include("../Templates/header.php");
    if($_GET['action']=="deleteCat"){
        $objectCatDet->delete($_GET['idCatDet']);
    }
    $varObject = $object->edit($_REQUEST);
    $formAction = 'action="?action=update&id=' . $varObject['id'] . '"';
    $childObject = new CatalogoDetController();
    $lstChildObject = $childObject->collectByCabId($varObject['id']);
} else {
    $formAction = 'action="?action=create"';
}

if (isset($_GET['action']) && $_GET['action'] == "update") {
    $result = $object->update($_REQUEST);
    //echo json_encode($result);
    header("Location: ListCatalogoCab.php?action=list");
    die();
}

/*
if (isset($_GET['action']) && $_GET['action'] == "delete") {
    include("../Templates/header.php");
    $result = $object->delete($_REQUEST['idCatDet']);
    
}
*/

?>

<main class="container">
    <form <?php echo $formAction ?> method="post">
        <div class="card mt-2">
            <div class="card-header d-flex justify-content-between bg-dark">
                <h3 class="text-white">Catálogo Cabecera</h3>
                <div class="d-flex justify-content-between">
                    <input class="btn btn-success" type="submit" value="Guardar CatalogoCab" name="guardar_CatalogoCab">
                    <a class="btn btn-danger" href="ListCatalogoCab.php?action=list">Cancelar</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6 mt-1">
                        <label for="nombre_cabecera">Nombre Catalogo:</label>
                        <input type="text" class="form-control mt-1" id="nombre_cabecera" name="nombre_cabecera" <?php echo (isset($varObject)) ? 'value="' . $varObject['nombre_cabecera'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="descripcion">Descripción Corta:</label>
                        <input type="text" class="form-control mt-1" id="descripcion" name="descripcion" <?php echo (isset($varObject)) ? 'value="' . $varObject['descripcion'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="fecha_creacion">Fecha de Creación:</label>
                        <input type="datetime" class="form-control mt-1" id="fecha_creacion" name="fecha_creacion" <?php echo (isset($varObject)) ? 'value="' . $varObject['fecha_creacion'] . '"' : ''; ?> required disabled>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="fecha_modificacion">Ult Fecha Modificación:</label>
                        <input type="datetime" class="form-control mt-1" id="fecha_modificacion" name="fecha_modificacion" <?php echo (isset($varObject)) ? 'value="' . $varObject['fecha_modificacion'] . '"' : ''; ?> required disabled>
                    </div>
                </div>

                <div class="card mt-3" <?php echo (isset($lstChildObject)) ? '' : 'hidden' ?>>
                    <div class="card-header d-flex justify-content-between">
                        <h4>Lista de <?php echo $varObject['nombre_cabecera']?></h4>
                        <a href="./ShowCatalogoDet.php?action=show&idCab=<?php echo $varObject['id']?>" class="btn btn-success">Crear Catalogo +</a>
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
                                    <th>Descripcion</th>
                                    <th>Estado</th>
                                    <th>Fecha Creación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                foreach ($lstChildObject as $varChild) {
                                    echo "<tr>";
                                    echo "<td>" . $varChild['id'] . "</td>";
                                    echo "<td>" . $varChild['nombre_cat_detalle'] . "</td>";
                                    echo "<td>" . $varChild['descripcion'] . "</td>";
                                    echo "<td>" . $varChild['estado'] . "</td>";
                                    echo "<td>" . $varChild['fecha_creacion'] . "</td>";

                                    echo '<td class="d-flex justify-content-around">';
                                    echo '<a class="btn btn-warning" href="ShowCatalogoDet.php?id=' . $varChild['id'] . '&action=edit&idCab='.$varObject['id'].'">Editar</a>';
                                    echo '<a class="btn btn-danger" href="ShowCatalogoCab.php?idCatCab='.$varObject['id'].'&idCatDet=' . $varChild['id'] . '&action=deleteCat">Eliminar</a>';
                                    echo "</td>";
                                    echo "</tr>";
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </form>
</main>


<?php
include("../Templates/footer.php")
?>