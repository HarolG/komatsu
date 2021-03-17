<?php

require_once("connection.php");

if(isset($_POST['todayDate'])) {

    $sql = "SELECT  mantenimiento.id_mantenimiento, maquinas.id_maquina, maquinas.modelo_maquina, tipo_mantenimiento.nom_mantenimiento, mantenimiento.ultimo_mantenimiento, mantenimiento.fecha_max_mantenimiento, mantenimiento.obversacion FROM mantenimiento, maquinas, tipo_mantenimiento WHERE mantenimiento.id_maquina = maquinas.id_maquina AND tipo_mantenimiento.id_tipo_mantenimiento = tipo_mantenimiento.id_tipo_mantenimiento";
    $result = mysqli_query($conn, $sql);

    if(!$result) {
        die("Consulta fallida" . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_array($result)) {

        $fecha_hoy = $_POST['todayDate'];
        $fecha_maxima = $row['fecha_max_mantenimiento'];
        $date1 = new DateTime($fecha_hoy);
        $date2 = new DateTime($fecha_maxima);
        $diff = $date1->diff($date2);

        $date = $diff->format('%d dia');

        if($date >= 21 && $date <=30) {
            $color = "secondary";
        } else if($date >= 11 && $date <= 20){
            $color = "success";
        } else if($date <= 10) {
            $color = "danger";
        }

        $json[] = array(
            'id_mantenimiento' => $row['id_mantenimiento'],
            'id_maquina' => $row['id_maquina'],
            'modelo_maquina' => $row['modelo_maquina'],
            'nom_mantenimiento' => $row['nom_mantenimiento'],
            'ultimo_mantenimiento' => $row['ultimo_mantenimiento'],
            'fecha_max_mantenimiento' => $row['fecha_max_mantenimiento'],
            'observacion' => $row['obversacion'],
            'alerta' => $diff,
            'color' => $color
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
}

?>