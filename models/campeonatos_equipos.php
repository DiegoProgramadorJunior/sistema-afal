<?php 

class ClubesParticipantes{

    private $id_clubes_participantes; 
    private $fecha_inscripcion;
    private $id_campeonato_fk;
    private $id_club_fk;

    public function getIdClubesParticipantes(){
        return $this->id_clubes_participantes;
    }

    public function setIdClubesParticipantes($id_clubes_participantes){
        $this->id_clubes_participantes = $id_clubes_participantes;
    }

    public function getFechaInscripcion(){
        return $this->fecha_inscripcion;
    }

    public function setFechaInscripcion($fecha_inscripcion){
        $this->fecha_inscripcion = $fecha_inscripcion;
    }

    public function getIdCampeonato(){
        return $this->id_campeonato_fk;
    }

    public function setIdCampeonato($id_campeonato_fk){
        $this->id_campeonato_fk = $id_campeonato_fk;
    }

    public function getIdClub(){
        return $this->id_club_fk;
    }

    public function setIdClub($id_club_fk){
        $this->id_club_fk = $id_club_fk;
    }

    public function obtenerClubesParticipantes(){
        $database = Database::connect();
        $sql = "SELECT * FROM campeonato_equipos INNER JOIN campeonato ON campeonato_equipos.ID_CAMPEONATO_FK = campeonato.ID_CAMPEONATO INNER JOIN club ON campeonato_equipos.ID_CLUB_FK = club.ID_CLUB WHERE ID_CAMPEONATO_FK =".$this->getIdCampeonato();
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function obtenerClubesNoInscritos(){
        $database = Database::connect();
        $sql = "SELECT * FROM club c WHERE NOT EXISTS (SELECT NULL FROM campeonato_equipos cam WHERE cam.ID_CLUB_FK = c.ID_CLUB AND ID_CAMPEONATO_FK =".$this->getIdCampeonato().")";
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function inscribirClub(){
        $database = Database::connect();
        $sql = "INSERT INTO campeonato_equipos (FECHA_INSCRIPCION,ID_CAMPEONATO_FK,ID_CLUB_FK) VALUES (CURDATE(),".$this->getIdCampeonato().",".$this->getIdClub().")";
        $respuesta = $database->query($sql);
        return $respuesta;
    }
    
    public function eliminarInscripcion(){
        $database = Database::connect();
        $sql = "DELETE FROM campeonato_equipos WHERE ID_CAMPEONATO_EQUIPOS =".$this->getIdClubesParticipantes();;
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function obtenerIdClubCampeonato(){
        $database = Database::connect();
        $sql = "SELECT * FROM campeonato_equipos WHERE ID_CAMPEONATO_EQUIPOS = ".$this->getIdClubesParticipantes();
        $respuesta = $database->query($sql);
        return $respuesta->fetch_object();

    }
}