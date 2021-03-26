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
    <link rel="stylesheet" href="../css/trabajador.css">
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
                    <a class="nav-link" href="trabajador.php">Inicio</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="informetrab.php">Informe
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <p class="text-white align-self-center mr-sm-4">Trabajador</p>
                <a class="btn btn-secondary my-2 my-sm-0" href="../php/cerrar_sesion.php">Cerrar Sesion</a>
            </ul>
        </div>
    </nav>
    <div class="col-md-12 p-4">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="bg-primary">DOCUMENTO</th>
            <th class="bg-primary">FECHA INICIO TURNO</th>
            <th class="bg-primary">FECHA FIN TURNO</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * 
                    FROM registro_turnos 
                    WHERE documento = $documento";
          $result_tasks = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['documento'] ?></td>
            <td><?php echo $row['hora_inicio']; ?></td>
            <td><?php echo $row['hora_fin']; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
        integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
        integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
    </script>
</body>

</html>

<?php
    } else {
        header("Location: ../index.html");
    }
?>