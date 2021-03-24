<?php
    include_once("../php/connection.php");

    if(isset($_SESSION['datos'])) {
        $documento = $_SESSION['datos']['documento'];
        $clave = $_SESSION['datos']['clave'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Komatsu</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/materia/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Komatsu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Mantenimiento
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="crear_trabajador.php">Crear Trabajador
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="informe.php">Informe
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <p class="text-white align-self-center mr-sm-4">Administrador</p>
                <a class="btn btn-secondary my-2 my-sm-0" href="../php/cerrar_sesion.php">Cerrar Sesion</a>
            </ul>
        </div>
    </nav>

    <div class="container pt-4">
        <div class="row">
            <div class="col-md-6.5">
                <table class="table table-striped table-borderer bg-white table-sm">
                    <thead>
                        <tr>
                            <td>Documento</td>
                            <td>Nombre</td>
                            <td>Horas Laboradas</td>
                            <td>Recomendación</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody id="tabla_trabajador"></tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-striped table-borderer bg-white table-sm">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Modelo</td>
                            <td>Horas Laboradas</td>
                            <td>Recomendación</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody id="tabla_maquina"></tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../js/informe.js"></script>
</body>
</html>
<?php
    } else {
        header("Location: ../index.html");
    }
?>