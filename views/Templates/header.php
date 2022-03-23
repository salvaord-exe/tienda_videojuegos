<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/tienda_videojuegos/Core/url.php'); ?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Assets/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Game Store</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo $urlServer . '/index.php?action=list' ?>">Home</a>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Administración
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?php echo $urlServer . '/views/Catalogo/ListCatalogoCab.php?action=list' ?>">Gestión de Catálogos</a></li>
                                <li><a class="dropdown-item" href="<?php echo $urlServer . '/views/Empleado/ListEmpleado.php?action=list' ?>">Gestión de Empleados</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Ventas
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?php echo $urlServer . '/views/Fabricante/ListFabricante.php?action=list' ?>">Gestión de Fabricantes de Videojuegos</a></li>
                                <li><a class="dropdown-item" href="<?php echo $urlServer . '/views/Producto/ListProducto.php?action=list' ?>">Gestión de Videojuegos</a></li>
                            </ul>
                        </li>
                        <a class="nav-link" href="<?php echo $urlServer . '/views/Biblioteca/ListCompras.php?action=list' ?>">Mis Videojuegos</a>
                    </ul>
                    <span class="nav-item navbar-nav">
                        <a class="nav-link" href="<?php echo $urlServer . '/views/Home/CarritoCompra.php' ?>"><span class="fs-2 bi-cart-check-fill"></span></a>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="fs-2 bi-person-circle"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Iniciar Sesión</a></li>
                                <li><a class="dropdown-item" href="#">Perfil</a></li>
                                <li><a class="dropdown-item" href="#">Opciones</a></li>
                                <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                            </ul>
                        </li>

                        
                    </span>
                </div>
            </div>
        </nav>
    </header>


</html>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>