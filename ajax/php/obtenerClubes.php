<?php

require_once '../../config/database.php';

$resultado = false;
$database = Database::connect();
$sql = "SELECT ID_CLUB, NOMBRE_CLUB FROM campeonato_equipos cp INNER JOIN club  c ON (cp.id_club_fk = c.id_club) WHERE id_campeonato_fk=".$_POST['campeonato'] ;

$respuesta = $database->query($sql);

if($respuesta){
    $resultado = $respuesta->fetch_all(MYSQLI_ASSOC);
}

echo json_encode($resultado);