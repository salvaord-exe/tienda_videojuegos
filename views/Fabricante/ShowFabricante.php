<?php
include("../Templates/header.php");
require_once("../../Controllers/FabricanteController.php");

$object = new FabricanteController();

if (isset($_GET['action']) && $_GET['action'] == "create") {
    $result = $object->create($_REQUEST);
    echo $result;
    header("Location: ListFabricante.php?action=list");
    die();
}

if (isset($_GET['action']) && $_GET['action'] == "show") {
    $result = $object->show();
    $lstPaises = $result['lstPaises'];
}

if (isset($_GET['action']) && $_GET['action'] == "edit") {
    $varObject = $object->edit($_REQUEST);
    $formAction = 'action="?action=update&id=' . $varObject['id'] . '"';
    $result = $object->show();
    $lstPaises = $result['lstPaises'];
} else {
    $formAction = 'action="?action=create"';
}

if (isset($_GET['action']) && $_GET['action'] == "update") {
    $result = $object->update($_REQUEST);
    //echo json_encode($result);
    header("Location: ListFabricante.php?action=list");
    die();
}



?>

<main class="container">
    <form <?php echo $formAction ?> method="post">
        <div class="card mt-2">
            <div class="card-header d-flex justify-content-between bg-dark">
                <h3 class="text-white">Fabricante</h3>
                <div class="d-flex justify-content-between">
                    <input class="btn btn-success" type="submit" value="Guardar Fabricante" name="guardar_Fabricante">
                    <a class="btn btn-danger" href="ListFabricante.php?action=list">Cancelar</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6 mt-1">
                        <label for="nombre_fabricante">Nombre Fabricante:</label>
                        <input type="text" class="form-control mt-1" id="nombre_fabricante" name="nombre_fabricante" <?php echo (isset($varObject)) ? 'value="' . $varObject['nombre_fabricante'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="id_pais">Nombre Fabricante:</label>
                        <select class="form-select" name="id_pais" id="id_pais" aria-label="Default select example">
                            <option <?php echo (isset($_GET['action']) && $_GET['action'] == "show")?'selected':''; ?>>Seleccione uno</option>
                            <?php
                                foreach($lstPaises as $pais){
                                    $estadoOption = (isset($_GET['action']) && $_GET['action'] == "edit" && $varObject['id_pais']==$pais['id'])?'selected':'';
                                    echo '<option value="'.$pais['id'].'" '.$estadoOption.'>'.$pais['nombre_cat_detalle'].'</option>';
                                }
                            ?>
                        </select>

                    </div>

                    <div class="form-group col-md-6 mt-1">
                        <label for="nombre_contacto">Nombre Contacto:</label>
                        <input type="text" class="form-control mt-1" id="nombre_contacto" name="nombre_contacto" <?php echo (isset($varObject)) ? 'value="' . $varObject['nombre_contacto'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="telefono1">Teléfono 1:</label>
                        <input type="text" class="form-control mt-1" id="telefono1" name="telefono1" <?php echo (isset($varObject)) ? 'value="' . $varObject['telefono1'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="telefono2">Teléfono 2:</label>
                        <input type="text" class="form-control mt-1" id="telefono2" name="telefono2" <?php echo (isset($varObject)) ? 'value="' . $varObject['telefono2'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="correo_fabricante">Correo Fabricante:</label>
                        <input type="mail" class="form-control mt-1" id="correo_fabricante" name="correo_fabricante" <?php echo (isset($varObject)) ? 'value="' . $varObject['correo_fabricante'] . '"' : ''; ?> required>
                    </div>

                    <div class="form-group col-md-6 mt-1">
                        <label for="fecha_inicio_contrato">Fecha Inicio Contrato:</label>
                        <input type="date" class="form-control mt-1" id="fecha_inicio_contrato" name="fecha_inicio_contrato" <?php echo (isset($varObject)) ? 'value="' . $varObject['fecha_inicio_contrato'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="fecha_renovacion_contrato">Fecha Renovacion Contrato:</label>
                        <input type="date" class="form-control mt-1" id="fecha_renovacion_contrato" name="fecha_renovacion_contrato" <?php echo (isset($varObject)) ? 'value="' . $varObject['fecha_renovacion_contrato'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="fecha_fin_contrato">Fecha Fin Contrato:</label>
                        <input type="date" class="form-control mt-1" id="fecha_fin_contrato" name="fecha_fin_contrato" <?php echo (isset($varObject)) ? 'value="' . $varObject['fecha_fin_contrato'] . '"' : ''; ?> required>
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