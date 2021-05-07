<?php 

require_once 'config/database.php';

class Partido_Jugadores{

    private $id_partido_jugadores;
    private $id_partido_fk;
    private $rut_jugador_fk;
    private $numero_jugador;   

    public function getIdPartidoJugadores(){
        return $this->id_partido_jugadores;
    }

    public function setIdPartidoJugadores($id_partido_jugadores){
        $this->id_partido_jugadores = $id_partido_jugadores;
    }

    public function getIdPartidosFk(){
        return $this->id_partido_fk;
    }

    public function setIdPartidosFk($id_partido_fk){
        $this->id_partido_fk = $id_partido_fk;
    }

    public function getRutJugador(){
        return $this->rut_jugador_fk;
    }

    public function setRutJugador($rut_jugador_fk){
        $this->rut_jugador_fk = $rut_jugador_fk;
    }


    public function getNumeroJugador(){
        return $this->numero_jugador;
    }

    public function setNumeroJugador($numero_jugador){
        $this->numero_jugador = $numero_jugador;
    }

    public function obtenerJugadoresLocal($club){
        $database = Database::connect();
        $sql = 'SELECT * FROM partido_jugadores INNER JOIN persona_jugador ON partido_jugadores.ID_PERSONA_JUGADOR_FK = persona_jugador.ID_PERSONA_JUGADOR INNER JOIN persona ON persona_jugador.RUT_PERSONA_FK = persona.RUT_PERSONA WHERE ID_PARTIDO_FK ='.$this->getIdPartidosFk().' AND ID_CLUB_FK ='.$club;
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function obtenerJugadoresVisita($club){
        $database = Database::connect();
        $sql = 'SELECT * FROM partido_jugadores INNER JOIN persona_jugador ON partido_jugadores.ID_PERSONA_JUGADOR_FK = persona_jugador.ID_PERSONA_JUGADOR INNER JOIN persona ON persona_jugador.RUT_PERSONA_FK = persona.RUT_PERSONA WHERE ID_PARTIDO_FK ='.$this->getIdPartidosFk().' AND ID_CLUB_FK ='.$club;
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function datosPartidosClubes($serie){
        $database = Database::connect();
        $sql = 'SELECT cl.ID_CLUB as ID_CLUB_LOCAL,cl.NOMBRE_CLUB as CLUB_LOCAL,cv.ID_CLUB as ID_CLUB_VISITA ,cv.NOMBRE_CLUB as CLUB_VISITA,
        CONCAT(praL.NOMBRE_1," ",praL.NOMBRE_2," ",praL.APELLIDO_1," ",praL.APELLIDO_2) AS NOMBRE_TECNICO_LOCAL,
        CONCAT(praV.NOMBRE_1," ",praV.NOMBRE_2," ",praV.APELLIDO_1," ",praV.APELLIDO_2) AS NOMBRE_TECNICO_VISITA
        from partidos p 
        inner join campeonato c on(p.ID_CAMPEONATO_FK = c.ID_CAMPEONATO)
        inner join serie s on (c.ID_SERIE_FK = s.ID_SERIE)
        
        inner join club cl on ( p.ID_CLUB_LOCAL_FK = cl.ID_CLUB)
        inner join persona_tecnico ptl on (cl.ID_CLUB = ptl.ID_CLUB_FK )
        inner join tecnico_serie tsl on (tsl.ID_PERSONA_TECNICO_FK = ptl.ID_PERSONA_TECNICO )
        
        inner join club cv on ( p.ID_CLUB_VISITA_FK = cv.ID_CLUB)
        inner join persona_tecnico ptv on (cv.ID_CLUB = ptv.ID_CLUB_FK)
        inner join tecnico_serie tsv on (tsv.ID_PERSONA_TECNICO_FK = ptv.ID_PERSONA_TECNICO )
        
        inner join persona praL on (ptl.RUT_PERSONA_FK = praL.RUT_PERSONA)
        inner join persona praV on (ptv.RUT_PERSONA_FK = praV.RUT_PERSONA)  where s.ID_SERIE ='.$serie.' AND p.ID_PARTIDO = '.$this->getIdPartidosFk();
        $respuesta = $database->query($sql);
        return $respuesta->fetch_object();
    }
}