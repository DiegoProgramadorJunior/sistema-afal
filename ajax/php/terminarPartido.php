<?php

require_once '../../config/database.php';

$resultado = false;
$database = Database::connect();
$sqlClubes = "SELECT * FROM partidos WHERE ID_PARTIDO=".$_POST['partido'];
$respuesta = $database->query($sqlClubes);
$resultadoClubes = $respuesta->fetch_object();
$local = (int)$resultadoClubes->ID_CLUB_LOCAL_FK;
$visita = (int)$resultadoClubes->ID_CLUB_VISITA_FK;

$sqlGolesLocal = 'SELECT * FROM partidos_goles INNER JOIN persona_jugador ON partidos_goles.RUT_GOLEADOR_FK = persona_jugador.RUT_PERSONA_FK WHERE ID_PARTIDO_FK ='.$_POST['partido'].' AND persona_jugador.ID_CLUB_FK ='.$local;
$respuestaGolesLocal = $database->query($sqlGolesLocal);
$golesLocal = $respuestaGolesLocal->fetch_all();

$sqlGolesVisita = 'SELECT * FROM partidos_goles INNER JOIN persona_jugador ON partidos_goles.RUT_GOLEADOR_FK = persona_jugador.RUT_PERSONA_FK WHERE ID_PARTIDO_FK ='.$_POST['partido'].' AND persona_jugador.ID_CLUB_FK ='.$visita;
$respuestaGolesVisita = $database->query($sqlGolesVisita);
$golesVisita = $respuestaGolesVisita->fetch_all();

$resultadoGoles = array(
    "idLocal" => $local,
    "golesLocal" => $golesLocal,
    "idVisita" => $visita,
    "golesVisita" => $golesVisita
);

echo json_encode($resultadoGoles);