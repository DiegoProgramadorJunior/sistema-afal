<?php

require_once '../../config/database.php';

$resultado = false;
$database = Database::connect();
$sql = "SELECT * FROM club WHERE ID_TIPO_ESTADO_FK = 2;";

$respuesta = $database->query($sql);

if(!$respuesta){
    die("ERROR");
}else{
    $resultado = $respuesta->fetch_all(MYSQLI_ASSOC);  

    echo json_encode($resultado);
}

