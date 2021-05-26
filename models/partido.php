<?php
require_once 'config/database.php';

class Partido{

    private $id_partido;
    private $fecha_date;
    private $fecha_campeonato;
    private $id_club_local;
    private $id_club_visita;
    private $rut_turno; // apunta a la tabla persona aquellas personas que cuenten con perfil turno
    private $rut_persona_arbitro_1; 
    private $rut_persona_arbitro_2; 
    private $rut_persona_arbitro_3; 
    private $nombre_estadio;
    private $id_campeonato;
    private $estado;
    
    public function getIdPartido(){
        return $this->id_partido;
    }

    public function setIdPartido($idPartido){
        $this->id_partido = $idPartido;
    }

    // Geter y Seter FechaDate
    public function getFechaDate(){
        return $this->fecha_date;
    }
    public function setFechaDate($fecha_date){
          $this->fecha_date = $fecha_date;
    }
    
    // Geter y Seter IdFechaCampeonato
    public function getFechaCampeonato(){
        return $this->fecha_campeonato;
    }
    public function setFechaCampeonato($fecha_campeonato){
        $this->fecha_campeonato = $fecha_campeonato;
    }
     
    // Geter y Seter IdCLubLocal
    public function getIdCLubLocal(){
        return $this->id_club_local;
    }
    public function setIdCLubLocal($id_club_local){
        $this->id_club_local = $id_club_local;
    }
    
    // Geter y Seter IdCLubVisita
    public function getIdCLubVisita(){
        return $this->id_club_visita;
    }
    public function setIdCLubVisita($id_club_visita){
        $this->id_club_visita = $id_club_visita;
    }
    
    // Geter y Seter RutTurno
    public function getRutTurno(){
        return $this->rut_turno;
    }
    public function setRutTurno($rut_turno){
        $this->rut_turno = $rut_turno;
    }

    // Geter Y Seter IdArbitrosPartido
    public function getRutArbitro1(){
        return $this->rut_persona_arbitro_1;
    }
    public function setRutArbitro1($rut_persona_arbitro_1){
        $this->rut_persona_arbitro_1 = $rut_persona_arbitro_1;
    }

    public function getRutArbitro2(){
        return $this->rut_persona_arbitro_2;
    }
    public function setRutArbitro2($rut_persona_arbitro_2){
        $this->rut_persona_arbitro_2 = $rut_persona_arbitro_2;
    }

    public function getRutArbitro3(){
        return $this->rut_persona_arbitro_3;
    }
    public function setRutArbitro3($rut_persona_arbitro_3){
        $this->rut_persona_arbitro_3 = $rut_persona_arbitro_3;
    }

    public function getNombreEstadio(){
        return $this->nombre_estadio;
    }

    public function setNombreEstadio($nombre_estadio){
        $this->nombre_estadio = $nombre_estadio;
    }

    public function getIdCampeonato(){
        return $this->id_campeonato;
    }

    public function setIdCampeonato($id_campeonato){
        $this->id_campeonato = $id_campeonato;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function obtenerPartidos(){
        $database = Database::connect();
        $sql = "SELECT * FROM partidoS 
        INNER JOIN campeonato ON partidos.ID_CAMPEONATO_FK = campeonato.ID_CAMPEONATO
        WHERE campeonato.ID_ESTADO_CAMPEONATO_FK = 2";
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function obtenerPartidosDeCampeonato(){
        $database = Database::connect();
        $sql = 'SELECT ID_PARTIDO, FECHA_DATE, PA.RUT_PERSONA AS RUT_ARBITRO, FECHA_CAMPEONATO AS FECHA_STRING, CL.NOMBRE_CLUB AS CLUB_LOCAL,  CV.NOMBRE_CLUB AS CLUB_VISITA,
        CONCAT(PT.NOMBRE_1," ",PT.NOMBRE_2," ",PT.APELLIDO_1," ",PT.APELLIDO_2) AS NOMBRE_TURNO,
        CONCAT(PA.NOMBRE_1," ",PA.NOMBRE_2," ",PA.APELLIDO_1," ",PA.APELLIDO_2) AS NOMBRE_ARBITRO,
        ID_ESTADO_CAMPEONATO_FK
        from PARTIDOS
        INNER JOIN CLUB CL ON (PARTIDOS.ID_CLUB_LOCAL_FK = CL.ID_CLUB)
        INNER JOIN CLUB CV ON (PARTIDOS.ID_CLUB_VISITA_FK = CV.ID_CLUB)
        INNER JOIN PERSONA PT ON (PARTIDOS.RUT_PERSONA_TURNO_FK = PT.RUT_PERSONA)
        INNER JOIN PERSONA PA ON (PARTIDOS.RUT_PERSONA_ARBITRO_1 = PA.RUT_PERSONA)
        INNER JOIN CAMPEONATO ON (PARTIDOS.ID_CAMPEONATO_FK = CAMPEONATO.ID_CAMPEONATO)WHERE partidos.ID_CAMPEONATO_FK ='.$this->getIdCampeonato();
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function crearPartido(){
        $database = Database::connect();
        $sql = "";
        $resultado = false;
        
        if($this->getRutArbitro1()>0 && $this->getRutArbitro2()<1 && $this->getRutArbitro3()<1){
            $sql = 'INSERT INTO partidos (FECHA_DATE,FECHA_CAMPEONATO,ID_CLUB_LOCAL_FK,ID_CLUB_VISITA_FK,RUT_PERSONA_TURNO_FK,RUT_PERSONA_ARBITRO_1,RUT_PERSONA_ARBITRO_2,RUT_PERSONA_ARBITRO_3,NOMBRE_ESTADIO,ID_CAMPEONATO_FK,ID_ESTADO_PARTIDO_FK) VALUES 
            ("'.$this->getFechaDate().'","'.$this->getFechaCampeonato().'",'.$this->getIdCLubLocal().','.$this->getIdCLubVisita().','.$this->getRutTurno().','.$this->getRutArbitro1().',null,null,"'.$this->getNombreEstadio().'",'.$this->getIdCampeonato().',DEFAULT)';

        }elseif($this->getRutArbitro1()>0 && $this->getRutArbitro2()>0 && $this->getRutArbitro3()<1){
            $sql = 'INSERT INTO partidos (FECHA_DATE,FECHA_CAMPEONATO,ID_CLUB_LOCAL_FK,ID_CLUB_VISITA_FK,RUT_PERSONA_TURNO_FK,RUT_PERSONA_ARBITRO_1,RUT_PERSONA_ARBITRO_2,RUT_PERSONA_ARBITRO_3,NOMBRE_ESTADIO,ID_CAMPEONATO_FK,ID_ESTADO_PARTIDO_FK) VALUES 
            ("'.$this->getFechaDate().'","'.$this->getFechaCampeonato().'",'.$this->getIdCLubLocal().','.$this->getIdCLubVisita().','.$this->getRutTurno().','.$this->getRutArbitro1().','.$this->getRutArbitro2().',null,"'.$this->getNombreEstadio().'",'.$this->getIdCampeonato().',DEFAULT)';

        }elseif($this->getRutArbitro1()>0 && $this->getRutArbitro2()>0 && $this->getRutArbitro3()>0){
            $sql = 'INSERT INTO partidos (FECHA_DATE,FECHA_CAMPEONATO,ID_CLUB_LOCAL_FK,ID_CLUB_VISITA_FK,RUT_PERSONA_TURNO_FK,RUT_PERSONA_ARBITRO_1,RUT_PERSONA_ARBITRO_2,RUT_PERSONA_ARBITRO_3,NOMBRE_ESTADIO,ID_CAMPEONATO_FK,ID_ESTADO_PARTIDO_FK) VALUES 
            ("'.$this->getFechaDate().'","'.$this->getFechaCampeonato().'",'.$this->getIdCLubLocal().','.$this->getIdCLubVisita().','.$this->getRutTurno().','.$this->getRutArbitro1().','.$this->getRutArbitro2().','.$this->getRutArbitro3().',"'.$this->getNombreEstadio().'",'.$this->getIdCampeonato().',DEFAULT)';
        }

        $respuesta = $database->query($sql);
        if($respuesta){
            $resultado = $respuesta;
        }
        return $resultado;
    }
    
    public function obtenerPartidosTurno(){
        $database = Database::connect();
        $sql = 'SELECT ID_PARTIDO, FECHA_DATE, PA.RUT_PERSONA AS RUT_ARBITRO, FECHA_CAMPEONATO AS FECHA_STRING, CL.NOMBRE_CLUB AS CLUB_LOCAL,  CV.NOMBRE_CLUB AS CLUB_VISITA,
        PT.RUT_PERSONA AS RUT_TURNO,
        CONCAT(PA.NOMBRE_1," ",PA.NOMBRE_2," ",PA.APELLIDO_1," ",PA.APELLIDO_2) AS NOMBRE_ARBITRO,
        ID_ESTADO_CAMPEONATO_FK, ID_ESTADO_PARTIDO_FK , CL.ID_CLUB AS ID_CLUB_LOCAL, CV.ID_CLUB AS ID_CLUB_VISITA
        from PARTIDOS
        INNER JOIN CLUB CL ON (PARTIDOS.ID_CLUB_LOCAL_FK = CL.ID_CLUB)
        INNER JOIN CLUB CV ON (PARTIDOS.ID_CLUB_VISITA_FK = CV.ID_CLUB)
        INNER JOIN PERSONA PT ON (PARTIDOS.RUT_PERSONA_TURNO_FK = PT.RUT_PERSONA)
        INNER JOIN PERSONA PA ON (PARTIDOS.RUT_PERSONA_ARBITRO_1 = PA.RUT_PERSONA)
        INNER JOIN CAMPEONATO ON (PARTIDOS.ID_CAMPEONATO_FK = CAMPEONATO.ID_CAMPEONATO) WHERE PT.RUT_PERSONA = '.$this->getRutTurno().' AND NOT ID_ESTADO_PARTIDO_FK = 4';
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function obtenerUnPartido(){
        $database = Database::connect();
        $sql = 'SELECT * FROM partidos INNER JOIN campeonato ON partidos.ID_CAMPEONATO_FK = campeonato.ID_CAMPEONATO WHERE ID_PARTIDO='.$this->getIdPartido();
        $respuesta = $database->query($sql);
        return $respuesta->fetch_object();
    }

    public function datosDeUnPartido(){
        $database = Database::connect();
        $sql = 'SELECT ID_PARTIDO, FECHA_DATE, PA.RUT_PERSONA AS RUT_ARBITRO, FECHA_CAMPEONATO AS FECHA_STRING, CL.NOMBRE_CLUB AS CLUB_LOCAL,  CV.NOMBRE_CLUB AS CLUB_VISITA,
        CONCAT(PT.NOMBRE_1," ",PT.NOMBRE_2," ",PT.APELLIDO_1," ",PT.APELLIDO_2) AS NOMBRE_TURNO,
        CONCAT(PA.NOMBRE_1," ",PA.NOMBRE_2," ",PA.APELLIDO_1," ",PA.APELLIDO_2) AS NOMBRE_ARBITRO,
        ID_ESTADO_CAMPEONATO_FK
        from PARTIDOS
        INNER JOIN CLUB CL ON (PARTIDOS.ID_CLUB_LOCAL_FK = CL.ID_CLUB)
        INNER JOIN CLUB CV ON (PARTIDOS.ID_CLUB_VISITA_FK = CV.ID_CLUB)
        INNER JOIN PERSONA PT ON (PARTIDOS.RUT_PERSONA_TURNO_FK = PT.RUT_PERSONA)
        INNER JOIN PERSONA PA ON (PARTIDOS.RUT_PERSONA_ARBITRO_1 = PA.RUT_PERSONA)
        INNER JOIN CAMPEONATO ON (PARTIDOS.ID_CAMPEONATO_FK = CAMPEONATO.ID_CAMPEONATO)';
        $respuesta = $database->query($sql);
        return $respuesta->fetch_object();
    }

    public function actualizarPartido(){
        $database = Database::connect();
        $sql = '';
        if($this->getRutArbitro1()>0 && $this->getRutArbitro2()<1 && $this->getRutArbitro3()<1){
            $sql = 'UPDATE partidos SET FECHA_DATE="'.$this->getFechaDate().'", FECHA_CAMPEONATO ="'.$this->getFechaCampeonato().'", ID_CLUB_LOCAL_FK ='.$this->getIdCLubLocal().', ID_CLUB_VISITA_FK='.$this->getIdCLubVisita().', RUT_PERSONA_TURNO_FK='.$this->getRutTurno().', RUT_PERSONA_ARBITRO_1 ='.$this->getRutArbitro1().', RUT_PERSONA_ARBITRO_2 = null , RUT_PERSONA_ARBITRO_3 = null, NOMBRE_ESTADIO = "'.$this->getNombreEstadio().'", ID_CAMPEONATO_FK = '.$this->getIdCampeonato().' WHERE ID_PARTIDO ='.$this->getIdPartido();
        }elseif($this->getRutArbitro1()>0 && $this->getRutArbitro2()>0 && $this->getRutArbitro3()<1){
            $sql = 'UPDATE partidos SET FECHA_DATE="'.$this->getFechaDate().'", FECHA_CAMPEONATO ="'.$this->getFechaCampeonato().'", ID_CLUB_LOCAL_FK ='.$this->getIdCLubLocal().', ID_CLUB_VISITA_FK='.$this->getIdCLubVisita().', RUT_PERSONA_TURNO_FK='.$this->getRutTurno().', RUT_PERSONA_ARBITRO_1 ='.$this->getRutArbitro1().', RUT_PERSONA_ARBITRO_2 ='.$this->getRutArbitro2().', RUT_PERSONA_ARBITRO_3 = null, NOMBRE_ESTADIO = "'.$this->getNombreEstadio().'", ID_CAMPEONATO_FK = '.$this->getIdCampeonato().' WHERE ID_PARTIDO ='.$this->getIdPartido();

        }elseif($this->getRutArbitro1()>0 && $this->getRutArbitro2()>0 && $this->getRutArbitro3()>0){
            $sql = 'UPDATE partidos SET FECHA_DATE="'.$this->getFechaDate().'", FECHA_CAMPEONATO ="'.$this->getFechaCampeonato().'", ID_CLUB_LOCAL_FK ='.$this->getIdCLubLocal().', ID_CLUB_VISITA_FK='.$this->getIdCLubVisita().', RUT_PERSONA_TURNO_FK='.$this->getRutTurno().', RUT_PERSONA_ARBITRO_1 ='.$this->getRutArbitro1().', RUT_PERSONA_ARBITRO_2 ='.$this->getRutArbitro2().', RUT_PERSONA_ARBITRO_3 ='.$this->getRutArbitro3().', NOMBRE_ESTADIO = "'.$this->getNombreEstadio().'", ID_CAMPEONATO_FK = '.$this->getIdCampeonato().' WHERE ID_PARTIDO ='.$this->getIdPartido();
        }

        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function eliminar(){
        $database = Database::connect();
        $sql = 'DELETE FROM partidos WHERE ID_PARTIDO= '.$this->getIdPartido();
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function actualizarEstado(){
        $database = Database::connect();
        $sql = 'UPDATE partidos SET ID_ESTADO_PARTIDO_FK ='.$this->getEstado().' WHERE ID_PARTIDO='.$this->getIdPartido();
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function cargarProgramacion($serie){
        $database = Database::connect();
        $sql = 'SELECT CL.ID_CLUB AS ID_CLUB_LOCAL,
        CL.NOMBRE_CLUB AS CLUB_LOCAL,
        CV.ID_CLUB AS ID_CLUB_VISITA, 
        CV.NOMBRE_CLUB AS CLUB_VISITA, 
        CL.NOMBRE_ESTADIO AS ESTADIO_LOCAL,
        P.FECHA_DATE AS FECHA_PARTIDO FROM PARTIDOS P 
        INNER JOIN CAMPEONATO C ON (P.ID_CAMPEONATO_FK = C.ID_CAMPEONATO) 
        INNER JOIN CLUB CL ON (P.ID_CLUB_LOCAL_FK = CL.ID_CLUB) 
        INNER JOIN CLUB CV ON (P.ID_CLUB_VISITA_FK = CV.ID_CLUB) 
        WHERE ID_SERIE_FK ='.$serie.' AND C.ID_ESTADO_CAMPEONATO_FK = 2';
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function obtenerResultados($serie){
        $database = Database::connect();
        $sql = 'SELECT P.ID_PARTIDO AS ID_PARTIDO, CL.ID_CLUB AS ID_CLUB_LOCAL, CL.NOMBRE_CLUB AS CLUB_LOCAL,CV.ID_CLUB AS ID_CLUB_VISITA, CV.NOMBRE_CLUB AS CLUB_VISITA, CL.NOMBRE_ESTADIO AS ESTADIO_LOCAL,P.FECHA_DATE AS FECHA_PARTIDO FROM PARTIDOS P
        INNER JOIN CAMPEONATO C ON (P.ID_CAMPEONATO_FK = C.ID_CAMPEONATO)
        INNER JOIN CLUB CL ON (P.ID_CLUB_LOCAL_FK = CL.ID_CLUB)
        INNER JOIN CLUB CV ON (P.ID_CLUB_VISITA_FK = CV.ID_CLUB) WHERE ID_SERIE_FK ='.$serie.' AND C.ID_ESTADO_CAMPEONATO_FK = 2 AND P.ID_ESTADO_PARTIDO_FK = 4';
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function obtenerGoles($club,$partido){
        $database = Database::connect();
        $sql = 'SELECT * FROM PARTIDOS_GOLES PG 
        INNER JOIN PARTIDOS P ON (PG.ID_PARTIDO_FK = P.ID_PARTIDO) 
        INNER JOIN PERSONA_JUGADOR PJ ON (PG.RUT_GOLEADOR_FK = PJ.RUT_PERSONA_FK) WHERE ID_PARTIDO_FK ='.$partido.' AND ID_CLUB_FK ='.$club;
        $respuesta = $database->query($sql);
        return $respuesta->fetch_all(MYSQLI_ASSOC);
    }
}