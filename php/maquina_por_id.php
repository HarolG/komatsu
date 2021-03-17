<?php
    include_once("connection.php");

    if(isset($_GET['id'])) {

        $id = $_GET['id'];
        $sql = "SELECT maquinas.id_maquina, maquinas.modelo_maquina, tipo.nom_tipo, maquinas.potencia_neta, maquinas.capacidad FROM maquinas, tipo WHERE maquinas.id_tipo = tipo.id_tipo AND maquinas.id_maquina = '$id'";
        $result = mysqli_query($conn, $sql);

        if(!$result) {
            die("Consulta fallida" . mysqli_error($conn));
        }

        while ($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'id' => $row['id_maquina'],
                'modelo_maquina' => $row['modelo_maquina'],
                'nom_tipo' => $row['nom_tipo'],
                'potencia_neta' => $row['potencia_neta'],
                'capacidad' => $row['capacidad'],
            );
        }

        $jsonstring = json_encode($json);
        echo $jsonstring;

    } else {
        echo "Ha ocurrido un error";
    }
?>