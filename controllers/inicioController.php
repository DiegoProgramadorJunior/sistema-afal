<?php

require_once 'models/usuario.php';
require_once 'config/parameters.php';
require_once 'models/auditoria.php';
class inicioController{

    public function index(){
        require_once 'views/inicio/inicio.php';
    }

    public function iniciarsesion(){
            
        if(isset($_POST)){
            $usuario = new Usuario();
            $auditoria = new Auditoria();    

            $usuario->setNombreUsuario($_POST['usuario']);
            $usuario->setClaveUsuario($_POST['clave']);
            $identity = $usuario->validarUsuario();

            if(!$identity == false){
                $datos = (array) $identity;
                $nombreUsuario = $datos['NOMBRE_1'].' '.$datos['NOMBRE_2'].' '.$datos['APELLIDO_1'].' '.$datos['APELLIDO_2'];
                $rut = $datos['RUT_PERSONA'];   
                $perfil = $datos['ID_PERFIL_FK'];
                $nombrePerfil = '';
                
                if($perfil == 1){
    
                    $nombrePerfil = 'dirigente';
    
                }elseif($perfil == 2){
    
                    $nombrePerfil = 'tecnico';
    
                }elseif($perfil == 3){
    
                    $nombrePerfil = 'turno';
                }elseif($perfil == 4){
    
                    $nombrePerfil = 'jugador y tecnico';
                }

                  /*=============INSERTAR TABLA AUDITORIA (ACCION INSERT)=========*/       
                  date_default_timezone_set('America/Santiago');
                  $fechaActual = date('Y-m-d');
                  $horaActual = date("H:i:s");
      
                  $auditoria->setNombreUsuario($nombreUsuario);
                  $auditoria->setRutUsuario($rut);
                  $auditoria->setFechaRegistro($fechaActual);
                  $auditoria->setHoraRegistro($horaActual);
                  $auditoria->setModulo('Login');
                  $auditoria->setAccion('ACCESO AL SISTEMA');
                  $auditoria->setDescripcion('A entrado al sistema con perfil de '.$nombrePerfil);
                  $auditoria->InsertAuditoria();
                               
               /*==============================================================*/ 
                if($identity && is_object($identity)){
                 $_SESSION['identity'] = $identity;
                 $_SESSION['NombreUsuario'] = $nombreUsuario;
                 $_SESSION['RutUsuario'] = $rut;
                 header("Location:".base_url);
                 }else{
                           
                }
            }else{
              echo '<div class="container text-center mt-5">'
              .'<h1>No se han encontrado datos</h1>'.
              '<h2>Error 400</h3>'.
              '<a class="btn btn-danger" href="index">Volver Atras</a>'.
              '</div>';

            }                                             
        }                                    
    }

    public function cerrarsesion(){
        if(isset($_SESSION['identity'])){
             unset($_SESSION['identity']);
        }
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
       }
       header('location:'.base_url);
    }

}

?>