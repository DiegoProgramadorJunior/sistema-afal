<?php

require_once '../../config/database.php';

$resultado = false;
$database = Database::connect();
$sql = 'SELECT * FROM partido_jugadores INNER JOIN persona_jugador ON partido_jugadores.ID_PERSONA_JUGADOR_FK = persona_jugador.ID_PERSONA_JUGADOR INNER JOIN persona ON persona_jugador.RUT_PERSONA_FK = persona.RUT_PERSONA WHERE ID_PARTIDO_FK ='.$_POST['idpartido'].' AND ID_CLUB_FK ='.$_POST['idClubphp'];

$respuesta = $database->query($sql);

if($respuesta){
    $resultado = $respuesta->fetch_all(MYSQLI_ASSOC);
}

echo json_encode($resultado);