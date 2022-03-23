<?php
include("../Templates/header.php");
require_once("../../Controllers/UsuarioClienteController.php");

$object = new UsuarioClienteController();

if (isset($_GET['action']) && $_GET['action'] == "create") {
    $result = $object->create($_REQUEST);
    echo $result;
    header("Location: ListUsuarioCliente.php?action=list");
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
    header("Location: ListUsuarioCliente.php?action=list");
    die();
}



?>

<main class="container">
    <form <?php echo $formAction ?> method="post">
        <div class="card my-4">
            <div class="card-header d-flex justify-content-between bg-dark">
                <h3 class="text-white">Crear Usuario Cliente</h3>
                <div class="d-flex justify-content-between">
                    <input class="btn btn-success" type="submit" value="Crear Usuario" name="guardar_UsuarioCliente">
                    <a class="btn btn-danger" href="../../index.php">Cancelar</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6 mt-1">
                        <label for="primer_nombre">Primer Nombre:</label>
                        <input type="text" class="form-control mt-1" id="primer_nombre" name="primer_nombre" <?php echo (isset($varObject)) ? 'value="' . $varObject['nombre_UsuarioCliente'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="segundo_nombre">Segundo Nombre:</label>
                        <input type="text" class="form-control mt-1" id="segundo_nombre" name="segundo_nombre" <?php echo (isset($varObject)) ? 'value="' . $varObject['nombre_UsuarioCliente'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="primer_apellido">Primer Apellido:</label>
                        <input type="text" class="form-control mt-1" id="primer_apellido" name="primer_apellido" <?php echo (isset($varObject)) ? 'value="' . $varObject['nombre_UsuarioCliente'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="segundo_apellido">Segundo Apellido:</label>
                        <input type="text" class="form-control mt-1" id="segundo_apellido" name="segundo_apellido" <?php echo (isset($varObject)) ? 'value="' . $varObject['nombre_UsuarioCliente'] . '"' : ''; ?> required>
                    </div>
                    

                    
                    <div class="form-group col-md-6 mt-1">
                        <label for="celular1">Celular 1:</label>
                        <input type="text" class="form-control mt-1" id="celular1" name="celular1" <?php echo (isset($varObject)) ? 'value="' . $varObject['telefono1'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="celular2">Celular 2:</label>
                        <input type="text" class="form-control mt-1" id="celular2" name="celular2" <?php echo (isset($varObject)) ? 'value="' . $varObject['telefono2'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="id_pais">País:</label>
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
                        <label for="id_pais">Provincia:</label>
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
                        <label for="id_pais">Ciudad:</label>
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
                        <label for="correo_usuario">Correo Usuario:</label>
                        <input type="mail" class="form-control mt-1" id="correo_usuario" name="correo_UsuarioCliente" <?php echo (isset($varObject)) ? 'value="' . $varObject['correo_UsuarioCliente'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="contrasenia">Contraseña Usuario:</label>
                        <input type="password" class="form-control mt-1" id="contrasenia" name="contrasenia" <?php echo (isset($varObject)) ? 'value="' . $varObject['correo_UsuarioCliente'] . '"' : ''; ?> required>
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