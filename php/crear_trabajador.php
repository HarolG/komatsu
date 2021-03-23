<?php
    include_once("connection.php");

    if(isset($_POST['tipo_documento']) && isset($_POST['documento']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['correo']) && isset($_POST['telefono']) && isset($_POST['direccion'])) {
        
        $tipo = $_POST['tipo_documento'];
        $doc = $_POST['documento'];
        $nom = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $maquina = $_POST['maquina_disponible'];
        $tipuser = 2;

        if($tipo != "Nulo") {
            $sql = "INSERT INTO trabajadores (documento, nombre, apellido, correo, telefono, direccion, maquina, id_tip_usu, id_tip_doc) VALUES ('$doc', '$nom', '$apellido', '$correo', '$direccion', '$maquina', '$tipuser', $tipo)";
            $result = mysqli_query($conn, $sql);

            $sql2 = "INSERT INTO turno (documento, id_maquina, hora_inicio, hora_fin, estado) VALUES ('$documento', '$maquina', NULL, NULL, 'No trabajando')";
            $result2 = mysqli_query($conn, $sql2);
            
            if($result) {
                echo "Trabajador insertado correctamente";
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