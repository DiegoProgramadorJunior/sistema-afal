<?php 

require_once 'config/database.php';

class Tipo_Targeta{

    private $id_tipo_tarjeta;
    private $nombre_tipo_tarjeta;

    public function getIdTipoTarjeta(){
        return $this->id_tipo_tarjeta;
    }

    public function setIdIdTipoTarjeta($id_tipo_tarjeta){
        $this->id_tipo_tarjeta = $id_tipo_tarjeta;
    }

    public function getNombreTipoTarjeta(){
        return $this->nombre_tipo_tarjeta;
    }

    public function setNombreTipoTarjeta($nombre_tipo_tarjeta){
        $this->nombre_tipo_tarjeta = $nombre_tipo_tarjeta;
    }

    public function obtenerTiposTarjetas(){
        $resultado = false;
        $database = Database::connect();
        $sql = "SELECT * FROM TIPO_TARJETA";
        $respuesta = $database->query($sql);
        if($respuesta){
            $resultado = $respuesta;
        }
        return  $resultado;
    }
}