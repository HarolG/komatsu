<?php

    include_once("../php/connection.php");

    $documento = $_SESSION['datos']['documento'];

    $sql = "UPDATE turnos SET hora_fin = NOW(), estado = 'No trabajando' WHERE documento = $documento";
    $query = mysqli_query($conn, $sql);

    if($query) {
        $sql2 = "SELECT * FROM turnos WHERE documento = $documento";
        $query2 = mysqli_query($conn, $sql2);
        $result = mysqli_fetch_assoc($query2);

        $hora_inicio = $result['hora_inicio'];
        $hora_fin = $result['hora_fin'];
        $hora_total = $result['hora_total'];

        $date1 = new DateTime($hora_inicio);
        $date2 = new DateTime($hora_fin);
        $diff = $date1->diff($date2);

        $date = $diff->format('%h');
        

        $acumulado = $hora_total + $date;

        $sql3 = "UPDATE turnos SET hora_total = '$acumulado' WHERE documento = $documento";
        $query3 = mysqli_query($conn, $sql3);

        header("location: ../private/trabajador.php");

    } else {
        header("location: ../private/trabajador.php");
    }
?>