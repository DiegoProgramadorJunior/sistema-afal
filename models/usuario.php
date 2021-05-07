<?php

require_once 'config/database.php';

class Usuario{

    private $id_usuario;
    private $nombre_usuario;
    private $clave_usuario;
    private $rut_usuario;
    private $estado_usuario;

    public function getIdUsuario(){
        return $this->id_usuario;
    }
    
    public function setIdUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function getNombreUsuario(){
        return $this->nombre_usuario;
    }

    public function setNombreUsuario($nombre_usuario)
    {
        $this->nombre_usuario = $nombre_usuario;
    }

    public function getClaveUsuario(){
        return $this->clave_usuario;
    }

    public function setClaveUsuario($clave_usuario)
    {
        $this->clave_usuario = $clave_usuario;
    }
    
    public function getRutUsuario(){
        return $this->rut_usuario;
    }

    public function setRutUsuario($rut_usuario)
    {
        $this->rut_usuario = $rut_usuario;
    }
    
    public function getEstadoUsuario(){
        return $this->estado_usuario;
    }

    public function setEstadoUsuario($estado_usuario)
    {
        $this->estado_usuario = $estado_usuario;
    }

    public function validarUsuario(){
         
        $result = false;
        $user = $this->nombre_usuario;
        $clave = $this->clave_usuario;

        $database = Database::connect();
        $sql = "SELECT * FROM usuarios inner join persona on (usuarios.RUT_PERSONA_FK = persona.RUT_PERSONA) where NOMBRE_USUARIO = '$user' AND usuarios.ID_TIPO_ESTADO_FK = 1";
        $login = $database->query($sql);
        if($login && $login->num_rows == 1)
        {
            $usuario = $login->fetch_object();
            $clave_obtenida = $usuario->CLAVE_USUARIO;         
 
            //verificar contraseña
            $Contraseña_verificada = password_verify($clave, $clave_obtenida);
            if($Contraseña_verificada){
                $result = $usuario;
            }
            
        }
   
        return $result;
       
    }

    public function obtenerUsuarios(){
        $resultado = false;
        $database = Database::connect();
        $sql = "SELECT * FROM USUARIOS
        INNER JOIN PERSONA ON (USUARIOS.RUT_PERSONA_FK = PERSONA.RUT_PERSONA)
        INNER JOIN TIPO_ESTADO ON (USUARIOS.ID_TIPO_ESTADO_FK = TIPO_ESTADO.ID_TIPO_ESTADO) WHERE ID_TIPO_ESTADO_FK = 1";
      
        $datosObtenidosUsuarios = $database->query($sql);
        if($datosObtenidosUsuarios){
           $resultado = $datosObtenidosUsuarios;

        }

        return $resultado;
    }
    public function obtenerUnUsuarios($idUsuario){
        $resultado = false;
        $database = Database::connect();
        $sql = "SELECT * FROM USUARIOS
        INNER JOIN PERSONA ON (USUARIOS.RUT_PERSONA_FK = PERSONA.RUT_PERSONA)
        INNER JOIN TIPO_ESTADO ON (USUARIOS.ID_TIPO_ESTADO_FK = TIPO_ESTADO.ID_TIPO_ESTADO)
        WHERE ID_USUARIO = $idUsuario";
      
        $datosObtenidosUsuarios = $database->query($sql);
        if($datosObtenidosUsuarios && $datosObtenidosUsuarios->num_rows > 0){
           $resultado = $datosObtenidosUsuarios->fetch_assoc();

        }

        return $resultado;
    }

    public function obtenerUnUsuarioEliminar($idUsuario){
        $resultado = false;
        $database = Database::connect();
        $sql = "SELECT * FROM USUARIOS WHERE RUT_PERSONA_FK = $idUsuario";

        $datosObtenidosUsuarios = $database->query($sql);
        if($datosObtenidosUsuarios && $datosObtenidosUsuarios->num_rows > 0){
           $resultado = $datosObtenidosUsuarios->fetch_assoc();

        }

        return $resultado;
    }

    public function crearUsuario(){
        $resultado = false;
        $database = Database::connect();
        $Estado = 1;
        $sql = "INSERT INTO usuarios (NOMBRE_USUARIO,CLAVE_USUARIO,RUT_PERSONA_FK,ID_TIPO_ESTADO_FK) VALUES('".$this->getNombreUsuario()."','".$this->getClaveUsuario()."','".$this->getRutUsuario()."',$Estado)";
        $respuesta = $database->query($sql);

        if($respuesta){
            $resultado = true;
        }

        return $resultado;
    }

    
    public function editarUsuario(){
        $resultado = false;
        $database = Database::connect();

        $sql = "UPDATE usuarios SET NOMBRE_USUARIO = '".$this->getNombreUsuario()."', CLAVE_USUARIO = '".$this->getClaveUsuario()."', RUT_PERSONA_FK = ".$this->getRutUsuario()." WHERE ID_USUARIO =".$this->getIdUsuario();
        $respuesta = $database->query($sql);

        if($respuesta){
            $resultado = true;
        }

        return $resultado;
    
    }

    public function deshabilitarUsuario(){
        $resultado = false;
        $database = Database::connect();
        $idestado = $this->getEstadoUsuario();
        $iduser = $this->getIdUsuario();
        $sql = "UPDATE usuarios SET ID_TIPO_ESTADO_FK = $idestado WHERE ID_USUARIO = $iduser ";
        $respuesta = $database->query($sql);

        if($respuesta){
            $resultado = true;
        }

        return $sql;
    }
    
    public function deshabilitarUsuarioConRut(){
        $resultado = false;
        $database = Database::connect();
        $rut = $this->getRutUsuario();
        $sql = "UPDATE usuarios SET ID_TIPO_ESTADO_FK = 2 WHERE RUT_PERSONA_FK = $rut ";
        $respuesta = $database->query($sql);

        if($respuesta){
            $resultado = $respuesta;
        }

        return $resultado;
    }
    
    public function habilitarUsuarioConRut(){
        $resultado = false;
        $database = Database::connect();
        $rut = $this->getRutUsuario();
        $sql = "UPDATE usuarios SET ID_TIPO_ESTADO_FK = 1 WHERE RUT_PERSONA_FK = $rut ";
        $respuesta = $database->query($sql);

        if($respuesta){
            $resultado = $respuesta;
        }

        return $resultado;
    }

    public function obtenerUnUsuariosConRut(){
        $resultado = false;
        $database = Database::connect();
        $sql = "SELECT * FROM USUARIOS WHERE RUT_PERSONA_FK =".$this->getRutUsuario();
      
        $datosObtenidosUsuarios = $database->query($sql);
        if($datosObtenidosUsuarios && $datosObtenidosUsuarios->num_rows > 0){
           $resultado = $datosObtenidosUsuarios->fetch_assoc();

        }

        return $resultado;
    }

}

?>