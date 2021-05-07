<?php 

require_once 'config/database.php';

class Tipo_Falta{

    private $id_tipo_falta;
    private $nombre_tipo_falta;

    public function getIdTipoFalta(){
        return $this->id_tipo_falta;
    }

    public function setIdIdTipoFalta($id_tipo_falta){
        $this->id_tipo_falta = $id_tipo_falta;
    }

    public function getNombreTipoFalta(){
        return $this->nombre_tipo_falta;
    }

    public function setNombreTipoFalta($nombre_tipo_falta){
        $this->nombre_tipo_falta = $nombre_tipo_falta;
    }

    public function obtenerTiposFaltas(){
        $resultado = false;
        $database = Database::connect();
        $sql = "SELECT * FROM TIPO_FALTA";
        $respuesta = $database->query($sql);
        if($respuesta){
            $resultado = $respuesta;
        }
        return  $resultado;
    }
}