<?php 

require_once 'config/database.php';

class Auditoria{

private $id_registro;
private $nombre_usuario;
private $rut_usuario;
private $fecha_registro;
private $hora_registro;
private $modulo;
private $accion;
private $descripcion;


public function getIdRegistro(){
  return $this->id_registro;
}
public function setIdRegistro($id_registro){
   $this->id_registro = $id_registro;
}
/*====================================*/

public function getNombreUsuario(){
    return $this->nombre_usuario;
}
public function setNombreUsuario($nombre_usuario){
    $this->nombre_usuario = $nombre_usuario;
}
/*====================================*/

public function getRutUsuario(){
    return $this->rut_usuario;
}
public function setRutUsuario($rut_usuario){
    $this->rut_usuario = $rut_usuario;
}
/*====================================*/

public function getFechaRegistro(){
    return $this->fecha_registro;
}
public function setFechaRegistro($fecha_registro){
    $this->fecha_registro = $fecha_registro;
}
/*====================================*/

public function getHoraRegistro(){
    return $this->hora_registro;
}
public function setHoraRegistro($hora_registro){
    $this->hora_registro = $hora_registro;
}
/*====================================*/

public function getModulo(){
    return $this->modulo;
}
public function setModulo($modulo){
    $this->modulo = $modulo;
}
/*====================================*/

public function getAccion(){
    return $this->accion;
}
public function setAccion($accion){
    $this->accion = $accion;
}
/*====================================*/

public function getDescripcion(){
    return $this->descripcion;
}
public function setDescripcion($descripcion){
    $this->descripcion = $descripcion;
}


public function InsertAuditoria(){
    $resultado = false;
    $database = Database::connect();
    $RUT = $this->getRutUsuario();
    $sql = "INSERT INTO AUDITORIA (NOMBRE_USUARIO,RUT_USUARIO,FECHA,HORA,MODULO,ACCION,DESCRIPCION) VALUES ('".$this->getNombreUsuario()."',$RUT,'".$this->getFechaRegistro()."','".$this->getHoraRegistro()."','".$this->getModulo()."','".$this->getAccion()."','".$this->getDescripcion()."')";
    $respuesta = $database->query($sql);

    if($respuesta){
        $resultado = true;
    }

    return $resultado;
}





}
