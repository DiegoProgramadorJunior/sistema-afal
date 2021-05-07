<?php 

require_once 'config/database.php';

class Partido_Goles{

    private $id_partido_goles;
    private $id_partido_fk;
    private $rut_goleador;
    private $rut_asistente;
    private $id_tipo_gol_fk;
    private $minuto_gol;

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

    public function getRutGoleador(){
        return $this->rut_goleador;
    }

    public function setRutGoleador($rut_goleador){
        $this->rut_goleador = $rut_goleador;
    }
    public function getRutAsistente(){
        return $this->rut_asistente;
    }

    public function setRutAsistente($rut_asistente){
        $this->rut_asistente = $rut_asistente;
    }
    public function getIdTipoGolFk(){
        return $this->id_tipo_gol_fk;
    }

    public function setIdIdTipoGolFk($id_tipo_gol_fk){
        $this->id_tipo_gol_fk = $id_tipo_gol_fk;
    }

    public function getMinutoGOl(){
        return $this->minuto_gol;
    }

    public function setMinutoGOl($minuto_gol){
        $this->minuto_gol = $minuto_gol;
    }
}