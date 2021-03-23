<?php
    include_once("connection.php");

    if(isset($_POST['guardar'])) {
        
        $tipo = $_POST['tipo_documento'];
        $doc = $_POST['documento'];
        $nom = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $tel = $_POST['telefono'];
        $maquina = $_POST['maquina_disponible'];
        $tipuser = 2;
        // $est = "No trabajando";
        // $turn = 1;

        if($tipo != "Nulo") {
            $sql = "INSERT INTO trabajadores (documento, nombre, apellido, telefono, id_tip_usu, id_tip_doc, id_maquina) VALUES ('$doc', '$nom', '$apellido', '$tel', '$tipuser', '$tipo', '$maquina')";
            $result = mysqli_query($conn, $sql);
            

            $sql2 = "INSERT INTO `turnos` (`id_turno`, `documento`, `id_maquina`, `hora_inicio`, `hora_fin`, `estado`) VALUES (NULL, '$doc', '$maquina', NULL, NULL, NULL, 'No trabajando')";
            $result2 = mysqli_query($conn, $sql2);
            
            if($result) {
                header("Location: ../private/crear_trabajador.php");
            } else {
                echo "No se ha podido insertar el trabajador";
            }

        } else {
            echo "El tipo de documento no es valido";
        }

    } else {
        echo "Ha ocurrido un error";
    }
?>