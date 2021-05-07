<?php

require_once '../../config/database.php';

$resultado = false; 
$database = Database::connect();
$idPartido = $_POST['partido'];
$estado = $_POST['estado'];

$sql = 'UPDATE partidos SET ID_ESTADO_PARTIDO_FK ='.$estado.' WHERE ID_PARTIDO = '.$idPartido;

$respuesta = $database->query($sql);

echo $respuesta;