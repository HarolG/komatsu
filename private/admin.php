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
                <li class="nav-item active">
                    <a class="nav-link" href="admin.php">Inicio
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mantenimiento.php">Mantenimiento</a>
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
            <div class="col-md-3">
                <div class="card card-body">
                    <form id="form_insert" action="">
                        <div class="form-group">
                            <input type="text" id="id_serie" placeholder="No. Serie" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" id="modelo" placeholder="Modelo" class="form-control">
                        </div>
                        <select class="form-control" id="tipo_maquina">
                            <option value="Nulo" selected>Tipo de maquina</option>
                            <?php
                                    $sql = "SELECT * FROM tipo";
                                    $query = mysqli_query($conn, $sql);
                                    

                                    while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $row['id_tipo'];?>"><?php echo $row['nom_tipo'];?></option>       
                                <?php
                                    }
                                ?>
                        </select>
                        <div class="form-group">
                            <input type="text" id="potencia" placeholder="Potencia neta al volante" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" id="capacidad" placeholder="Capacidad" class="form-control">
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
                            <td>ID</td>
                            <td>Modelo</td>
                            <td>Tipo</td>
                            <td>Potencia neta al volante</td>
                            <td>Capacidad</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody id="maquinas">
                        
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
                                <input type="text" id="modelo_update" placeholder="Modelo" class="form-control">
                            </div>
                            <select class="form-control" id="tipo_maquina_update">
                                <option value="Nulo" selected>Tipo de maquina</option>
                                <?php
                                    $sql = "SELECT * FROM tipo";
                                    $query = mysqli_query($conn, $sql);
                                    

                                    while ($row = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $row['id_tipo'];?>"><?php echo $row['nom_tipo'];?></option>       
                                <?php
                                    }
                                ?>
                            </select>
                            <div class="form-group">
                                <input type="text" id="potencia_update" placeholder="Potencia neta al volante" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" id="capacidad_update" placeholder="Capacidad" class="form-control">
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
    <script src="../js/admin.js"></script>
</body>

</html>

<?php
    } else {
        header("Location: ../index.html");
    }
?>