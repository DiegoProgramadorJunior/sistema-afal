<?php
require_once 'config/database.php';

class Tecnico_Serie{

    private $id_tecnico_serie;
    private $id_persona_tecnico;
    private $id_serie;

    public function getIdTecnicoSerie(){
        return $this->id_tecnico_serie;
    }

    public function setIdTecnicoSerie($id_tecnico_serie){
        $this->id_tecnico_serie = $id_tecnico_serie;
    }

    public function getIdPersonaTecnico(){
        return $this->id_persona_tecnico;
    }

    public function setIdPersonaTecnico($id_persona_tecnico){
        $this->id_persona_tecnico = $id_persona_tecnico;
    }

    public function getIdSerie(){
        return $this->id_serie;
    }

    public function setIdSerie($id_serie){
        $this->id_serie = $id_serie;
    }
    
    public function agregarSerieTecnico(){
        $database = Database::connect();
        $idTec = $this->getIdPersonaTecnico();
        $id = $this->getIdSerie();
        $sql = "INSERT INTO TECNICO_SERIE (ID_PERSONA_TECNICO_FK, ID_SERIE_FK) VALUES ($idTec,$id)";
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function eliminarTecnicoSerie(){
        $database = Database::connect();
        $idTec = $this->getIdPersonaTecnico();
        $sql = "DELETE FROM TECNICO_SERIE WHERE ID_PERSONA_TECNICO_FK =".$idTec;
        $respuesta = $database->query($sql);
        return $respuesta;
    }
}