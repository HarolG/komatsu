<?php

include_once("connection.php");

$sql = "SELECT turnos.id_turno, turnos.documento, trabajadores.nombre, trabajadores.apellido, turnos.hora_total, maquinas.id_maquina, maquinas.modelo_maquina FROM turnos, trabajadores, maquinas WHERE turnos.documento = trabajadores.documento AND turnos.id_maquina = maquinas.id_maquina";
$query = mysqli_query($conn, $sql);

if(!$query) {
    die("Consulta fallida" . mysqli_error($conn));
}

while($row = mysqli_fetch_array($query)) {

    $id_turno = $row['id_turno'];

    $sql2 = "SELECT * FROM tope WHERE id_turno = '$id_turno'";
    $query2 = mysqli_query($conn, $sql2);
    $result2 = mysqli_fetch_assoc($query2);

    $reco_trabajador = '';
    $reco_maquina = '';

    if(!empty($row['hora_total'])) {
        
        if($row['hora_total'] > $result2['tope_trabajador']) {
            $reco_trabajador = "Dar descanso";
        } else {
            $reco_trabajador = "Ninguna";
        }

        if($row['hora_total'] > $result2['tope_aceite'] && $row['hora_total'] < $result2['tope_ruedas']) {
            $reco_maquina = 'Cambiar Aceite';
        } else if($row['hora_total'] > $result2['tope_ruedas'] && $row['hora_total'] > $result2['tope_aceite']){
            $reco_maquina = 'Cambiar Ruedas';
        } else {
            $reco_maquina = 'Ninguna';
        }

    } else {
        $reco_trabajador = "Ninguna";
        $reco_maquina = 'Ninguna';
    }

    $json[] = array(
        'id_turno' => $row['id_turno'],
        'documento' => $row['documento'],
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido'],
        'hora_total' => $row['hora_total'],
        'id_maquina' => $row['id_maquina'],
        'modelo_maquina' => $row['modelo_maquina'],
        'reco_trabajador' => $reco_trabajador,
        'reco_maquina' => $reco_maquina
    );
}

$jsonstring = json_encode($json);
echo $jsonstring;

?>