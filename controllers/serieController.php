<?php
require_once 'models/serie.php';
require_once 'models/auditoria.php';

class serieController{

    public function index(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            $series = new Serie();
            $todasLasSeries = $series->obtenerSeries();
            require_once 'views/serie/serie.php';
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function crearserie(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            require_once 'views/serie/gestionSerie.php';
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function editarserie(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            $series = new Serie();
            $series->setIdSerie($_GET['idserie']);
            $serieSeleccionada = $series->obtenerUnaSerie();
            require_once 'views/serie/gestionSerie.php';
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function crear(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            $series = new Serie();
            $auditoria = new Auditoria();     

            $series->setNombreSerie($_POST['nombreSerie']);
            $respuesta = $series->crearSerie();

            /*=============INSERTAR TABLA AUDITORIA (ACCION INSERT)=========*/       
            date_default_timezone_set('America/Santiago');
            $fechaActual = date('Y-m-d');
            $horaActual = date("H:i:s");

            $auditoria->setNombreUsuario($_POST['NombreUsuario']);
            $auditoria->setRutUsuario($_POST['rutUsuario']);
            $auditoria->setFechaRegistro($fechaActual);
            $auditoria->setHoraRegistro($horaActual);
            $auditoria->setModulo('Serie');
            $auditoria->setAccion('INSERTAR');
            $auditoria->setDescripcion('Se a registrado la serie '.$_POST['nombreSerie']);
            $auditoria->InsertAuditoria();
                        
            /*==============================================================*/ 

            if($respuesta>0){
                header('location:'.base_url.'serie/index');
            }else{
                header('location:'.base_url.'serie/crear&in=crear&error=crear');
            }
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function editar(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            $series = new Serie();
            $auditoria = new Auditoria();  

            $series->setNombreSerie($_POST['nombreSerie']);
            $series->setIdSerie($_GET['idserie']);
            $respuesta= $series->editarSerie();

            /*=============INSERTAR TABLA AUDITORIA (ACCION INSERT)=========*/       
            date_default_timezone_set('America/Santiago');
            $fechaActual = date('Y-m-d');
            $horaActual = date("H:i:s");

            $auditoria->setNombreUsuario($_POST['NombreUsuario']);
            $auditoria->setRutUsuario($_POST['rutUsuario']);
            $auditoria->setFechaRegistro($fechaActual);
            $auditoria->setHoraRegistro($horaActual);
            $auditoria->setModulo('Serie');
            $auditoria->setAccion('MODIFICAR');
            $auditoria->setDescripcion('Se a modificado el '.$_POST['nombreSerie']);
            $auditoria->InsertAuditoria();
                        
            /*==============================================================*/ 

            if($respuesta>0){
                header('location:'.base_url.'serie/index');
            }else{
                header('location:'.base_url.'serie/editar&in=crear&error=editar');
            }
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function eliminar(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            $series = new Serie();
            $auditoria = new Auditoria();  
            $series->setIdSerie($_GET['idserie']);
            $respuesta = $series->eliminarSerie();
            /*=============INSERTAR TABLA AUDITORIA (ACCION DELETE)=========*/       
            date_default_timezone_set('America/Santiago');
            $fechaActual = date('Y-m-d');
            $horaActual = date("H:i:s");

        
            $auditoria->setNombreUsuario($_GET['user']);
            $auditoria->setRutUsuario($_GET['rutuser']);
            $auditoria->setFechaRegistro($fechaActual);
            $auditoria->setHoraRegistro($horaActual);
            $auditoria->setModulo('Serie');
            $auditoria->setAccion('ELIMINAR');
            $auditoria->setDescripcion('Se a eliminado la serie de id '.$_GET['idserie']);
            $resultado = $auditoria->InsertAuditoria();
                        
            /*==============================================================*/ 

            if($respuesta>0){
                header('location:'.base_url.'serie/index');
            }else{
                header('location:'.base_url.'serie/index&&errordelete=delete');
            }
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }
}