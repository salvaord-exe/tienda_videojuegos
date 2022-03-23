<?php

require_once("../../Controllers/CatalogoDetController.php");

$object = new CatalogoDetController();

if (isset($_GET['action']) && $_GET['action'] == "show") {
    include("../Templates/header.php");
    $varCab = $object->searchCabById($_REQUEST['idCab']);
    $formAction = 'action="?action=create&idCab='.$_REQUEST['idCab'].'"';
}

if (isset($_GET['action']) && $_GET['action'] == "create") {
    $result = $object->create($_REQUEST);
    $cabId = $_REQUEST['idCab'];
    header("Location: ShowCatalogoCab.php?idCatCab={$cabId}&action=edit");
    die();
}

if (isset($_GET['action']) && $_GET['action'] == "edit") {
    $varCab = $object->searchCabById($_REQUEST['idCab']);
    $varObject = $object->edit($_REQUEST);
    $formAction = 'action="?action=update&id='.$varObject['id'] .'&idCab='.$_REQUEST['idCab'].'"';
} else {
    
}

if (isset($_GET['action']) && $_GET['action'] == "update") {
    $result = $object->update($_REQUEST);
    //echo json_encode($result);
    $cabId = $_REQUEST['idCab'];
    header("Location: ShowCatalogoCab.php?idCatCab={$cabId}&action=edit");
    die();
}



?>

<main class="container">
    <form <?php echo $formAction ?> method="post">
        <div class="card mt-2">
            <div class="card-header d-flex justify-content-between bg-dark">
                <h3 class="text-white">Catálogo Cabecera</h3>
                <div class="d-flex justify-content-between">
                    <input class="btn btn-success" type="submit" value="Guardar CatalogoDet" name="guardar_CatalogoDet">
                    <a class="btn btn-danger" href="ShowCatalogoCab.php?action=edit&idCatCab=<?php echo $_REQUEST['idCab']; ?>">Cancelar</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6 mt-1">
                        <label for="nombre_cat_detalle">Nombre Catalogo:</label>
                        <input type="text" class="form-control mt-1" id="nombre_cat_detalle" name="nombre_cat_detalle" <?php echo (isset($varObject)) ? 'value="' . $varObject['nombre_cat_detalle'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="descripcion">Descripción Corta:</label>
                        <input type="text" class="form-control mt-1" id="descripcion" name="descripcion" <?php echo (isset($varObject)) ? 'value="' . $varObject['descripcion'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="cabecera">Cabecera:</label>
                        <input type="text" class="form-control mt-1" id="cabecera" name="cabecera" <?php echo (isset($varCab)) ? 'value="' . $varCab['nombre_cabecera'] . '"' : ''; ?> required disabled>
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


            </div>
        </div>
    </form>
</main>


<?php
include("../Templates/footer.php")
?>