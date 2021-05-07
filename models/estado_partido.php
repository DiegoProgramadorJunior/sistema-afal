<?php 

require_once 'config/database.php';

class Estado_Partido{

    private $id_estado_partido;
    private $nombre_estado_partido;

    public function getIdEstadoPartido(){
        return $this->id_estado_partido;
    }

    public function setIdEstadoPartido($id_estado_partido){
        $this->id_estado_partido = $id_estado_partido;
    }

    public function getNombreEstadoPartido(){
        return $this->nombre_estado_partido;
    }

    public function setNombreEstadoPartido($nombre_estado_partido){
        $this->nombre_estado_partido = $nombre_estado_partido;
    }

    public function obtenerEstados(){
        $resultado = false;
        $database = Database::connect();
        $sql = "SELECT * FROM estado_partido";       
        $respuesta = $database->query($sql);

        return $respuesta;
    }
}