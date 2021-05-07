<?php

require_once '../../config/database.php';

$resultado = false; 
$database = Database::connect();
$sql = 'INSERT INTO partido_observaciones(ID_PARTIDO_FK,OBSERVACION,RUT_TURNO_FK)
VALUES('.$_POST['idpartidofk'].',"'.$_POST['observacion'].'",'.$_POST['rutturno'].')';
$respuesta = $database->query($sql);
echo $respuesta;