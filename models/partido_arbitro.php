<?php
require_once 'config/database.php';
class PartidoArbitro{

    private $id_partido_arbitro;
    private $rut_arbitro1; // apunta a la tabla persona aquellas personas que cuenten con perfil arbitro
    private $rut_arbitro2; // apunta a la tabla persona aquellas personas que cuenten con perfil arbitro puede ser null
    private $rut_arbitro3; // apunta a la tabla persona aquellas personas que cuenten con perfil arbitro puede ser null

    // Geter y Seter IdPartidoArbitro
    public function getIdPartidoArbitro(){
        return $this->id_partido_arbitro;
    }
    public function SetIdPartidoArbitro($id_partido_arbitro){
        $this->id_partido_arbitro = $id_partido_arbitro;
    }

    // Geter Y Seter RutArbitro1
    public function getRutArbitro1(){
        return $this->rut_arbitro1;
    }
    public function setRutArbitro1($rut_arbitro1){
        $this->rut_arbitro1 = $rut_arbitro1;
    }

    
    // Geter Y Seter RutArbitro2
    public function getRutArbitro2(){
        return $this->rut_arbitro2;
    }
    public function setRutArbitro2($rut_arbitro2){
        $this->rut_arbitro2 = $rut_arbitro2;
    }

    
    // Geter Y Seter RutArbitro3
    public function getRutArbitro3(){
        return $this->rut_arbitro3;
    }
    public function setRutArbitro3($rut_arbitro3){
        $this->rut_arbitro3 = $rut_arbitro3;
    }


}