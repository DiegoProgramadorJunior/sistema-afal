<?php 

require_once 'config/database.php';

class Partido_Amonestaciones{

    private $id_partido_amonestaciones;
    private $id_partido_fk;
    private $rut_amonestado;
    private $id_tipo_tarjeta_fk;
    private $id_tipo_falta_fk;
    private $minuto_amonestacion;

    public function getIdPartidoAmonestaciones(){
        return $this->id_partido_amonestaciones;
    }

    public function setIdPartidoAmonestaciones($id_partido_amonestaciones){
        $this->id_partido_amonestaciones = $id_partido_amonestaciones;
    }

    public function getIdPartidosFk(){
        return $this->id_partido_fk;
    }

    public function setIdPartidosFk($id_partido_fk){
        $this->id_partido_fk = $id_partido_fk;
    }

    public function getRutAmonestado(){
        return $this->rut_amonestado;
    }

    public function setRutAmonestado($rut_amonestado){
        $this->rut_amonestado = $rut_amonestado;
    }

    public function getIdTipoTarjeta(){
        return $this->id_tipo_tarjeta_fk;
    }

    public function setIdTipoTarjeta($id_tipo_tarjeta_fk){
        $this->id_tipo_tarjeta_fk = $id_tipo_tarjeta_fk;
    }

    public function getIdTipoFalta(){
        return $this->id_tipo_falta_fk;
    }

    public function setIdTipoFalta($id_tipo_falta_fk){
        $this->id_tipo_falta_fk = $id_tipo_falta_fk;
    }

    public function getMinutoAmonestacion(){
        return $this->minuto_amonestacion;
    }

    public function setMinutoAmonestacion($minuto_amonestacion){
        $this->minuto_amonestacion = $minuto_amonestacion;
    }
}