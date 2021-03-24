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
        $tope_aplazar_trabajador = $result['tope_aplazar_trabajador'];
        $tope_aplazar_maquina = $result['tope_aplazar_maquina'];
    }

    if($recomendacion == "Dar descanso") {
        $tope_trabajador = $tope_trabajador + 20;
        $tope_aplazar_trabajador = $tope_aplazar_trabajador - 1;

        if($tope_aplazar_trabajador < 0) {
            echo "No es posible aplazar más";
        } else {
            $sql2 = "UPDATE tope SET tope_trabajador = '$tope_trabajador', tope_aplazar_trabajador = '$tope_aplazar_trabajador' WHERE id_turno = $id_turno";
            $query2 = mysqli_query($conn, $sql2);

            if($query2) {
                echo "Aplazado correctamente";
            } else {
                echo "Ha ocurrido un error";
            }
        }
        
    }

    if($recomendacion == "Cambiar Aceite") {
        $tope_aceite = $tope_aceite + 40;
        $tope_aplazar_maquina = $tope_aplazar_maquina - 1;

        if($tope_aplazar_maquina < 0) {
            echo "No es posible aplazar más";
        } else {
            $sql2 = "UPDATE tope SET tope_aceite = '$tope_aceite', tope_aplazar_maquina = '$tope_aplazar_maquina' WHERE id_turno = '$id_turno'";
            $query2 = mysqli_query($conn, $sql2);

            if($query2) {
                echo "Aplazado correctamente";
            } else {
                echo "Ha ocurrido un error";
            }
        }

        
    }

    if($recomendacion == "Cambiar Ruedas") {
        $tope_ruedas = $tope_ruedas + 60;
        $tope_aplazar_maquina = $tope_aplazar_maquina - 1;

        if($tope_aplazar_maquina < 0) {
            echo "No es posible aplazar más";
        } else {
            $sql2 = "UPDATE tope SET tope_ruedas = '$tope_ruedas', tope_aplazar_maquina = '$tope_aplazar_maquina' WHERE id_turno = '$id_turno'";
            $query2 = mysqli_query($conn, $sql2);

            if($query2) {
                echo "Aplazado correctamente";
            } else {
                echo "Ha ocurrido un error";
            }
        }
    }

    if($recomendacion == "Ninguna") {
        echo "No es posible hacer esto";
    }
}

?>