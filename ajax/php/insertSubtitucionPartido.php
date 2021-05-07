<?php

require_once '../../config/database.php';

$resultado = false; 
$database = Database::connect();
$sql = 'INSERT INTO partidos_sustituciones (ID_PARTIDO_FK,RUT_JUGADOR_ENTRA,RUT_JUGADOR_SALE,MINUTO_SUSTITUCION,TIEMPO)
VALUES('.$_POST['idpartidofk'].','.$_POST['rutjugadorEntra'].','.$_POST['rutjugadorSale'].',"'.$_POST['min'].'","'.$_POST['tiempo'].'")';
$respuesta = $database->query($sql);
echo $respuesta;