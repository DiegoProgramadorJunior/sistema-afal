<?php 

class Comuna{
    private $id_comuna;
    private $nombre_comuna;

    public function getIdComuna(){
        return $this->id_comuna;
    }

    public function setIdComuna($id_comuna){
        $this->id_comuna = $id_comuna;
    }

    public function getNombreComuna(){
        return $this->nombre_comuna;
    }

    public function setNombreComuna($nombre_comuna){
        $this->nombre_comuna = $nombre_comuna;
    }

    public function obtenerComunasDeProvincia($idprovincia){
        $sql = "SELECT * FROM comuna WHERE ID_PROVINCIA_FK = $idprovincia";
        $respuesta = false;
        $database = Database::connect();

        $consulta = $database->query($sql);

        if($consulta){
            $respuesta = $consulta;
        }
        return $respuesta;
    }

}