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
    <link rel="stylesheet" href="../css/admin.css">
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
                    <a class="nav-link" href="mantenimiento.php">Mantenimiento</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="crear_trabajador.php">Crear Trabajador
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
    <!-- formulario -->
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-body">
                    <form id="form_tra" action="">
                        <div class="form-group">
                            <select class="form-control" id="tipo_documento">
                                <option value="Nulo" selected>Tipo de documento</option>
                                <?php
                                    $sql = "SELECT * FROM tip_doc";
                                    $query = mysqli_query($conn, $sql);
                                    

                                    while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $row['id_tip_doc'];?>"><?php echo $row['nom_tip_doc'];?></option>       
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="documento" placeholder="Documento Trabajador" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" id="nombre" placeholder="Nombre Trabajador" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" id="apellido" placeholder="Apellido Trabajador" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" id="correo" placeholder="Correo Trabajador" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" id="telefono" placeholder="Telefono Trabajador" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" id="direccion" placeholder="Direccion Trabajador" class="form-control">
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="maquina_disponible">
                                <option value="Nulo" selected>Maquinas Disponibles</option>
                                <?php
                                    $sql = "SELECT * FROM maquinas";
                                    $query = mysqli_query($conn, $sql);
                                    

                                    while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $row['id_maquina'];?>"><?php echo $row['modelo_maquina'];?></option>       
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <table class="table table-striped table-borderer bg-white table-sm">
                    <thead>
                        <tr>
                            <td>Documento</td>
                            <td>Nombre</td>
                            <td>Apellido</td>
                            <td>Correo</td>
                            <td>Telefono</td>
                            <td>Direcciom</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody id="trab">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="contenedor_editar" id="contenedor_editar">
        <div class="contenedor_form_editar">
            <div class="container">
                <div class="col-md-8">
                    <div class="card card-body">
                        <form method="POST" id="form_update">
                            <div class="form-group">
                                <p id="btn_close_update" class="btn btn-danger">Cerrar</p>
                            </div>
                            <div class="form-group">
                                <input type="text" id="correo_update" placeholder="Correo" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" id="telefono_update" placeholder="Telefono" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" id="direccion_update" placeholder="Direccion" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Editar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../js/trabajador.js"></script>
</body>

</html>

<?php
    } else {
        header("Location: ../index.html");
    }
?>