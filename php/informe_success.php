<?php

include_once("connection.php");

if(isset($_POST['id_turno']) && isset($_POST['recomendacion'])) {
    $id_turno = $_POST['id_turno'];
    $recomendacion = $_POST['recomendacion'];

    $sql = "SELECT * FROM tope WHERE id_turno = '$id_turno'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);

    if(!empty($result)) {
        $tope_trabajador = $result['tope_trabajador'];
        $tope_aceite = $result['tope_aceite'];
        $tope_ruedas = $result['tope_ruedas'];
    }

    if($recomendacion == "Dar descanso") {
        $tope_trabajador = $tope_trabajador + 60;

        $sql2 = "UPDATE tope SET tope_trabajador = '$tope_trabajador', tope_aplazar_trabajador = '5' WHERE id_turno = $id_turno";
        $query2 = mysqli_query($conn, $sql2);

        if($query2) {
            echo "Realizado correctamente";
        } else {
            echo "Ha ocurrido un error";
        }
    }

    if($recomendacion == "Cambiar Aceite") {
        $tope_aceite = $tope_aceite + 120;

        $sql2 = "UPDATE tope SET tope_aceite = '$tope_aceite', tope_aplazar_maquina = '5' WHERE id_turno = '$id_turno'";
        $query2 = mysqli_query($conn, $sql2);

        if($query2) {
            echo "Realizado correctamente";
        } else {
            echo "Ha ocurrido un error";
        }
    }

    if($recomendacion == "Cambiar Ruedas") {
        $tope_ruedas = $tope_ruedas + 500;

        $sql2 = "UPDATE tope SET tope_ruedas = '$tope_ruedas', tope_aplazar_maquina = '5' WHERE id_turno = '$id_turno'";
        $query2 = mysqli_query($conn, $sql2);

        if($query2) {
            echo "Realizado correctamente";
        } else {
            echo "Ha ocurrido un error";
        }
    }

    if($recomendacion == "Ninguna") {
        echo "No es posible hacer esto";
    }
}

?>