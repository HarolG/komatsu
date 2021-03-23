<?php
    include_once("../php/connection.php");

    $documento = $_SESSION['datos']['documento'];

    $sql = "UPDATE turnos SET hora_inicio = NOW(), estado = 'Trabajando' WHERE documento = $documento";
    $query = mysqli_query($conn, $sql);

    if($query) {
        header("location: ../private/trabajador.php");
    } else {
        header("location: ../private/trabajador.php");
    }

?>