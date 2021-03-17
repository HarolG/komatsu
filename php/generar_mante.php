<?php
    include_once("../php/connection.php");

    if(isset($_POST['select_modelo']) && isset($_POST['select_tipo']) && isset($_POST['observacion']) && isset($_POST['id_mante'])) {
        $select_modelo = $_POST['select_modelo'];
        $select_tipo = $_POST['select_tipo'];
        $observacion = $_POST['observacion'];
        $id_mante = $_POST['id_mante'];

        if($select_tipo == "Nulo" or $select_modelo == "Nulo"){
            echo "Los tipos seleccionados no son correctos";
        } else if($observacion == ""){
            echo "La observación no puede quedar vacía";
        } else {
            $sql = "UPDATE mantenimiento SET id_maquina = '$select_modelo', id_tipo_mantenimiento = '$select_tipo', ultimo_mantenimiento = NOW(), fecha_max_mantenimiento = DATE_ADD(NOW(),INTERVAL 30 DAY), obversacion = '$observacion' WHERE id_mantenimiento = '$id_mante'";
            $query = mysqli_query($conn, $sql);

            if($query) {
                echo "Se ha generado correctamente el mantenimiento";
            } else {
                echo "No se ha generado correctamente el mantenimiento";
            }
        }

    } else {
        echo "Ha ocurrido un error";
    }
?>