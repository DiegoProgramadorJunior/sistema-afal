<?php

require_once '../../config/database.php';

$resultado = false; 
$database = Database::connect();
$sql = 'INSERT INTO PARTIDOS_GOLES (ID_PARTIDO_FK,RUT_GOLEADOR_FK,ID_TIPO_GOL_FK,MINUTO_GOL,TIEMPO) VALUES ('.$_POST['idpartidofk'].','.$_POST['rutGoleador'].','.$_POST['idtipogol'].',"'.$_POST['min'].'","'.$_POST['tiempo'].'"  )';
$respuesta = $database->query($sql);
echo $respuesta;