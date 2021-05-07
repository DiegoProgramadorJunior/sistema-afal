<?php

require_once '../../config/database.php';

$resultado = false; 
$database = Database::connect();
$sql = 'INSERT INTO partido_amonestaciones
(ID_PARTIDO_FK,RUT_AMONESTADO_FK,ID_TIPO_TARJETA_FK,ID_TIPO_FALTA_FK,MINUTO_AMONESTACION,TIEMPO)
VALUES('.$_POST['idpartidofk'].','.$_POST['rutamonestado'].','.$_POST['idtipotarjeta'].','.$_POST['idtipofalta'].',"'.$_POST['min'].'","'.$_POST['tiempo'].'")';
$respuesta = $database->query($sql);
echo $respuesta;