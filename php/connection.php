<?php
    $conn= mysqli_connect("localhost","root","","komatsu");
    if($conn->connect_error)
    {
        die("fallo la conexion" . mysqli_connect_errno());
    }
    session_start();
?>