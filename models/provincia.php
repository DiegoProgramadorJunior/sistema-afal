<?php 

class Provincia{
    private $id_provincia;
    private $nombre_provincia;

    public function getIdProvincia(){
        return $this->id_provincia;
    }

    public function setIdProvincia($id_provincia){
        $this->id_comuna = $id_provincia;
    }

    public function getNombreProvincia(){
        return $this->nombre_provincia;
    }

    public function setNombreProvincia($nombre_provincia){
        $this->nombre_provincia = $nombre_provincia;
    }

    public function obtenerProvinciasDeRegion($idregion){
        $sql = "SELECT * FROM provincia WHERE ID_REGION_FK = $idregion";
        $respuesta = false;
        $database = Database::connect();

        $consulta = $database->query($sql);

        if($consulta){
            $respuesta = $consulta;
        }
        return $respuesta;
    }
}