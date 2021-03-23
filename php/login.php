<?php
include_once("connection.php");

if(!empty($_POST['documento']) && !empty($_POST['clave'])) {
    $documento = $_POST['documento'];
    $clave = $_POST['clave'];

    $sql = "SELECT * FROM usuario WHERE documento = '$documento' AND clave = '$clave'";
    $return = mysqli_query($conn, $sql);
    $prueba = mysqli_fetch_assoc($return);

    if(!empty($prueba)){
        if($prueba['id_tip_usu'] == 1) {
            $_SESSION['datos'] = $prueba;
            echo "Admin";
        } 
    } else {
        $sql2 = "SELECT * FROM trabajadores WHERE documento = '$documento' AND clave = '$clave'";
        $query = mysqli_query($conn, $sql2);
        $prueba = mysqli_fetch_assoc($query);

        if(!empty($prueba)){
            $_SESSION['datos'] = $prueba;
            echo "Trabajador";
        } else {
            echo "Los datos ingresados son incorrectos";
        }
    }

} else {
    echo "Rellene los campos requeridos";
}
?>