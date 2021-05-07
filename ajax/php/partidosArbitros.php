<?php

require_once '../../config/database.php';

$resultado = false;

if(isset($_POST['segundoarbitro'])){
    $rutarbitroprincipal = $_POST['arbitroprincipal'];
    $rutsegundoarbitro = $_POST['segundoarbitro'];
    $database = Database::connect();
    $sql = "SELECT * FROM persona INNER JOIN direccion ON persona.ID_DIRECCION_FK = direccion.ID_DIRECCION INNER JOIN comuna ON direccion.ID_COMUNA_FK = comuna.ID_COMUNA INNER JOIN asociacion ON persona.ID_ASOCIACION_FK = asociacion.ID_ASOCIACION WHERE NOT RUT_PERSONA = $rutarbitroprincipal AND NOT RUT_PERSONA = $rutsegundoarbitro AND ID_PERFIL_FK = 6";
    
    $respuesta = $database->query($sql);
    
    if($respuesta){
        $resultado = $respuesta->fetch_all(MYSQLI_ASSOC);
    }
}else{
    $rut = $_POST['arbitroprincipal'];
    $database = Database::connect();
    $sql = "SELECT * FROM persona INNER JOIN direccion ON persona.ID_DIRECCION_FK = direccion.ID_DIRECCION INNER JOIN comuna ON direccion.ID_COMUNA_FK = comuna.ID_COMUNA INNER JOIN asociacion ON persona.ID_ASOCIACION_FK = asociacion.ID_ASOCIACION WHERE NOT RUT_PERSONA = $rut AND ID_PERFIL_FK = 6";
    
    $respuesta = $database->query($sql);
    
    if($respuesta){
        $resultado = $respuesta->fetch_all(MYSQLI_ASSOC);
    }
}



echo json_encode($resultado);