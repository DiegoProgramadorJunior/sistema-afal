<?php 

require_once 'config/database.php';

class Asociacion{

    private $id_asociacion;
    private $rut_asociacion;
    private $dv_asociacion;
    private $nombre_asociacion;
    private $giro;
    private $fecha_fundacion_asociacion;
    private $numero_telefono;
    private $id_estado_tipo;

    public function getIdAsociacion(){
        return $this->id_asociacion;
    }
    
    public function setIdAsociacion($id_asociacion){
        $this->id_asociacion = $id_asociacion;
    }

    public function getRutAsociacion(){
        return $this->rut_asociacion;
    }

    public function setRutAsociacion($rut_asociacion)
    {
        $this->rut_asociacion = $rut_asociacion;
    }

    public function getDvAsociacion(){
        return $this->dv_asociacion;
    }

    public function setDvAsociacion($dv_asociacion)
    {
        $this->dv_asociacion = $dv_asociacion;
    }
    
    public function getNombreAsociacion(){
        return $this->nombre_asociacion;
    }

    public function setNombreAsociacion($nombre_asociacion)
    {
        $this->nombre_asociacion = $nombre_asociacion;
    }

    public function getGiro(){
        return $this->giro;
    }

    public function setGiro($giro)
    {
        $this->giro = $giro;
    }

    public function getFechaFundacionAsociacion(){
        return $this->fecha_fundacion_asociacion;
    }

    public function setFechaFundacionAsociacion($fecha_fundacion_asociacion)
    {
        $this->fecha_fundacion_asociacion = $fecha_fundacion_asociacion;
    }

    public function getNumeroTelefono(){
        return $this->numero_telefono;
    }

    public function setNumeroTelefono($numero_telefono)
    {
        $this->numero_telefono = $numero_telefono;
    }

    public function getIdTipoEstado(){
        return $this->id_tipo_estado;
    }
    
    public function setIdTipoEstado($id_tipo_estado){
        $this->id_tipo_estado = $id_tipo_estado;
    }

    public function obtenerAsociaciones(){

        $resultado = false;
        $database = Database::connect();

        $sql = "SELECT * FROM asociacion";

        $respuesta = $database->query($sql);

        if($respuesta && $respuesta->num_rows > 0){
            $resultado = $respuesta;
        }

        return $resultado;
    }
}