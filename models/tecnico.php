<?php
require_once 'config/database.php';

class Tecnico
{

    private $id_persona_tecnico;
    private $rut_persona;
    private $id_club;

    public function getIdPersonaTecnico()
    {
        return $this->id_persona_tecnico;
    }

    public function setIdPersonaTecnico($id_persona_tecnico)
    {
        $this->id_persona_tecnico = $id_persona_tecnico;
    }

    public function getrutPersona()
    {
        return $this->rut_persona;
    }

    public function setrutPersona($rut_persona)
    {
        $this->rut_persona = $rut_persona;
    }

    public function getidClub()
    {
        return $this->id_club;
    }

    public function setidClub($id_club)
    {
        $this->id_club = $id_club;
    }

    public function obtenerTecnico()
    {
        $resultado = false;
        $database = Database::connect();
        $sql = "SELECT * FROM persona
        INNER JOIN direccion ON persona.ID_DIRECCION_FK = direccion.ID_DIRECCION 
        INNER JOIN comuna ON direccion.ID_COMUNA_FK = comuna.ID_COMUNA 
        INNER JOIN asociacion ON persona.ID_ASOCIACION_FK = asociacion.ID_ASOCIACION
        WHERE NOT EXISTS(SELECT NULL FROM PERSONA_TECNICO  WHERE PERSONA_TECNICO.RUT_PERSONA_FK = persona.RUT_PERSONA )AND ID_PERFIL_FK IN (2 , 5)";
        $respuesta = $database->query($sql);

        if ($respuesta) {
            $resultado = $respuesta;
        }

        return $resultado;
    }

    public function obtenerNameClubYNameTecnico()
    {
        $resultado = false;
        $database = Database::connect();
        $sql = 'SELECT NOMBRE_CLUB, CONCAT(NOMBRE_1," ",NOMBRE_2," ",APELLIDO_1, " ",APELLIDO_2) AS NOMBRE_COMPLETO
        FROM persona_tecnico
        INNER JOIN club on (persona_tecnico.ID_CLUB_FK = club.ID_CLUB)
        INNER JOIN persona p on (persona_tecnico.RUT_PERSONA_FK = p.RUT_PERSONA) WHERE ID_CLUB_FK =' . $this->getidClub();
        $respuesta = $database->query($sql);

        if ($respuesta) {
            $resultado = $respuesta;
        }

        return $resultado->fetch_assoc();
    }


    public function aderirTecnicoClub()
    {
        $database = Database::connect();
        $rut = $this->getrutPersona();
        $id = $this->getidClub();
        $sql = "INSERT INTO PERSONA_TECNICO (RUT_PERSONA_FK, ID_CLUB_FK) VALUES ($rut,$id)";
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function eliminarTecnico()
    {
        $database = Database::connect();
        $sql = "DELETE FROM PERSONA_TECNICO WHERE RUT_PERSONA_FK =" . $this->getrutPersona();
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function obtenerTecnicosPorClub()
    {
        $database = Database::connect();
        $sql = "SELECT * FROM TECNICO_SERIE TS
        INNER JOIN SERIE S ON (TS.ID_SERIE_FK = S.ID_SERIE)
        INNER JOIN PERSONA_TECNICO PT ON (TS.ID_PERSONA_TECNICO_FK = PT.ID_PERSONA_TECNICO)
        INNER JOIN PERSONA P ON (PT.RUT_PERSONA_FK = P.RUT_PERSONA)  WHERE ID_CLUB_FK =" . $this->getidClub();
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function obtenerDatosTecnicos()
    {
        $database = Database::connect();
        $sql = "SELECT * FROM PERSONA_TECNICO WHERE RUT_PERSONA_FK =" . $this->getrutPersona();
        $datos = $database->query($sql);
        $respuesta = $datos->fetch_object();
        return $respuesta;
    }

    public function obtenerPartidosTecnico($serie)
    {
        $database = Database::connect();
        $sql = 'SELECT ID_PARTIDO, FECHA_DATE, PA.RUT_PERSONA AS RUT_ARBITRO, FECHA_CAMPEONATO AS FECHA_STRING, CL.NOMBRE_CLUB AS CLUB_LOCAL,  CV.NOMBRE_CLUB AS CLUB_VISITA,
        CONCAT(PT.NOMBRE_1," ",PT.NOMBRE_2," ",PT.APELLIDO_1," ",PT.APELLIDO_2) AS NOMBRE_TURNO,
        CONCAT(PA.NOMBRE_1," ",PA.NOMBRE_2," ",PA.APELLIDO_1," ",PA.APELLIDO_2) AS NOMBRE_ARBITRO,
        CL.NOMBRE_ESTADIO AS ESTADIO,
        ID_CAMPEONATO_FK AS CAMPEONATO
        from PARTIDOS
        INNER JOIN CLUB CL ON (PARTIDOS.ID_CLUB_LOCAL_FK = CL.ID_CLUB)
        INNER JOIN CLUB CV ON (PARTIDOS.ID_CLUB_VISITA_FK = CV.ID_CLUB)
        INNER JOIN PERSONA PT ON (PARTIDOS.RUT_PERSONA_TURNO_FK = PT.RUT_PERSONA)
        INNER JOIN PERSONA PA ON (PARTIDOS.RUT_PERSONA_ARBITRO_1 = PA.RUT_PERSONA)
        INNER JOIN CAMPEONATO ON (PARTIDOS.ID_CAMPEONATO_FK = CAMPEONATO.ID_CAMPEONATO)  WHERE campeonato.ID_SERIE_FK =' . $serie . ' AND ID_ESTADO_PARTIDO_FK = 2 AND (ID_CLUB_VISITA_FK =' . $this->getidClub() . ' OR ID_CLUB_LOCAL_FK = ' . $this->getidClub() . ')';
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function obtenerSerieDeTecnico()
    {
        $database = Database::connect();
        $sql = 'SELECT * FROM tecnico_serie WHERE ID_PERSONA_TECNICO_FK =' . $this->getIdPersonaTecnico();
        $respuesta = $database->query($sql);
        return $respuesta->fetch_object();
    }

    public function verificarClubPartido()
    {
        $database = Database::connect();
        $sql = 'SELECT DISTINCT ID_CLUB_FK,ID_PARTIDO FROM PERSONA_JUGADOR
        INNER JOIN PARTIDO_JUGADORES PJ ON PERSONA_JUGADOR.ID_PERSONA_JUGADOR = PJ.ID_PERSONA_JUGADOR_FK
        INNER JOIN PARTIDOS P ON PJ.ID_PARTIDO_FK = P.ID_PARTIDO WHERE ID_CLUB_FK =' . $this->getidClub();
        $respuesta = $database->query($sql);
        return $respuesta->fetch_object();
    }

    public function verificarClubPartidoVisita($idVisita)
    {
        $database = Database::connect();
        $sql = 'SELECT DISTINCT ID_CLUB_FK,ID_PARTIDO FROM PERSONA_JUGADOR
        INNER JOIN PARTIDO_JUGADORES PJ ON PERSONA_JUGADOR.ID_PERSONA_JUGADOR = PJ.ID_PERSONA_JUGADOR_FK
        INNER JOIN PARTIDOS P ON PJ.ID_PARTIDO_FK = P.ID_PARTIDO WHERE ID_CLUB_FK =' . $idVisita;
        $respuesta = $database->query($sql);
        return $respuesta->fetch_object();
    }

    public function calculaEdad($fechanacimiento)
    {
        list($ano, $mes, $dia) = explode("-", $fechanacimiento);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0)
            $ano_diferencia--;

        return $ano_diferencia;
    }
}
