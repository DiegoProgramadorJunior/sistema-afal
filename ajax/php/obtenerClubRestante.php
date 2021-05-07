<?php

require_once '../../config/database.php';

$resultado = false;
$database = Database::connect();
//$sql = "SELECT * FROM club WHERE not ID_CLUB =".$_POST['id'];
$sql = "SELECT ID_CLUB, NOMBRE_CLUB FROM campeonato_equipos cp INNER JOIN club  c ON (cp.id_club_fk = c.id_club) WHERE not ID_CLUB =".(int)$_POST['id'] ." AND id_campeonato_fk=".(int)$_POST['idcampeonato'];
$respuesta = $database->query($sql);

if($respuesta){
    $resultado = $respuesta->fetch_all(MYSQLI_ASSOC);
}

echo json_encode($resultado);