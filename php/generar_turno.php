<?php
    include_once("../php/connection.php");

    $documento = $_SESSION['datos']['documento'];

    $sql = "UPDATE turnos SET hora_inicio = NOW(), estado = 'Trabajando' WHERE documento = $documento";
    $query = mysqli_query($conn, $sql);

    $sql4 = "INSERT INTO `registro_turnos` (`id`, `documento`, `hora_inicio`, `hora_fin`) VALUES (NULL, '$documento', NOW(), NULL);";
    $query4 = mysqli_query($conn, $sql4);

    if($query) {
        header("location: ../private/trabajador.php");
    } else {
        header("location: ../private/trabajador.php");
    }

?>