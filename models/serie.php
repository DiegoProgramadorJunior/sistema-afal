<?php

require_once 'config/database.php';

class Serie{
    private $id_serie;
    private $nombre_serie;

    public function getIdSerie(){
        return $this->id_serie;
    }

    public function setIdSerie($id_serie){
        $this->id_serie = $id_serie;
    }

    public function getNombreSerie(){
        return $this->nombre_serie;
    }

    public function setNombreSerie($nombre_serie){
        $this->nombre_serie = $nombre_serie;
    }

    public function obtenerSeries(){

        $resultado = false;
        $database = Database::connect();

        $sql = "SELECT * FROM serie";

        $respuesta = $database->query($sql);

        if($respuesta && $respuesta->num_rows > 0){
            $resultado = $respuesta;
        }

        return $resultado;
    }

    public function obtenerUnaSerie(){
        $database = Database::connect();
        $sql = "SELECT * FROM serie WHERE ID_SERIE =".$this->getIdSerie();
        $respuesta = $database->query($sql);

        return $respuesta->fetch_assoc();
    }

    public function editarSerie(){
        $database = Database::connect();
        $sql = 'UPDATE serie SET NOMBRE_SERIE ="'.$this->getNombreSerie().'" WHERE ID_SERIE ='.$this->getIdSerie();
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function eliminarSerie(){
        $database = Database::connect();
        $sql = 'DELETE FROM serie WHERE ID_SERIE = '.$this->getIdSerie();
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function crearSerie(){
        $database = Database::connect();
        $sql = 'INSERT INTO serie (NOMBRE_SERIE) VALUES ("'.$this->getNombreSerie().'")';
        $respuesta = $database->query($sql);
        return $respuesta;      
    }
}
?>