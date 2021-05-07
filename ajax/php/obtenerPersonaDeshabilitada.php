<?php

require_once '../../config/database.php';

$resultado = false;
$database = Database::connect();
$sql = "SELECT RUT_PERSONA, NOMBRE_1, NOMBRE_2, APELLIDO_1, APELLIDO_2, P.NUMERO_TELEFONO_PERSONA, CORREO_ELECTRONICO, NOMBRE_ASOCIACION, NOMBRE_PERFIL FROM persona P
INNER JOIN ASOCIACION A ON (P.ID_ASOCIACION_FK = A.ID_ASOCIACION)
INNER JOIN PERFIL PF ON (P.ID_PERFIL_FK = PF.ID_PERFIL) WHERE ID_TIPO_ESTADO_FK_PERSONA = 2";

$respuesta = $database->query($sql);

if(!$respuesta){
    die("ERROR");
}else{
    $resultado = $respuesta->fetch_all(MYSQLI_ASSOC);  

    echo json_encode($resultado);
}

