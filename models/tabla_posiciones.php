<?php

require_once 'config/database.php';

class Tabla_Posiciones{

    private $id_tabla_posiciones;
    private $pts;
    private $pj;
    private $pg;
    private $pe;
    private $pp;
    private $gf;
    private $gc;
    private $dif;
    private $id_club_fk;
    private $id_campeonato_fk;
    /*========================================*/
    public function getidTablaPosiciones(){
        return $this->id_tabla_posiciones;
    }
    public function setidTablaPosiciones($id_tabla_posiciones){
        $this->id_tabla_posiciones = $id_tabla_posiciones;
    }
    /*========================================*/
    public function getPTS(){
        return $this->pts;
    }
    public function setPTS($pts){
        $this->pts = $pts;
    }
    
    /*========================================*/
    public function getPJ(){
        return $this->pj;
    }
    public function setPJ($pj){
        $this->pj = $pj;
    }
    
    /*========================================*/
    public function getPG(){
        return $this->pg;
    }
    public function setPG($pg){
        $this->pg = $pg;
    }
    /*========================================*/
    public function getPE(){
        return $this->pe;
    }
    public function setPE($pe){
        $this->pe = $pe;
    }
    /*========================================*/
    public function getPP(){
        return $this->pp;
    }
    public function setPP($pp){
        $this->pp = $pp;
    }
    /*========================================*/
    public function getGF(){
        return $this->gf;
    }
    public function setGF($gf){
        $this->gf = $gf;
    }
    /*========================================*/
    public function getGC(){
        return $this->gc;
    }
    public function setGC($gc){
        $this->gc = $gc;
    }
    /*========================================*/
    public function getDIF(){
        return $this->dif;
    }
    public function setDIF($dif){
        $this->dif = $dif;
    }
    /*========================================*/
    public function getidClubFk(){
        return $this->id_club_fk;
    }
    public function setidClubFk($id_club_fk){
        $this->id_club_fk = $id_club_fk;
    }
    /*========================================*/
    public function getidCampeonatoFk(){
        return $this->id_campeonato_fk;
    }
    public function setidCampeonatoFk($id_campeonato_fk){
        $this->id_campeonato_fk = $id_campeonato_fk;
    }
    /*========================================*/

    public function IngresarTablaPosiciones(){
     $resultado = false;  
     $database = Database::connect();
     $idclub = $this->getidClubFk();
     $idcampeonato = $this->getidCampeonatoFk();
     $sql = "INSERT INTO tabla_posiciones(PTS,PJ,PG,PE,PP,GF,GC,DIF,ID_CLUB_FK,ID_CAMPEONATO_FK)
     VALUES (default,default,default,default,default,default,default,default,$idclub,$idcampeonato)";
     $respuesta = $database->query($sql);
        if($respuesta){
            $resultado = $respuesta;
        }
        return  $resultado;
    }   

    public function BorrarDeTablaPosiciones(){
        $database = Database::connect();
        $sql = "DELETE FROM tabla_posiciones WHERE ID_CLUB_FK = ".$this->getidClubFk(); 
        $respuesta = $database->query($sql);
        return $sql;
    }

    public function obtenerDatosEquipo(){
        $database = Database::connect();
        $sql = 'SELECT * FROM tabla_posiciones WHERE ID_CLUB_FK = '.$this->getidClubFk().' AND ID_CAMPEONATO_FK='.$this->getidCampeonatoFk(); 
        $respuesta = $database->query($sql);
        return $respuesta->fetch_object();
    }

    public function actualizarTabla(){
        $database = Database::connect();
        $sql = 'UPDATE tabla_posiciones SET PTS ='.$this->getPTS().', PJ ='.$this->getPJ().', PG = '.$this->getPG().', PE = '.$this->getPE().', PP ='.$this->getPP().', GF ='.$this->getGF().', GC ='.$this->getGC().', DIF ='.$this->getDIF().' WHERE ID_CLUB_FK ='.$this->getidClubFk().' AND ID_CAMPEONATO_FK='.$this->getidCampeonatoFk(); 
        $respuesta = $database->query($sql);
        return $respuesta;
    }

    public function obtenerTablaCampeonato(){
        $database = Database::connect();
        $sql = 'SELECT * FROM tabla_posiciones INNER JOIN club ON tabla_posiciones.ID_CLUB_FK = club.ID_CLUB WHERE ID_CAMPEONATO_FK='.$this->getidCampeonatoFk().' ORDER BY PTS DESC'; 
        $respuesta = $database->query($sql);
        return $respuesta;
    }
    
}