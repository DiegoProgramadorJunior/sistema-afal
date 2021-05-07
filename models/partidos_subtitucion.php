<?php 

require_once 'config/database.php';

class Partido_Subtituciones{

    private $id_partido_subtituciones;
    private $id_partido_fk;
    private $rut_jugador_entrando;
    private $rut_jugador_saliendo;
    private $minuto_subtitucion;

    public function getIdPartidosGoles(){
        return $this->id_partido_goles;
    }

    public function setIdPartidosGoles($id_partido_goles){
        $this->id_partido_goles = $id_partido_goles;
    }

    public function getIdPartidosFk(){
        return $this->id_partido_fk;
    }

    public function setIdPartidosFk($id_partido_fk){
        $this->id_partido_fk = $id_partido_fk;
    }

    public function getRutJugadorEntra(){
        return $this->rut_jugador_entrando;
    }

    public function setRutJugadorEntra($rut_jugador_entrando){
        $this->rut_jugador_entrando = $rut_jugador_entrando;
    }
    public function getRutJugadorSale(){
        return $this->rut_jugador_saliendo;
    }

    public function setRutJugadorSale($rut_jugador_saliendo){
        $this->rut_jugador_saliendo = $rut_jugador_saliendo;
    }
    public function getMinutoSubtitucion(){
        return $this->minuto_subtitucion;
    }

    public function setMinutoSubtitucion($minuto_subtitucion){
        $this->minuto_subtitucion = $minuto_subtitucion;
    }
}