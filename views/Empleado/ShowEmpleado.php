<?php

require_once("../../Controllers/EmpleadoController.php");
require_once("../../Controllers/CatalogoDetController.php");
$object = new EmpleadoController();
$catObjecto = new CatalogoDetController();


if (isset($_GET['action']) && $_GET['action'] == "create") {

    $result = $object->create($_REQUEST);

    if (!$result) {
        $message = "Correo ya existe, favor ingresar nuevamente";
        
    } else {
        echo $result;
        header("Location: ListEmpleado.php?action=list");
        die();
    }
}

if (isset($_GET['action']) && $_GET['action'] == "show") {
    include("../Templates/header.php");
    $lstPerfiles = $object->collectPerfiles();
    $lstPaises = $catObjecto->collectPaises();
    $lstProvincias = $catObjecto->collectProvincias();
    $lstCiudades = $catObjecto->collectCiudades();
    $lstSexos = $catObjecto->collectSexos();
}

if (isset($_GET['action']) && $_GET['action'] == "edit") {
    include("../Templates/header.php");
    $lstPerfiles = $object->collectPerfiles();
    $lstPaises = $catObjecto->collectPaises();
    $lstProvincias = $catObjecto->collectProvincias();
    $lstCiudades = $catObjecto->collectCiudades();
    $lstSexos = $catObjecto->collectSexos();
    $varObject = $object->edit($_REQUEST);
    $formAction = 'action="?action=update&id=' . $varObject['id'] . '"';
} else {
    $formAction = 'action="?action=create"';
}

if (isset($_GET['action']) && $_GET['action'] == "update") {
    $result = $object->update($_REQUEST);
    echo $result;
    header("Location: ListEmpleado.php?action=list");
    die();
}




?>

<main class="container">
    <form <?php echo $formAction ?> method="post">
        <div class="card my-4">

            

            <div class="card-header d-flex justify-content-between bg-dark">
                <h3 class="text-light">Crear Empleado</h3>
                <div class="">
                    <input class="btn btn-success" type="submit" value="Guardar Empleado" name="guardar_Empleado">
                    <a class="btn btn-danger" href="ListEmpleado.php?action=list">Cancelar</a>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="form-group col-md-6 mt-1">
                        <label for="primer_nombre">Primer Nombre:</label>
                        <input type="text" class="form-control mt-1" id="primer_nombre" name="primer_nombre" <?php echo (isset($varObject)) ? 'value="' . $varObject['primer_nombre'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="segundo_nombre">Segundo Nombre:</label>
                        <input type="text" class="form-control mt-1" id="segundo_nombre" name="segundo_nombre" <?php echo (isset($varObject)) ? 'value="' . $varObject['segundo_nombre'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="primer_apellido">Primer Apellido:</label>
                        <input type="text" class="form-control mt-1" id="primer_apellido" name="primer_apellido" <?php echo (isset($varObject)) ? 'value="' . $varObject['primer_apellido'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="segundo_apellido">Segundo Apellido:</label>
                        <input type="text" class="form-control mt-1" id="segundo_apellido" name="segundo_apellido" <?php echo (isset($varObject)) ? 'value="' . $varObject['segundo_apellido'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="correo_usuario">Correo Usuario:</label>
                        <input type="mail" class="form-control mt-1" id="correo_usuario" name="correo_usuario" <?php echo (isset($varObject)) ? 'value="' . $varObject['correo_usuario'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="contrasenia">Contraseña:</label>
                        <input type="password" class="form-control mt-1" id="contrasenia" name="contrasenia" <?php echo (isset($varObject)) ? 'value="' . $varObject['contrasenia'] . '"' : ''; ?> required>
                    </div>

                    <div class="form-group col-md-6 mt-1">
                        <label for="fecha_nacimiento">Fecha Nacimiento:</label>
                        <input type="date" class="form-control mt-1" id="fecha_nacimiento" name="fecha_nacimiento" <?php echo (isset($varObject)) ? 'value="' . $varObject['fecha_nacimiento'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="celular1">Celular 1:</label>
                        <input type="text" class="form-control mt-1" id="celular1" name="celular1" <?php echo (isset($varObject)) ? 'value="' . $varObject['celular1'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="celular2">Celular 2:</label>
                        <input type="text" class="form-control mt-1" id="celular2" name="celular2" <?php echo (isset($varObject)) ? 'value="' . $varObject['celular2'] . '"' : ''; ?> required>
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="id_perfil">Perfil:</label>
                        <select class="form-select" name="id_perfil" id="id_perfil" aria-label="Default select example">
                            <option <?php echo (isset($_GET['action']) && $_GET['action'] == "show") ? 'selected' : ''; ?>>Seleccione uno</option>
                            <?php
                            foreach ($lstPerfiles as $element) {
                                $estadoOption = (isset($_GET['action']) && $_GET['action'] == "edit" && isset($varObject['id_perfil']) &&  $varObject['id_perfil'] == $element['id']) ? 'selected' : '';
                                echo '<option value="' . $element['id'] . '" ' . $estadoOption . '>' . $element['nombre_perfil'] . '</option>';
                            }
                            ?>
                        </select>

                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="id_sexo">Sexo:</label>
                        <select class="form-select" name="id_sexo" id="id_sexo" aria-label="Default select example">
                            <option <?php echo (isset($_GET['action']) && $_GET['action'] == "show") ? 'selected' : ''; ?>>Seleccione uno</option>
                            <?php
                            foreach ($lstSexos as $element) {
                                $estadoOption = (isset($_GET['action']) && $_GET['action'] == "edit" && isset($varObject['sexo']) &&  $varObject['sexo'] == $element['id']) ? 'selected' : '';
                                echo '<option value="' . $element['id'] . '" ' . $estadoOption . '>' . $element['nombre_cat_detalle'] . '</option>';
                            }
                            ?>
                        </select>

                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="id_pais">País:</label>
                        <select class="form-select" name="id_pais" id="id_pais" aria-label="Default select example">
                            <option <?php echo (isset($_GET['action']) && $_GET['action'] == "show") ? 'selected' : ''; ?>>Seleccione uno</option>
                            <?php
                            foreach ($lstPaises as $pais) {
                                $estadoOption = (isset($_GET['action']) && $_GET['action'] == "edit" && $varObject['id_pais'] == $pais['id']) ? 'selected' : '';
                                echo '<option value="' . $pais['id'] . '" ' . $estadoOption . '>' . $pais['nombre_cat_detalle'] . '</option>';
                            }
                            ?>
                        </select>

                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="id_provincia">Provincia:</label>
                        <select class="form-select" name="id_provincia" id="id_provincia" aria-label="Default select example">
                            <option <?php echo (isset($_GET['action']) && $_GET['action'] == "show") ? 'selected' : ''; ?>>Seleccione uno</option>
                            <?php
                            foreach ($lstProvincias as $element) {
                                $estadoOption = (isset($_GET['action']) && $_GET['action'] == "edit" && $varObject['id_provincia'] == $element['id']) ? 'selected' : '';
                                echo '<option value="' . $element['id'] . '" ' . $estadoOption . '>' . $element['nombre_cat_detalle'] . '</option>';
                            }
                            ?>
                        </select>

                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <label for="id_ciudad">Ciudad:</label>
                        <select class="form-select" name="id_ciudad" id="id_ciudad" aria-label="Default select example">
                            <option <?php echo (isset($_GET['action']) && $_GET['action'] == "show") ? 'selected' : ''; ?>>Seleccione uno</option>
                            <?php
                            foreach ($lstCiudades as $element) {
                                $estadoOption = (isset($_GET['action']) && $_GET['action'] == "edit" && $varObject['id_ciudad'] == $element['id']) ? 'selected' : '';
                                echo '<option value="' . $element['id'] . '" ' . $estadoOption . '>' . $element['nombre_cat_detalle'] . '</option>';
                            }
                            ?>
                        </select>

                    </div>


                    <div class="form-group col-md-6 mt-1">
                        <label for="direccion">Direccion:</label>
                        <textarea class="form-control" name="direccion" id="direccion" cols="30" rows="5"><?php echo (isset($varObject)) ?  $varObject['direccion']  : ''; ?></textarea>
                    </div>



                </div>
            </div>
        </div>
    </form>
</main>


<?php
include("../Templates/footer.php")
?>