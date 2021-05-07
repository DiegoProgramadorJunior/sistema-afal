<?php

class Tipoestado{
    
    private $id_tipo_estado;
    private $nombre_tipo_estado;

    public function getIdtipoestado(){
        return $this->id_tipo_estado;
    }
    public function setIdtipoestado($id_tipo_estado){
        $this->id_tipo_estado=$id_tipo_estado;
    }
    
    public function getNombretipoestado(){
        return $this->nombre_tipo_estado;
    }
    public function setNombretipoestado($nombre_tipo_estado){
        $this->nombre_tipo_estado = $nombre_tipo_estado;
    }
    
    public function obtenerEstados(){
        $resultado = false;
        $database = Database::connect();

        $sql = "SELECT * FROM TIPO_ESTADO";

        $respuesta = $database->query($sql);

        if($respuesta && $respuesta->num_rows > 0){
            $resultado = $respuesta;
        }

        return $resultado;
    }

}