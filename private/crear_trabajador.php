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
                <li class="nav-item">
                    <a class="nav-link" href="informe.php">Informe
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
                    <form action="../php/crear_trabajador.php" method="POST">
                        <div class="form-group">
                            <select class="form-control" name="tipo_documento">
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
                            <input type="text" name="documento" placeholder="Documento Trabajador" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="nombre" placeholder="Nombre Trabajador" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="apellido" placeholder="Apellido Trabajador" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="telefono" placeholder="Telefono Trabajador" class="form-control">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="maquina_disponible">
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
                            <input type="submit" name="guardar" class="btn btn-primary btn-block" value="enviar">
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
                            <td>Telefono</td>
                            <td>ID de la maquina</td>
                            <td>Tipo de documento</td>
                            <td>Tipo de usuario</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            $query = "SELECT * FROM trabajadores";
                            $result_tasks = mysqli_query($conn, $query);    
                  
                            while($row = mysqli_fetch_assoc($result_tasks)) { ?>
                            <tr>
                              <td><?php echo $row['documento'] ?></td>
                              <td><?php echo $row['nombre'] ?></td>
                              <td><?php echo $row['apellido'] ?></td>
                              <td><?php echo $row['telefono']; ?></td>
                              <td><?php echo $row['id_maquina']; ?></td>
                              <td><?php echo $row['id_tip_doc']; ?></td>
                              <td><?php echo $row['id_tip_usu']; ?></td>
                            </tr>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- <script src="../js/trabajador.js"></script> -->
</body>

</html>

<?php
    } else {
        header("Location: ../index.html");
    }
?>