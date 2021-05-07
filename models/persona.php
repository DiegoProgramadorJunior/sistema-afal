<?php
require_once 'config/database.php';
class Persona{
    
    private $rut_persona;
    private $dv_persona;
    private $nombre_1;
    private $nombre_2;
    private $apellido_1;
    private $apellido_2;
    private $fecha_nacimiento;
    private $numero_telefono;
    private $correo;
    private $id_direccion;
    private $id_asociacion;
    private $id_perfil;
    private $id_tipo_estado;

        public function getRutPersona(){
            return $this->rut_persona;
        }
        public function setRutPersona($rut_persona){
            $this->rut_persona = $rut_persona;
        }
        public function getDvPersona(){
            return $this->dv_persona;
        }
        public function setDvpersona($dv_persona){
            $this->dv_persona = $dv_persona;
        }     
        public function getNombre1(){
            return $this->nombre_1;
        }
        public function setNombre1($nombre_1){
            $this->nombre_1 = $nombre_1;
        }
        public function getNombre2(){
            return $this->nombre_2;
        }
        public function setNombre2($nombre_2){
            $this->nombre_2 = $nombre_2;
        }
        public function getApellido1(){
            return $this->apellido_1;
        }
        public function setApellido1($apellido_1){
            $this->apellido_1 = $apellido_1;   
        }
        public function getApellido2(){
            return $this->apellido_2;
        }
        public function setApellido2($apellido_2){
            $this->apellido_2 = $apellido_2;   
        }
        public function getFechaNacimiento(){
            return $this->fecha_nacimiento;
        }
        public function setFechaNacimiento($fecha_nacimiento){
            $this->fecha_nacimiento = $fecha_nacimiento;
        }
        public function getNumeroTelefono(){
            return $this->numero_telefono;
        }
        public function setNumeroTelefono($numero_telefono){
            $this->numero_telefono = $numero_telefono;
        }
        public function getCorreo(){
            return $this->correo;
        }
        public function setCorreo($correo){
            $this->correo = $correo;
        }
        public function getIdDireccion(){
            return $this->id_direccion;
        }
        public function setIdDireccion($id_direccion){
            $this->id_direccion = $id_direccion;
        }
        public function getIdAsociacion(){
            return $this->id_asociacion;
        }
        public function setIdAsociacion($id_asociacion){
            $this->id_asociacion = $id_asociacion;
        }
        public function getIdPerfil(){
            return $this->id_perfil;    
        }
        public function setIdPerfil($id_perfil){
            $this->id_perfil = $id_perfil;
        }
        public function getIdTipoEstado(){
            return $this->id_tipo_estado;
        }
        public function setIdTipoEstado($id_tipo_estado){
            $this->id_tipo_estado = $id_tipo_estado;
        }


        public function obtenerPersona(){
            $sql = "SELECT * FROM PERSONA
            INNER JOIN DIRECCION ON (PERSONA.ID_DIRECCION_FK = DIRECCION.ID_DIRECCION)
            inner join COMUNA on (DIRECCION.ID_COMUNA_FK = COMUNA.ID_COMUNA)
            INNER JOIN ASOCIACION ON (PERSONA.ID_ASOCIACION_FK = ASOCIACION.ID_ASOCIACION)
            INNER JOIN PERFIL ON (PERSONA.ID_PERFIL_FK = PERFIL.ID_PERFIL)
            INNER JOIN TIPO_ESTADO ON (PERSONA.ID_TIPO_ESTADO_FK_PERSONA = TIPO_ESTADO.ID_TIPO_ESTADO) WHERE ID_TIPO_ESTADO_FK_PERSONA = 1";
                        
            $database = Database::connect();
            $datosObtenidosPersona = $database->query($sql);
            return $datosObtenidosPersona;

        }
    

        public function obtenerUnPersona(){            
            $resultado = false;
            $database = Database::connect();
            $rut = $this->getRutPersona();
            $sql = "SELECT * FROM PERSONA
            INNER JOIN DIRECCION ON (PERSONA.ID_DIRECCION_FK = DIRECCION.ID_DIRECCION) WHERE RUT_PERSONA = $rut ";          
            $datosObtenidosunaPersona = $database->query($sql);            
            if($datosObtenidosunaPersona && $datosObtenidosunaPersona->num_rows > 0){
               $resultado = $datosObtenidosunaPersona->fetch_assoc();
    
            }
            return $resultado;
        }    

        public function ingresarPersona(){            
            $database = Database::connect();

            $resultado = false;

            $rut = $this->getRutPersona();
            $dv = $this->getDvPersona();
            $nom_1 = $this->getNombre1();
            $nom_2 = $this->getNombre2();
            $ape_1 = $this->getApellido1();
            $ape_2 = $this->getApellido2();
            $fechaN = $this->getFechaNacimiento();
            $num_tel = $this->getNumeroTelefono();
            $correo = $this->getCorreo();
            $direc = $this->getIdDireccion();
            $asoc = $this->getIdAsociacion();
            $perf = $this->getIdPerfil();
            $t_estado = 1;                       

            $sql = "INSERT INTO persona (RUT_PERSONA,DV,NOMBRE_1,NOMBRE_2,APELLIDO_1,APELLIDO_2,FECHA_NACIMIENTO,NUMERO_TELEFONO_PERSONA,CORREO_ELECTRONICO,ID_DIRECCION_FK,ID_ASOCIACION_FK,ID_PERFIL_FK,ID_TIPO_ESTADO_FK_PERSONA) 
            VALUES ($rut,'$dv','$nom_1','$nom_2','$ape_1','$ape_2','$fechaN',$num_tel,'$correo',$direc,$asoc,$perf,$t_estado)";
            $respuesta = $database->query($sql);
            if($respuesta){
                $resultado = $respuesta;
            }
            return  $resultado;
        }

        public function editarPersona(){
            $database = Database::connect();

            $resultado = false;

            $rut = $this->getRutPersona();
            $dv = $this->getDvPersona();
            $nom_1 = $this->getNombre1();
            $nom_2 = $this->getNombre2();
            $ape_1 = $this->getApellido1();
            $ape_2 = $this->getApellido2();
            $fechaN = $this->getFechaNacimiento();
            $num_tel = $this->getNumeroTelefono();
            $correo = $this->getCorreo();
            $direc = $this->getIdDireccion();
            $asoc = $this->getIdAsociacion();
            $perf = $this->getIdPerfil();
            $t_estado = $this->getIdTipoEstado();    
            
            $sql = "UPDATE persona SET RUT_PERSONA = $rut,DV = '$dv',NOMBRE_1 ='$nom_1',NOMBRE_2 = '$nom_2',APELLIDO_1 = '$ape_1',APELLIDO_2 = '$ape_2',FECHA_NACIMIENTO = '$fechaN',NUMERO_TELEFONO_PERSONA = $num_tel,CORREO_ELECTRONICO = '$correo ',ID_DIRECCION_FK = $direc,ID_ASOCIACION_FK = $asoc,ID_PERFIL_FK =   $perf ,ID_TIPO_ESTADO_FK_PERSONA = $t_estado WHERE RUT_PERSONA = $rut";
            
            $respuesta = $database->query($sql);
            if($respuesta){
                $resultado = $respuesta;
            }
            return  $resultado;
        }
        
        public function eliminarPersona(){
            $resultado = false;
            $database = Database::connect();
            $rut = $this->getRutPersona();
            $sql = "UPDATE persona SET ID_TIPO_ESTADO_FK_PERSONA = 2 WHERE RUT_PERSONA = $rut ";
            $respuesta = $database->query($sql);

            if($respuesta){
                $resultado = $respuesta;
            }

            return $resultado;
        }

        public function habilitarPersona(){
            $resultado = false;
            $database = Database::connect();
            $rut = $this->getRutPersona();
            $sql = "UPDATE persona SET ID_TIPO_ESTADO_FK_PERSONA = 1 WHERE RUT_PERSONA = $rut ";        
            $respuesta = $database->query($sql);

            if($respuesta){
                $resultado = $respuesta;
            }

            return $resultado;
        }

        public function obtenerArbitros(){
            $resultado = false;
            $database = Database::connect();
            $sql = "SELECT * FROM persona INNER JOIN direccion ON persona.ID_DIRECCION_FK = direccion.ID_DIRECCION INNER JOIN comuna ON direccion.ID_COMUNA_FK = comuna.ID_COMUNA INNER JOIN asociacion ON persona.ID_ASOCIACION_FK = asociacion.ID_ASOCIACION WHERE ID_PERFIL_FK = 6";       
            $respuesta = $database->query($sql);

            if($respuesta){
                $resultado = $respuesta;
            }

            return $resultado;
        }
        
        public function eliminarArbitro(){
            $database = Database::connect();
            $sql = "UPDATE persona SET ID_PERFIL_FK ="." 7 ".", ID_TIPO_ESTADO_FK_PERSONA ="." 2 "."WHERE RUT_PERSONA = ".$this->getRutPersona();       
            $respuesta = $database->query($sql);
            return $sql;
        }
        

        public function obtenerTurnos(){
            $resultado = false;
            $database = Database::connect();
            $sql = "SELECT * FROM persona INNER JOIN direccion ON persona.ID_DIRECCION_FK = direccion.ID_DIRECCION INNER JOIN comuna ON direccion.ID_COMUNA_FK = comuna.ID_COMUNA INNER JOIN asociacion ON persona.ID_ASOCIACION_FK = asociacion.ID_ASOCIACION WHERE ID_PERFIL_FK = 3";       
            $respuesta = $database->query($sql);

            if($respuesta){
                $resultado = $respuesta;
            }

            return $resultado;
        }

        public function obtenerRutPersonas(){
            $resultado = false;
            $database = Database::connect();
            $rut = $this->getRutPersona();
            $sql = "SELECT * FROM persona WHERE RUT_PERSONA = $rut";       
            $datosobtenido = $database->query($sql);
            if($datosobtenido && $datosobtenido->num_rows > 0){
                $resultado = $datosobtenido->fetch_assoc();
         
            }
            return $resultado;
        }
}     