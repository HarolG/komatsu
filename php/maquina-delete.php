<?php
    include_once("connection.php");

    if(isset($_POST['id'])) {
        $id = $_POST['id'];

        $sql = "DELETE FROM maquinas WHERE id_maquina = '$id'";
        $result = mysqli_query($conn, $sql);

        if($result) {
            echo "Elemento eliminado correctamente";
        } else {
            echo "No se ha podido eliminar el elemento";
        }

    } else {
        echo "Ha ocurrido un error";
    }
?>