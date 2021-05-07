<?php

require_once 'config/database.php';

class Campeonato{
    
    private $id_campeonato;
    private $nombre_campeonato;
    private $fecha_inicio;
    private $id_asociacion;
    private $id_serie;
    private $id_estado_campeonato;

    public function getIdCampeonato(){
        return $this->id_campeonato;
    }

    public function setIdCampeonato($id_campeonato){
        $this->id_campeonato = $id_campeonato;
    }

    public function getNombreCampeonato(){
        return $this->nombre_campeonato;
    }

    public function setNombreCampeonato($nombre_campeonato){
        $this->nombre_campeonato = $nombre_campeonato;
    }

    public function getFechaInicio(){
        return $this->fecha_inicio;
    }

    public function setFechaInicio($fecha_inicio){
        $this->fecha_inicio = $fecha_inicio;
    }

    public function getIdAsociacion(){
        return $this->id_asociacion;
    }
    
    public function setIdAsociacion($id_asociacion){
        $this->id_asociacion = $id_asociacion;
    }

    public function getIdSerie(){
        return $this->id_serie;
    }

    public function setIdSerie($id_serie){
        $this->id_serie = $id_serie;
    }

    public function getIdEstadoCampeonato(){
        return $this->id_estado_campeonato;
    }
    
    public function setIdEstadoCampeonato($id_estado_campeonato){
        $this->id_estado_campeonato = $id_estado_campeonato;
    }

    public function obtenerCampeonatos(){
        $resultado = false;
        $database = Database::connect();
        $condicion1 = 1;
        $condicion2 = 2;
        $sql = "SELECT * FROM campeonato INNER JOIN asociacion ON campeonato.ID_ASOCIACION_FK = asociacion.ID_ASOCIACION INNER JOIN serie ON campeonato.ID_SERIE_FK = serie.ID_SERIE INNER JOIN estado_campeonato ON campeonato.ID_ESTADO_CAMPEONATO_FK = estado_campeonato.ID_ESTADO_CAMPEONATO WHERE ID_ESTADO_CAMPEONATO_FK BETWEEN 1 AND 2";

        $respuesta = $database->query($sql);

        if($respuesta){
            $resultado = $respuesta;
        }

        return $resultado;
    }

    public function obtenerCampeonatosVigentes(){
        $resultado = false;
        $database = Database::connect();
        $condicion1 = 1;
        $condicion2 = 2;
        $sql = "SELECT * FROM campeonato INNER JOIN asociacion ON campeonato.ID_ASOCIACION_FK = asociacion.ID_ASOCIACION INNER JOIN serie ON campeonato.ID_SERIE_FK = serie.ID_SERIE INNER JOIN estado_campeonato ON campeonato.ID_ESTADO_CAMPEONATO_FK = estado_campeonato.ID_ESTADO_CAMPEONATO WHERE ID_ESTADO_CAMPEONATO_FK = 2";

        $respuesta = $database->query($sql);

        if($respuesta){
            $resultado = $respuesta;
        }

        return $resultado;
    }

    public function obtenerUnCampeonato(){
        $resultado = false;
        $database = Database::connect();

        $sql = "SELECT * FROM campeonato INNER JOIN asociacion ON campeonato.ID_ASOCIACION_FK = asociacion.ID_ASOCIACION INNER JOIN serie ON campeonato.ID_SERIE_FK = serie.ID_SERIE INNER JOIN estado_campeonato ON campeonato.ID_ESTADO_CAMPEONATO_FK = estado_campeonato.ID_ESTADO_CAMPEONATO WHERE ID_CAMPEONATO =".$this->getIdCampeonato();

        $respuesta = $database->query($sql);

        if($respuesta && $respuesta->num_rows > 0){
            $resultado = $respuesta->fetch_assoc();
        }

        return $resultado;
    }

    public function crearCampeonato(){
        $resultado = false;
        $database = Database::connect();

        $sql = "INSERT INTO campeonato (NOMBRE_CAMPEONATO,FECHA_INICIO,ID_ASOCIACION_FK,ID_SERIE_FK,ID_ESTADO_CAMPEONATO_FK) VALUES ('".$this->getNombreCampeonato()."','".$this->getFechaInicio()."',".$this->getIdAsociacion().",".$this->getIdSerie().",1)";
        $respuesta = $database->query($sql);

        if($respuesta){
            $resultado = true;
        }

        return $resultado;
    }

    public function editarCampeonato(){
        $resultado = false;
        $database = Database::connect();

        $sql = "UPDATE campeonato SET NOMBRE_CAMPEONATO = '".$this->getNombreCampeonato()."', FECHA_INICIO = '".$this->getFechaInicio()."', ID_ASOCIACION_FK = ".$this->getIdAsociacion().", ID_SERIE_FK = ".$this->getIdSerie().", ID_ESTADO_CAMPEONATO_FK = ".$this->getIdEstadoCampeonato()." WHERE ID_CAMPEONATO =".$this->getIdCampeonato();
        $respuesta = $database->query($sql);

        if($respuesta){
            $resultado = true;
        }

        return $resultado;
    }

    public function deshabilitarCampeonato(){
        $resultado = false;
        $database = Database::connect();

        $sql = "UPDATE campeonato SET ID_ESTADO_CAMPEONATO_FK = ".$this->getIdEstadoCampeonato()." WHERE ID_CAMPEONATO =".$this->getIdCampeonato();
        $respuesta = $database->query($sql);

        if($respuesta){
            $resultado = true;
        }

        return $sql;
    }
}