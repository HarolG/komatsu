<?php
    include_once("connection.php");

    if(isset($_POST['modelo']) && isset($_POST['tipo_maquina']) && isset($_POST['potencia']) && isset($_POST['capacidad']) && isset($_POST['id_serie'])) {
        
        $modelo = $_POST['modelo'];
        $tipo = $_POST['tipo_maquina'];
        $potencia = $_POST['potencia'];
        $capacidad = $_POST['capacidad'];
        $id_serie = $_POST['id_serie'];

        if($tipo != "Nulo") {
            $sql = "INSERT INTO maquinas (id_maquina, modelo_maquina, id_tipo, potencia_neta, capacidad, ultimo_mantenimiento, proximo_mantenimiento) VALUES ('$id_serie', '$modelo', '$tipo', '$potencia', '$capacidad', NULL, NULL)";
            $result = mysqli_query($conn, $sql);

            $sql2 = "INSERT INTO mantenimiento (id_mantenimiento, id_tipo_mantenimiento, id_maquina, ultimo_mantenimiento, fecha_max_mantenimiento, obversacion) VALUES (NULL, NULL, '$id_serie', NULL, NULL, NULL)";
            $result2 = mysqli_query($conn, $sql2);
            
            if($result) {
                echo "Elemento insertado correctamente";
            } else {
                echo "No se ha podido insertar el elemento";
            }

        } else {
            echo "El tipo de maquina no es valido";
        }

    } else {
        echo "Ha ocurrido un error";
    }
?>