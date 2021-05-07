<?php
require_once 'config/parameters.php';
require_once 'models/campeonato.php';
require_once 'models/asociacion.php';
require_once 'models/serie.php';
require_once 'models/estado_campeonato.php';
require_once 'models/campeonatos_equipos.php';
require_once 'models/auditoria.php';
require_once 'models/tabla_posiciones.php';

class campeonatosController{

    public function index(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            $campeonato = new Campeonato();
            $todosLosCampeonatos = $campeonato->obtenerCampeonatos();
            require_once 'views/campeonatos/campeonatos.php';
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function gestionCrear(){
        unset($_SESSION['mensajErrorFecha']);

        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            
            if(isset($_GET['error']) && $_GET['error']=="fechainiciocampeonato"){                
                unset($_SESSION['mensajeError']);
            }elseif(isset($_GET['error'])){
                $_SESSION['mensajeError'] = true;
            }else{
                unset($_SESSION['mensajeError']);
            }
            
            $asociacion = new Asociacion();
            $serie = new Serie();
            $todasLasAsociaciones = $asociacion->obtenerAsociaciones();
            $todasLasSeries = $serie->obtenerSeries();
            require_once 'views/campeonatos/gestionCampeonatos.php';
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function crear(){
        $identity = $_SESSION['identity'];

      

        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            $campeonato = new Campeonato();
            $auditoria = new Auditoria();     

            date_default_timezone_set('America/Santiago');
            $fechaActual = date('Y-m-d');
            $horaActual = date("H:i:s");    

            if($_POST['fechaInicioCampeonato'] >= $fechaActual){
                echo 'la fecha de incio de campeonato es mayor a la actual';

                $campeonato->setNombreCampeonato($_POST['nombreCampeonato']);
                $campeonato->setFechaInicio($_POST['fechaInicioCampeonato']);
                $campeonato->setIdAsociacion($_POST['nombreAsociacion']);
                $campeonato->setIdSerie($_POST['nombreSerie']);

                $respuesta = $campeonato->crearCampeonato();    
                /*=============INSERTAR TABLA AUDITORIA (ACCION INSERT)=========*/                     
                    $auditoria->setNombreUsuario($_POST['NombreUsuario']);
                    $auditoria->setRutUsuario($_POST['rutUsuario']);
                    $auditoria->setFechaRegistro($fechaActual);
                    $auditoria->setHoraRegistro($horaActual);
                    $auditoria->setModulo('Campeonato');
                    $auditoria->setAccion('INSERTAR');
                    $auditoria->setDescripcion('Se a registrado el '.$_POST['nombreCampeonato'].' con fecha de inicio: '.$_POST['fechaInicioCampeonato']);
                    $auditoria->InsertAuditoria();                       
               /*==============================================================*/ 
               if($respuesta){
                    header('location:'.base_url.'campeonatos/index');
                    exit;
                }else{
                    header('location:'.base_url.'campeonatos/gestionCrear');
                }
            }else{
                echo 'la fecha de incio de campeonato es menor a la actual';
               
                header('location:'.base_url.'campeonatos/gestionCrear&error=fechainiciocampeonato');
            }                                              
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
            $asociacion = new Asociacion();
            $serie = new Serie();
            $estadoCampeonato = new EstadoCampeonato();
            $campeonato = new Campeonato();
            $todasLasAsociaciones = $asociacion->obtenerAsociaciones();
            $todasLasSeries = $serie->obtenerSeries();
            $todosLosEstados = $estadoCampeonato->obtenerEstadosDeCampeonatos();
            $campeonato->setIdCampeonato($_GET['id']);
            $campeonatoSeleccionado = $campeonato->obtenerUnCampeonato();
            require_once 'views/campeonatos/gestionCampeonatos.php';
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function editar(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            $campeonato = new Campeonato();
            $auditoria = new Auditoria();  

            $campeonato->setIdCampeonato($_POST['idCampeonato']);
            $campeonato->setNombreCampeonato($_POST['nombreCampeonato']);
            $campeonato->setFechaInicio($_POST['fechaInicioCampeonato']);
            $campeonato->setIdAsociacion($_POST['nombreAsociacion']);
            $campeonato->setIdSerie($_POST['nombreSerie']);
            $campeonato->setIdEstadoCampeonato($_POST['estadoCampeonato']);
            
            $nombreEstado = '';
            if($_POST['estadoCampeonato'] == 1){
                $nombreEstado = 'Creacion';
            }elseif($_POST['estadoCampeonato'] == 2){
                $nombreEstado = 'Vigente';
            }elseif($_POST['estadoCampeonato'] == 3){
                $nombreEstado = 'Terminado';
            }
            $respuesta = $campeonato->editarCampeonato();

                /*=============INSERTAR TABLA AUDITORIA (ACCION INSERT)=========*/       
                date_default_timezone_set('America/Santiago');
                $fechaActual = date('Y-m-d');
                $horaActual = date("H:i:s");
    
                $auditoria->setNombreUsuario($_POST['NombreUsuario']);
                $auditoria->setRutUsuario($_POST['rutUsuario']);
                $auditoria->setFechaRegistro($fechaActual);
                $auditoria->setHoraRegistro($horaActual);
                $auditoria->setModulo('Campeonato');
                $auditoria->setAccion('MODIFICAR');
                $auditoria->setDescripcion('Se a modificado el '.$_POST['nombreCampeonato'].' con fecha de inicio: '.$_POST['fechaInicioCampeonato'].' y cuenta con un estado de campeonato en '.$nombreEstado );
                $auditoria->InsertAuditoria();
                             
                /*==============================================================*/ 


            if($respuesta){
                header('location:'.base_url.'campeonatos/index');
                exit;
            }else{
                header('location:'.base_url.'campeonatos/gestionEditar&id='.$_GET['id']);
            }
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function eliminar(){
        $campeonato = new Campeonato();
        $auditoria = new Auditoria();  

        $campeonato->setIdCampeonato($_GET['idcampeonato']);
        $campeonato->setIdEstadoCampeonato($_GET['estadocampeonato']);
        $respuesta = $campeonato->deshabilitarCampeonato();

        $datos = $campeonato->obtenerUnCampeonato();
        $arrayDatos = (array) $datos;        

        $nombreCampeonato = $arrayDatos['NOMBRE_CAMPEONATO'];
        $fechaCampeonato = $arrayDatos['FECHA_INICIO'];
        $nombreEstadoCampeonato = $arrayDatos['NOMBRE_ESTADO_CAMPEONATO'];

           /*=============INSERTAR TABLA AUDITORIA (ACCION DELETE)=========*/       
           date_default_timezone_set('America/Santiago');
           $fechaActual = date('Y-m-d');
           $horaActual = date("H:i:s");

         
           $auditoria->setNombreUsuario($_GET['user']);
           $auditoria->setRutUsuario($_GET['rutuser']);
           $auditoria->setFechaRegistro($fechaActual);
           $auditoria->setHoraRegistro($horaActual);
           $auditoria->setModulo('Campeonato');
           $auditoria->setAccion('ELIMINAR');
           $auditoria->setDescripcion('Se a deshabilitado el '.$nombreCampeonato.' con fecha de inicio: '.$fechaCampeonato.' y cuenta con un estado de campeonato en '.$nombreEstadoCampeonato );
           $resultado = $auditoria->InsertAuditoria();
                        
           /*==============================================================*/ 
        if($respuesta){
           
           header('location:'.base_url.'campeonatos/index');

        }else{
           
        } 
        
        
    }

    public function gestionarParticipantes(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            $clubesParticipantes = new ClubesParticipantes();
            $clubesParticipantes->setIdCampeonato($_GET['idcampeonato']);
            $participantes = $clubesParticipantes->obtenerClubesParticipantes();
            $clubesNoInscritos = $clubesParticipantes->obtenerClubesNoInscritos();
            $campeonato = new Campeonato();
            $campeonato->setIdCampeonato($_GET['idcampeonato']);
            $campeonatoSeleccionado = $campeonato->obtenerUnCampeonato();
            require_once 'views/campeonatos/participantes.php';
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function agregarParticipante(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            $participante = new ClubesParticipantes();
            $tablaposiciones = new Tabla_Posiciones();
            if(isset($_GET['idclub']) && isset($_GET['idcampeonato'])){

                $participante->setIdClub($_GET['idclub']);
                $participante->setIdCampeonato($_GET['idcampeonato']);
                $tablaposiciones->setidClubFk($_GET['idclub']);
                $tablaposiciones->setidCampeonatoFk($_GET['idcampeonato']);

                $respuesta = $participante->inscribirClub();
                $resultado = $tablaposiciones->IngresarTablaPosiciones();

                if($respuesta &&  $resultado){

                    header('location:'.base_url.'campeonatos/gestionarParticipantes&idcampeonato='.$_GET['idcampeonato']);                    
                }else{
                    $id = $_GET['idcampeonato'];
                    
                    echo '<div class="container text-center mt-5">'
                    .'<h1>Por favor seleccione un participante!</h1>'.
                    '<a class="btn btn-danger" href="gestionarParticipantes&idcampeonato='.$id.'"'.'>'.'Volver'.'</a>'.                                        
                    '</div>';            
                }

            }else{
                
                echo 'No encontro valores por GET!!';

            }                       
            
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function eliminarInscripcion(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){

            $participante = new ClubesParticipantes();
            $tablaposiciones = new Tabla_Posiciones();

            $participante->setIdClubesParticipantes($_GET['id']);
            $id_club = $participante->obtenerIdClubCampeonato();
            
            $tablaposiciones->setidClubFk($id_club->ID_CLUB_FK);
            $resp = $tablaposiciones->BorrarDeTablaPosiciones();
            $participante->eliminarInscripcion();
           
            header('location:'.base_url.'campeonatos/gestionarParticipantes&idcampeonato='.$_GET['idcampeonato']);

        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }
}