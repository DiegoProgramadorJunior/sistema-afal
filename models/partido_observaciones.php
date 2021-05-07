<?php 

require_once 'config/database.php';

class Partido_Observaciones{

    private $id_partido_observacion;
    private $id_partido_fk;
    private $observacion;
    private $rut_turno;   

    public function getIdPartidoObservacion(){
        return $this->id_partido_observacion;
    }

    public function setIdPartidoObservacion($id_partido_observacion){
        $this->id_partido_observacion = $id_partido_observacion;
    }

    public function getIdPartidosFk(){
        return $this->id_partido_fk;
    }

    public function setIdPartidosFk($id_partido_fk){
        $this->id_partido_fk = $id_partido_fk;
    }

    public function getObservacion(){
        return $this->observacion;
    }

    public function setObservacionk($observacion){
        $this->observacion = $observacion;
    }


    public function getRutTurno(){
        return $this->rut_turno;
    }

    public function setRutTurno($rut_turno){
        $this->rut_turno = $rut_turno;
    }

}