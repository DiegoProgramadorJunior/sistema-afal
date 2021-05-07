<?php 

class Direccion{
    private $id_direccion;
    private $calle_pasaje;
    private $id_comuna_fk;
    private $id_provincia_fk;
    private $id_region_fk;

    public function getIdDireccion(){
        return $this->id_direccion;
    }

    public function setIdDireccion($id_direccion){
        $this->id_direccion = $id_direccion;
    }

    public function getCallePasaje(){
        return $this->calle_pasaje;
    }
    public function setCallePasaje($calle_pasaje){
        $this->calle_pasaje = $calle_pasaje;
    }

    public function getIdComuna(){
        return $this->id_comuna_fk;
    }
    public function setComuna($id_comuna_fk){
        $this->id_comuna_fk = $id_comuna_fk;
    }

    public function getIdProvincia(){
        return $this->id_provincia_fk;
    }
    public function setProvincia($id_provincia_fk){
        $this->id_provincia_fk = $id_provincia_fk;
    }

    public function getIdRegion(){
        return $this->id_region_fk;
    }
    public function setRegion($id_region_fk){
        $this->id_region_fk = $id_region_fk;
    }

    public function verificarDireccion(){
        $database = Database::connect();
        $sql = 'SELECT * FROM direccion WHERE CALLE_PASAJE ="'.$this->getCallePasaje().'" AND ID_COMUNA_FK ='.$this->getIdComuna().' AND ID_PROVINCIA_FK ='.$this->getIdProvincia().' AND ID_REGION_FK ='.$this->getIdRegion();
        $respuesta = $database->query($sql);
        return mysqli_num_rows($respuesta);
    }

    public function obtenerDireccion(){
        $database = Database::connect();
        $resultado = false;
        $sql = 'SELECT * FROM direccion WHERE CALLE_PASAJE ="'.$this->getCallePasaje().'" AND ID_COMUNA_FK ='.$this->getIdComuna().' AND ID_PROVINCIA_FK ='.$this->getIdProvincia().' AND ID_REGION_FK ='.$this->getIdRegion();
        $respuesta = $database->query($sql);
        
        if($respuesta && $respuesta->num_rows > 0){
            $resultado = $respuesta->fetch_assoc();
        }
        return $resultado;
    }

    public function ingresarDireccion(){
        $database = Database::connect();
        $sql = 'INSERT INTO direccion (CALLE_PASAJE,ID_COMUNA_FK,ID_PROVINCIA_FK,ID_REGION_FK) VALUES ("'.$this->getCallePasaje().'",'.$this->getIdComuna().','.$this->getIdProvincia().','.$this->getIdRegion().')';
        $respuesta = $database->query($sql);
        return $respuesta;
    }
}