<?php
require_once 'config/database.php';

class Noticia{

    private $id_noticia;
    private $encabezado;
    private $publicacion;
    private $autor_fk;
    private $fecha;
    private $descripcion;


    public function getIdNoticia(){
        return $this->id_noticia;
    }
    
    public function setIdNoticia($id_noticia){
        $this->id_noticia = $id_noticia;
    }
    //===
    public function getEncabezado(){
        return $this->encabezado;
    }
    
    public function setEncabezado($encabezado){
        $this->encabezado = $encabezado;
    }
    //===
    public function getPublicacion(){
        return $this->publicacion;
    }
    
    public function setPublicacion($publicacion){
        $this->publicacion = $publicacion;
    }
    //===
    public function getAutorFk(){
        return $this->autor_fk;
    }
    
    public function setAutorFk($autor_fk){
        $this->autor_fk = $autor_fk;
    }
    //===
    public function getFecha(){
        return $this->fecha;
    }
    
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    //===
    public function getDescripcion(){
        return $this->descripcion;
    }
    
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    //===


    public function obtenerNoticia(){

        $database = Database::connect();
        $sql = "SELECT * FROM noticia";
        $respuesta = $database->query($sql);
        return $respuesta;

    }

    public function obtenerNoticiaCarrusel(){

        $database = Database::connect();
        $sql = "SELECT * FROM noticia";
        $respuesta = $database->query($sql);
        return $respuesta;

    }

    public function agregarNoticia(){

        $database = Database::connect();
        $sql = "INSERT INTO noticia (ENCABEZADO, PUBLICACION, AUTOR_FK, FECHA, DESCRIPCION) VALUES (".$this->getEncabezado().", ".$this->getPublicacion().", ".$this->getAutorFk().", ".$this->getFecha().",".$this->getDescripcion().")";
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    

}