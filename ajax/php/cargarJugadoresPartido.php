<?php

require_once '../../config/database.php';

$resultado = false; 
$database = Database::connect();

$jugadores = json_decode($_POST['jugadores'],true);
$partido = $_POST['partido'];
$contador = 0;
$respuesta = false;

foreach ($jugadores as $jugador){
    $rut = $jugador["rut"];
    $sql = 'INSERT INTO partido_jugadores (ID_PERSONA_JUGADOR_FK,ID_PARTIDO_FK,NUMERO_JUGADOR) VALUES ('.$rut.','.$partido.','.$jugador['dorsal'].')';
    $respuesta = $database->query($sql);
    if($respuesta){
        $contador++;
    }
}

$resultado = 0;

if(count($jugadores)==$contador){
    $resultado = 1;
}

echo $resultado;