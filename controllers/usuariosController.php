<?php
require_once 'models/usuario.php';
require_once 'models/persona.php';
require_once 'models/tipo_estado.php';
require_once 'config/parameters.php';
require_once 'models/auditoria.php';
class usuariosController{

    public function index(){   
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            $usuario = new Usuario();
            $todosLosUsuarios = $usuario->obtenerUsuarios();
            include_once 'views/usuarios/usuarios.php';
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
        
    }
    public function gestionEditar(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            if(!isset($_GET['in'])){
                $_SESSION['mensajeError'] = true;
            }else{
                unset($_SESSION['mensajeError']);
            }
            $usuario = new Usuario();
            $persona = new Persona();
            $estado = new Tipoestado();
            $todosLosEstados = $estado->obtenerEstados();
            $todasLasPersonas = $persona->obtenerPersona();  
            $usuarioSeleccionado = $usuario->obtenerUnUsuarios($_GET['id']);
            include_once 'views/usuarios/gestionUsuarios.php';
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }
    public function editar(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            $usuario = new Usuario();
            $auditoria = new Auditoria();  

            echo $usuario->setIdUsuario($_POST['idUsuario']);
            echo $usuario->setNombreUsuario($_POST['nombreUsuario']);
            echo $ClaveEncriptada = password_hash($_POST['claveUsuario'], PASSWORD_DEFAULT);
            echo $usuario->setClaveUsuario($ClaveEncriptada);
            echo $usuario->setRutUsuario($_POST['rutPersona']);
           // echo $usuario->setEstadoUsuario($_POST['tipoestado']);
             
            $respuesta = $usuario->editarUsuario();

              /*=============INSERTAR TABLA AUDITORIA (ACCION UPDATE)=========*/       
                date_default_timezone_set('America/Santiago');
                $fechaActual = date('Y-m-d');
                $horaActual = date("H:i:s");

                $auditoria->setNombreUsuario($_POST['NombreUsuario']);
                $auditoria->setRutUsuario($_POST['rutUsuario']);
                $auditoria->setFechaRegistro($fechaActual);
                $auditoria->setHoraRegistro($horaActual);
                $auditoria->setModulo('Usuario');
                $auditoria->setAccion('MODIFICAR');
                $auditoria->setDescripcion('Se a modificado el usuario '.$_POST['nombreUsuario'].', rut: '.$_POST['rutPersona']);
                $resultado = $auditoria->InsertAuditoria();         
              /*==============================================================*/  


            if($respuesta){
                header('location:'.base_url.'usuarios/index');
                exit;
            }else{
                header('location:'.base_url.'usuarios/gestionEditar&id='.$_GET['id']);
               
            }
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }
}