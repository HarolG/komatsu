<?php

    include_once("../php/connection.php");

    $documento = $_SESSION['datos']['documento'];

    $sql = "UPDATE turnos SET hora_fin = NOW(), estado = 'No trabajando' WHERE documento = $documento";
    $query = mysqli_query($conn, $sql);

    $sql1 = "SELECT * FROM turnos WHERE documento = $documento";
    $query1 = mysqli_query($conn, $sql1);
    $res = mysqli_fetch_assoc($query1);

    if ($res) {
        $inicio = $res['hora_inicio'];
        $fin = $res['hora_fin'];

        $sql22 = "INSERT INTO `registro_turnos` (`id`, `documento`, `hora_inicio`, `hora_fin`) VALUES (NULL, '$documento', '$inicio', '$fin')";
        $query22 = mysqli_query($conn, $sql22);
    }

    if($query) {
        $sql2 = "SELECT * FROM turnos WHERE documento = $documento";
        $query2 = mysqli_query($conn, $sql2);
        $result = mysqli_fetch_assoc($query2);

        $id_turno = $result['id_turno'];
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

        $sql4 = "SELECT * FROM tope WHERE id_turno = '$id_turno'";
        $query4 = mysqli_query($conn, $sql4);
        $result4 = mysqli_fetch_assoc($query4);

        if(empty($result4)){
            $sql5 = "INSERT INTO tope (id_tope, id_turno, tope_trabajador, tope_aceite, tope_ruedas, tope_aplazar_trabajador, tope_aplazar_maquina) VALUES (NULL, '$id_turno', '60', '240', '500', '5', '5')";
            $query5 = mysqli_query($conn, $sql5);
            header("location: ../private/trabajador.php");
        } else {
            header("location: ../private/trabajador.php");
        }

    } else {
        header("location: ../private/trabajador.php");
    }
?>