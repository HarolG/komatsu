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
        } else  if($prueba['id_tip_usu'] == 2){
            $_SESSION['datos'] = $prueba;
            echo "Trabajador";
        }
    } else {
        $_SESSION['datos_usuario'] = $prueba;
        echo "Usuario o contraseña incorrecta";
    }

} else {
    echo "Rellene los campos requeridos";
}
?>