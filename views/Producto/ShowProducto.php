<?php
include("../Templates/header.php");
require_once("../../Controllers/ProductoController.php");
$object = new ProductoController();

if (isset($_GET['action']) && $_GET['action'] == "create") {
    $arrRequest = array(
        "request" => $_REQUEST,
        "files" => $_FILES
    );
    $result = $object->create($arrRequest);
    header("Location: ListProducto.php?action=list");
    die();
}

if (isset($_GET['action']) && $_GET['action'] == "show") {
    $result = $object->show();
    $lstFabricantes = $result['lstFabricantes'];
}

if (isset($_GET['action']) && $_GET['action'] == "edit") {
    $result = $object->show();
    $lstFabricantes = $result['lstFabricantes'];
    $varObject = $object->edit($_REQUEST);
    $formAction = 'action="?action=update&id=' . $varObject['id'] . '"';
} else {
    $formAction = 'action="?action=create"';
}

if (isset($_GET['action']) && $_GET['action'] == "update") {
    $arrRequest = array(
        "request" => $_REQUEST,
        "files" => $_FILES
    );
    $result = $object->update($arrRequest);
    header("Location: ListProducto.php?action=list");
    die();
}




?>

<main class="container">
    <form <?php echo $formAction ?> enctype="multipart/form-data" method="post">
        <div class="card mt-2">
            <div class="card-header d-flex justify-content-between bg-dark">
                <h3 class="text-white">Producto</h3>
                <div class="d-flex justify-content-between">
                    <input class="btn btn-success" type="submit" value="Guardar Producto" name="guardar_producto">
                    <a class="btn btn-danger" href="ListProducto.php?action=list">Cancelar</a>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="form-group col-md-6 mt-1">
                        <label for="nombre">Nombre Videojuego:</label>
                        <input type="text" class="form-control mt-1" id="nombre" name="nombre" <?php echo (isset($varObject)) ? 'value="' . $varObject['nombre'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="id_fabricante">Nombre Fabricante:</label>
                        <select class="form-select" name="id_fabricante" id="id_fabricante" aria-label="Default select example">
                            <option <?php echo (isset($_GET['action']) && $_GET['action'] == "show") ? 'selected' : ''; ?>>Seleccione uno</option>
                            <?php
                            foreach ($lstFabricantes as $fabricante) {
                                $estadoOption = (isset($_GET['action']) && $_GET['action'] == "edit" && $varObject['id_fabricante'] == $fabricante['id']) ? 'selected' : '';
                                echo '<option value="' . $fabricante['id'] . '" ' . $estadoOption . '>' . $fabricante['nombre_fabricante'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6 mt-1">
                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type="number" class="form-control mt-1" id="precio" name="precio" min="0" step=".01" <?php echo (isset($varObject)) ? 'value="' . $varObject['precio'] . '"' : ''; ?> required>
                        </div>
                        <div class="form-group mt-1">
                            <label for="calificacion">Calificacion:</label>
                            <input type="number" class="form-control mt-1" id="calificacion" name="calificacion" min="0" max="5" step=".01" <?php echo (isset($varObject)) ? 'value="' . $varObject['calificacion'] . '"' : ''; ?>  required>
                        </div>
                        <div class="form-group mt-1 row">
                            <label for="imagen_prod" class="form-label">Imagen del Videojuego</label>
                            <div class="col-sm-7">
                                <?php $stateFileInput = (!isset($varObject)) ? 'required' : ''; ?>
                                <input class="form-control" accept="image/*" class="col-sm-2 form-control" type="file" id="imagen_prod" name="imagen_prod" <?php echo $stateFileInput ?>>
                            </div>
                            <div class="col-sm-4">
                                <?php $urlImg = (isset($varObject)) ? $urlServer . $varObject['dir_imagen'] : ''; ?>
                                <?php $stateDownload = (!isset($varObject)) ? 'hidden' : ''; ?>
                                <a class="btn btn-secondary" href="<?php echo $urlImg ?>" download="<?php echo $varObject['nombre'] ?>" <?php echo $stateDownload ?>>Descargar Imagen</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="descripcion">Descripcion:</label>
                        <textarea class="form-control mt-1" id="descripcion" name="descripcion" rows="7" required><?php echo (isset($varObject)) ? $varObject['descripcion'] : ''; ?></textarea>
                    </div>





                </div>
            </div>
        </div>
    </form>
</main>


<?php
include("../Templates/footer.php")
?>