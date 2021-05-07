<?php
require_once 'config/parameters.php';
require_once 'models/club.php';
require_once 'models/jugador.php';
require_once 'models/auditoria.php';
require_once 'models/persona.php';
class jugadoresController{
    
    public function index(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            
            $club = new Club();
            $todosLosClubes = $club->obtenerClubes();
            require_once 'views/jugadores/jugadores.php';
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }
    
    public function gestionjugador(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){

            $jugador = new Jugador();            
            $club = new Club();

            $jugador->setidClub($_GET['id']);
            $unClub = $club->obtenerUnClub($_GET['id']);
            $jugadorNoAderido = $jugador->obtenerJugadorNoAderido();
            $todosLosJugadoresPorClub = $jugador->obtenerJugadoresPorClub();

            require_once 'views/jugadores/gestionjugadores.php';
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function aderirJugadorClub()
    {   
        $id = $_POST['id'];
        $jugador = new Jugador(); 
        $auditoria = new Auditoria(); 
        $persona = new Persona();
        $club = new Club();

        if(isset($_POST['jugador']) & isset($_POST['id'])){
           
            $jugador->setrutPersona($_POST['jugador']);
            $jugador->setidClub($_POST['id']);
            $persona->setRutPersona($_POST['jugador']);

            $resultado = $jugador->agregarJugadorClub();
            $datos = $persona->obtenerUnPersona();
            $datosClub = $club->obtenerUnClub($_POST['id']);

            if($resultado && $datos && $datosClub){

            $arraydatos =(array) $datos;
            var_dump($arraydatos);

            $arrayDatosClub = (array) $datosClub;
            var_dump($arrayDatosClub); 
            echo 'el usuario es:'.$_POST['NombreUsuario'].' su rut es: '.$_POST['rutUsuario'];
            
                /*=============INSERTAR TABLA AUDITORIA (ACCION INSERT)=========*/       
                 date_default_timezone_set('America/Santiago');
                 $fechaActual = date('Y-m-d');
                 $horaActual = date("H:i:s");
         
                 $auditoria->setNombreUsuario($_POST['NombreUsuario']);
                 $auditoria->setRutUsuario($_POST['rutUsuario']);
                 $auditoria->setFechaRegistro($fechaActual);
                 $auditoria->setHoraRegistro($horaActual);
                 $auditoria->setModulo('Jugador');
                 $auditoria->setAccion('INSERTAR');
                 $auditoria->setDescripcion('Se a aderido el jugador '.$arraydatos['NOMBRE_1'].' '.$arraydatos['NOMBRE_2'].' '.$arraydatos['APELLIDO_1'].' '.$arraydatos['APELLIDO_2'].', al club '.$arrayDatosClub['NOMBRE_CLUB']);
                 $resultado = $auditoria->InsertAuditoria();         
                /*==============================================================*/   
                header('location:'.base_url.'jugadores/gestionjugador&id='.$id);
            }else{
                echo 'no encontro resultado';                
                echo '<h1>Verificar Controlador</h1>';
                header('location:'.base_url.'jugadores/gestionjugador&id='.$id);
            }
            
        }else{
            echo '<div class="container"> Error Pajero <div>';
            header('location:'.base_url.'jugadores/gestionjugador&id='.$_GET['id']);
        }
           
    }

    public function desincribirJugador(){
        $id = $_GET['idclub'];

        $jugador = new Jugador(); 
        $auditoria = new Auditoria(); 
        $persona = new Persona();
        $club = new Club();

        if(isset($_GET['rut'])){
          $jugador->setrutPersona($_GET['rut']);
          $persona->setRutPersona($_GET['rut']);

          $datos = $persona->obtenerUnPersona();
          $datosClub = $club->obtenerUnClub($id);

            if($datos && $datosClub){     
              $arraydatos =(array) $datos;
              $arrayDatosClub = (array) $datosClub;
                  
                if($arraydatos['ID_PERFIL_FK'] == 5){                                  

                   $jugador->EliminarPerfilJugador();
                    /*=============INSERTAR TABLA AUDITORIA (ACCION INSERT)=========*/       
                     date_default_timezone_set('America/Santiago');
                     $fechaActual = date('Y-m-d');
                     $horaActual = date("H:i:s");
                     $auditoria->setNombreUsuario($_GET['user']);
                     $auditoria->setRutUsuario($_GET['rutuser']);
                     $auditoria->setFechaRegistro($fechaActual);
                     $auditoria->setHoraRegistro($horaActual);
                     $auditoria->setModulo('Jugador');
                     $auditoria->setAccion('ELIMINAR');
                     $auditoria->setDescripcion('Se a eliminado el jugador '.$arraydatos['NOMBRE_1'].' '.$arraydatos['NOMBRE_2'].' '.$arraydatos['APELLIDO_1'].' '.$arraydatos['APELLIDO_2'].', del club '.$arrayDatosClub['NOMBRE_CLUB']);
                     $resultado = $auditoria->InsertAuditoria();         
                    /*==============================================================*/   
                }else{
                    /*=============INSERTAR TABLA AUDITORIA (ACCION INSERT)=========*/       
                     date_default_timezone_set('America/Santiago');
                     $fechaActual = date('Y-m-d');
                     $horaActual = date("H:i:s");
                     $auditoria->setNombreUsuario($_GET['user']);
                     $auditoria->setRutUsuario($_GET['rutuser']);
                     $auditoria->setFechaRegistro($fechaActual);
                     $auditoria->setHoraRegistro($horaActual);
                     $auditoria->setModulo('Jugador');
                     $auditoria->setAccion('ELIMINAR');
                     $auditoria->setDescripcion('Se a eliminado el jugador '.$arraydatos['NOMBRE_1'].' '.$arraydatos['NOMBRE_2'].' '.$arraydatos['APELLIDO_1'].' '.$arraydatos['APELLIDO_2'].', del club '.$arrayDatosClub['NOMBRE_CLUB']);
                     $resultado = $auditoria->InsertAuditoria();         
                  /*==============================================================*/  
                }                           
            }else{
                echo 'No se han encontrado Datos';
            }
         $jugador->eliminarJugador();
         header('location:'.base_url.'jugadores/gestionjugador&id='.$id);
        }else{
            echo ' []No resive EL rut';
        }
    }

}