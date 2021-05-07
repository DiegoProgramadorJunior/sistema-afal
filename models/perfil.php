<?php

class Perfil{
    
    private $id_perfil;
    private $nombre_perfil;

    public function getIdPerfil(){
        return $this->id_perfil;
    }
    public function setIdPerfil($id_perfil){
        $this->id_perfil=$id_perfil;
    }
    
    public function getNombrePerfil(){
        return $this->nombre_perfil;
    }
    public function setNombrePerfil($nombre_perfil){
        $this->nombre_perfil = $nombre_perfil;
    }
    
    public function obtenerPerfiles(){
        $resultado = false;
        $database = Database::connect();

        $sql = "SELECT * FROM perfil";

        $respuesta = $database->query($sql);

        if($respuesta && $respuesta->num_rows > 0){
            $resultado = $respuesta;
        }

        return $resultado;
    }

}