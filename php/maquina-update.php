<?php
    include_once("connection.php");

    if(isset($_POST['id']) && isset($_POST['modelo']) && isset($_POST['tipo_maquina_update']) && isset($_POST['potencia']) && isset($_POST['capacidad']) ) {
        
        $id = $_POST['id'];
        $modelo = $_POST['modelo'];
        $tipo = $_POST['tipo_maquina_update'];
        $potencia = $_POST['potencia'];
        $capacidad = $_POST['capacidad'];

        if($tipo != "Nulo") {
            $sql = "UPDATE maquinas SET modelo_maquina = '$modelo', id_tipo = '$tipo', potencia_neta = '$potencia', capacidad = '$capacidad' WHERE id_maquina = '$id'";
            $result = mysqli_query($conn, $sql);

            if($result) {
                echo "Elemento editado correctamente";
            } else {
                echo "No se ha podido editar el elemento";
            }
        } else {
            echo "El tipo de maquina no es valido";
        }

    } else {
        echo "Ha ocurrido un error";
    }
?>