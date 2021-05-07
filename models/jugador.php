<?php
require_once 'config/database.php';

class Jugador{

private $id_jugador;
private $rut_persona;
private $id_club;

public function getidJugador(){
    return $this->id_jugador;
}

public function setidJugador($id_jugador){
    $this->id_jugador = $id_jugador;
}

public function getrutPersona(){
    return $this->rut_persona;
}

public function setrutPersona($rut_persona){
    $this->rut_persona = $rut_persona;
}

public function getidClub(){
    return $this->id_club;
}

public function setidClub($id_club){
    $this->id_club = $id_club;
}

public function agregarJugadorClub(){
 $database = Database::connect();
 $sql = "INSERT INTO PERSONA_JUGADOR (RUT_PERSONA_FK,ID_CLUB_FK) VALUES (".$this->getrutPersona().",".$this->getidClub().")";
 $respuesta = $database->query($sql);
 return $respuesta;
        
}

public function obtenerJugadorNoAderido(){
    $database = Database::connect();
    $sql = "SELECT * FROM persona WHERE NOT EXISTS(SELECT NULL FROM PERSONA_JUGADOR  WHERE PERSONA_JUGADOR.RUT_PERSONA_FK = persona.RUT_PERSONA )AND ID_PERFIL_FK IN (4 , 5)";
    $respuesta = $database->query($sql);
    return $respuesta;
}

public function obtenerJugadoresPorClub(){
    $database = Database::connect();
    $sql = "SELECT * FROM PERSONA_JUGADOR PJ 
    INNER JOIN PERSONA P ON (PJ.RUT_PERSONA_FK = P.RUT_PERSONA) WHERE ID_CLUB_FK =".$this->getidClub();
    $respuesta = $database->query($sql);
    return $respuesta;
}

public function eliminarJugador(){
    $database = Database::connect();
    $sql = "DELETE FROM PERSONA_JUGADOR WHERE RUT_PERSONA_FK =".$this->getrutPersona();
    $respuesta = $database->query($sql);
    return $respuesta;
}

public function cargarJugadoresTecnico(){
    $database = Database::connect();
    $sql = 'SELECT * FROM persona_jugador INNER JOIN persona ON persona_jugador.RUT_PERSONA_FK = persona.RUT_PERSONA WHERE ID_CLUB_FK='.$this->getidClub();
    $respuesta = $database->query($sql);
    return $respuesta;
}

public function EliminarPerfilJugador(){
    $database = Database::connect();
    $sql = "UPDATE persona SET ID_PERFIL_FK = 2 WHERE RUT_PERSONA =".$this->getrutPersona();
    $respuesta = $database->query($sql);
    return $respuesta;
}

}