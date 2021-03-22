<?php
include_once("connection.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM mantenimiento WHERE id_mantenimiento = '$id'";
    $query = mysqli_query($conn, $sql);
    $resul = mysqli_fetch_assoc($query);

    echo $resul['id_maquina'];
}

?>