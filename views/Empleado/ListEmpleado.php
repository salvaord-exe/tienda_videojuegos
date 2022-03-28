<?php

require_once("../../Controllers/EmpleadoController.php");

$object = new EmpleadoController();


try {
    if (isset($_GET['action']) && $_GET['action'] == "list") {
        $lstObjects = ($object->index());
    }
} catch (Exception $e) {
    echo "Problema al cargar la pagina";
}

if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $object->delete($_GET['id']);
    header("Location: ListEmpleado.php?action=list");
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
                <h3>Lista de Empleados</h3>
                <a href="./ShowEmpleado.php?action=show" class="btn btn-success">Crear Empleado +</a>
            </div>
            <div class="card-body">
                
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-dark">
                            <th>Id</th>
                            <th>Nombre Completo</th>
                            <th>Correo</th>
                            <th>Perfil</th>
                            
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($lstObjects as $varObject) {
                            echo "<tr>";
                            echo "<td>" . $varObject['id'] . "</td>";
                            echo "<td>" . $varObject['primer_nombre'] .' '. $varObject['segundo_nombre'] . ' ' . $varObject['primer_apellido'] .' '. $varObject['segundo_apellido'] . "</td>";
                            echo "<td>" . $varObject['correo_usuario'] . "</td>";
                            echo "<td>" . $varObject['nombre_perfil'] . "</td>";
                            echo '<td class="d-flex justify-content-around">';
                            echo '<a class="btn btn-warning" href="ShowEmpleado.php?id=' . $varObject['id'] . '&action=edit">Editar</a>';
                            echo '<a class="btn btn-danger" href="ListEmpleado.php?id=' . $varObject['id'] . '&action=delete">Eliminar</a>';
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