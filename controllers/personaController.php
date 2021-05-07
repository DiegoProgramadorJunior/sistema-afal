<?php
require_once 'config/parameters.php';
require_once 'models/persona.php';
require_once 'models/perfil.php';
require_once 'models/asociacion.php';
require_once 'models/usuario.php';
require_once 'models/direccion.php';
require_once 'models/provincia.php';
require_once 'models/comuna.php';
require_once 'models/tipo_estado.php';
require_once 'models/auditoria.php';
require_once 'models/FuncionValidarRut.php';

class personaController{

    public function index(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            if(!isset($_GET['in'])){
                $_SESSION['mensajeError'] = true;
            }else{
                unset($_SESSION['mensajeError']);
            }
            $persona = new Persona();
            $todasLasPersonas = $persona->obtenerPersona();
            include_once 'views/persona/persona.php';
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function gestionCrear(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
              if(!isset($_GET['in'])){
                $_SESSION['mensajeError'] = true;
            }else{
                unset($_SESSION['mensajeError']);
            }
            $persona = new Persona();
            $perfil = new Perfil();
            $asociacion = new Asociacion();
            $todasLasPersonas = $persona->obtenerPersona();
            $todosLosPerfiles = $perfil->obtenerPerfiles();
            $todasLasAsociaciones = $asociacion->obtenerAsociaciones();
            include_once 'views/persona/gestionPersona.php';
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }
    
    public function crear(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
                 
            $direccion = new Direccion();
            $persona = new Persona();            
            $usuario = new Usuario();
            $auditoria = new Auditoria();  
            $validar = new ValidarRutphp();        
            /*Resivir rut y formatearlo y separarlo*/
            $rutnoformateado = $_POST['rut'];
            $cadena = trim(str_replace(array('-','.'), '', $rutnoformateado));

            $rutprimeraparte = substr($cadena,0,-1);    
            $rutultimaparte = substr($cadena,-1,1);
            
            $rutInt = (int)$rutprimeraparte;
            $dvInt = (int)$rutultimaparte;            
            /*===================================*/

            $persona->setRutPersona($rutprimeraparte);
            $todasLasPersonas = $persona->obtenerRutPersonas();            
            $datos = $todasLasPersonas;                        

            if($datos == false ){
                if($validar->verifica_RUT($rutnoformateado)==0){
                    $direccion->setCallePasaje($_POST['callePasaje']);
                    $direccion->setComuna($_POST['comuna']);
                    $direccion->setProvincia($_POST['provincia']);
                    $direccion->setRegion($_POST['region']);
        
                    $verificarDireccion = $direccion->verificarDireccion();
                    if($verificarDireccion<1){
                    $ingresar = $direccion->ingresarDireccion();
                    $resultado = $direccion->obtenerDireccion();
                    $persona->setIdDireccion($resultado['ID_DIRECCION']);
                    }else{
                    $resultado = $direccion->obtenerDireccion();                
                    $persona->setIdDireccion($resultado['ID_DIRECCION']);
                    }
                    //$persona->setRutPersona($rutprimeraparte);
                    $persona->setDvpersona($rutultimaparte);
                    $persona->setNombre1($_POST['nombrePersona1']);
                    $persona->setNombre2($_POST['nombrePersona2']);
                    $persona->setApellido1($_POST['apellidoPersona1']);
                    $persona->setApellido2($_POST['apellidoPersona2']);
                    $persona->setFechaNacimiento($_POST['fechaNacimiento']);
                    $persona->setNumeroTelefono($_POST['numeroTelefono']);
                    $persona->setCorreo($_POST['correoElectronico']);
                    $persona->setIdAsociacion($_POST['nombreAsociacion']);
                    $persona->setIdPerfil($_POST['perfilPersona']);
        
                    $respuesta = $persona->ingresarPersona();
                    /*=============CREAR USUARIO================*/           
                    $NombreUsuario = $rutprimeraparte.''.$rutultimaparte;
                    $ContraseñaUsuario = substr($rutprimeraparte, 0, 4); 
                    $RutUsuario = $rutprimeraparte;

                    $usuario->setNombreUsuario($NombreUsuario);
                    $ClaveEncriptada = password_hash($ContraseñaUsuario, PASSWORD_DEFAULT);
                    $usuario->setClaveUsuario($ClaveEncriptada);
                    $usuario->setRutUsuario($RutUsuario);        
         
                    if($_POST['perfilPersona'] == 4  || $_POST['perfilPersona'] == 6 || $_POST['perfilPersona'] == 7){              
                    /*=============INSERTAR TABLA AUDITORIA (ACCION INSERT)=========*/       
                    date_default_timezone_set('America/Santiago');
                    $fechaActual = date('Y-m-d');
                    $horaActual = date("H:i:s");

                    $auditoria->setNombreUsuario($_POST['NombreUsuario']);
                    $auditoria->setRutUsuario($_POST['rutUsuario']);
                    $auditoria->setFechaRegistro($fechaActual);
                    $auditoria->setHoraRegistro($horaActual);
                    $auditoria->setModulo('Persona');
                    $auditoria->setAccion('INSERTAR');
                    $auditoria->setDescripcion('Se a registrado a '.$_POST['nombrePersona1'].' '.$_POST['nombrePersona2'].' '.$_POST['apellidoPersona1'].' '.$_POST['apellidoPersona2'].', cuenta con el perfil id='.$_POST['perfilPersona']);
                    $resultado = $auditoria->InsertAuditoria();         
                    /*==============================================================*/                  
                    }else{

                        $respuesta = $usuario->crearUsuario();
                        /*=============INSERTAR TABLA AUDITORIA (ACCION INSERT)=========*/       
                        $fechaActual = date('Y-m-d');
                        $horaActual = date("H:i:s");

                        $auditoria->setNombreUsuario($_POST['NombreUsuario']);
                        $auditoria->setRutUsuario($_POST['rutUsuario']);
                        $auditoria->setFechaRegistro($fechaActual);
                        $auditoria->setHoraRegistro($horaActual);
                        $auditoria->setModulo('Persona');
                        $auditoria->setAccion('INSERTAR');
                        $auditoria->setDescripcion('Se a registrado a '.$_POST['nombrePersona1'].' '.$_POST['nombrePersona2'].' '.$_POST['apellidoPersona1'].' '.$_POST['apellidoPersona2'].', cuenta con el perfil id= '.$_POST['perfilPersona'].' y se a creado un usuario para este' );
                        $resultado = $auditoria->InsertAuditoria();         
                        /*==============================================================*/     
                    } 

                    if($respuesta){
                        echo 'Encontro respuesta';
                        header('location:'.base_url.'persona/index');                    
                    }else{
                        echo 'NO encontro respuesta';
                        header('location:'.base_url.'persona/gestionCrear');
                    }                   
                }else{
                    header('location:'.base_url.'persona/gestionCrear&errorRut=1');     
                }
                                          
            }elseif($rutprimeraparte == $datos['RUT_PERSONA']){
                
               header('location:'.base_url.'persona/gestionCrear&errorExiste=1');
   
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
            $persona = new Persona();
            $persona->setRutPersona($_GET['id']);
            $perfil = new Perfil();
            $asociacion = new Asociacion();
            $provincia = new Provincia();
            $comuna = new Comuna();
            $estado = new Tipoestado();
            $datosdeunaPersona = $persona->obtenerUnPersona();


            $todosLosPerfiles = $perfil->obtenerPerfiles();
            $todasLasAsociaciones = $asociacion->obtenerAsociaciones();                                           
            $todosLosEstados = $estado->obtenerEstados();
            $todasLasProvincias = $provincia->obtenerProvinciasDeRegion($datosdeunaPersona['ID_REGION_FK']);
            $todasLasComunas = $comuna->obtenerComunasDeProvincia($datosdeunaPersona['ID_PROVINCIA_FK']);   
               
            include_once 'views/persona/gestionPersona.php';
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }
    
    public function editar(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            $direccion = new Direccion();
            $persona = new Persona();                
            $auditoria = new Auditoria();  
            $usuario = new Usuario();
            if(isset($_POST['callePasaje']) && isset($_POST['comuna']) && isset($_POST['provincia']) && isset($_POST['region'])){

                unset($_SESSION['mensajeErrorDireccion']);
                
                $direccion->setCallePasaje($_POST['callePasaje']);
                $direccion->setComuna($_POST['comuna']);
                $direccion->setProvincia($_POST['provincia']);
                $direccion->setRegion($_POST['region']);
    
                $verificarDireccion = $direccion->verificarDireccion();

               if($verificarDireccion<1){
                   $ingresar = $direccion->ingresarDireccion();
                   $resultado = $direccion->obtenerDireccion();
                   $persona->setIdDireccion($resultado['ID_DIRECCION']);

                }else{
                   $resultado = $direccion->obtenerDireccion();                
                   $persona->setIdDireccion($resultado['ID_DIRECCION']);
                }
               
            }else{
               $_SESSION['mensajeErrorDireccion'] = true;
            }

            /*Resivir rut y formatearlo y separarlo*/
               $rutnoformateado = $_POST['rut'];
               $cadena = trim(str_replace(array('-','.'), '', $rutnoformateado));
   
               $rutprimeraparte = substr($cadena,0,-1);    
               $rutultimaparte = substr($cadena,-1,1);
               
               $rutInt = (int)$rutprimeraparte;
               $dvInt = (int)$rutultimaparte;            
            /*===================================*/
           
            
            $persona->setRutPersona( $rutprimeraparte );
            $persona->setDvpersona( $rutultimaparte);
            $persona->setNombre1($_POST['nombrePersona1']);
            $persona->setNombre2($_POST['nombrePersona2']);
            $persona->setApellido1($_POST['apellidoPersona1']);
            $persona->setApellido2($_POST['apellidoPersona2']);
            $persona->setFechaNacimiento($_POST['fechaNacimiento']);
            $persona->setNumeroTelefono($_POST['numeroTelefono']);
            $persona->setCorreo($_POST['correoElectronico']);
            $persona->setIdAsociacion($_POST['nombreAsociacion']);
            $persona->setIdPerfil($_POST['perfilPersona']);
            $persona->setIdTipoEstado($_POST['tipoestado']);
            $respuesta = $persona->editarPersona();
            

            /*=============CREAR USUARIO================*/           
            $NombreUsuario = $rutprimeraparte.''.$rutultimaparte;
            $ContraseñaUsuario = substr($rutprimeraparte, 0, 4); 
            $RutUsuario = $rutprimeraparte;

            $usuario->setNombreUsuario($NombreUsuario);
            $ClaveEncriptada = password_hash($ContraseñaUsuario, PASSWORD_DEFAULT);
            $usuario->setClaveUsuario($ClaveEncriptada);
            $usuario->setRutUsuario($RutUsuario);
            
            $datos = $usuario->obtenerUnUsuariosConRut();
            

                if($datos == false && $_POST['perfilPersona'] == 1 || $_POST['perfilPersona'] == 2 || $_POST['perfilPersona'] == 3 || $_POST['perfilPersona'] == 5){                                                                  

                    $usuario->crearUsuario();

                }elseif($rutprimeraparte == $datos['RUT_PERSONA_FK'] && $_POST['perfilPersona'] == 4 || $_POST['perfilPersona'] == 6 || $_POST['perfilPersona'] == 7){
                   
                    $usuario->deshabilitarUsuarioConRut();

                }elseif($rutprimeraparte == $datos['RUT_PERSONA_FK'] && $datos['ID_TIPO_ESTADO_FK'] == 2 && $_POST['perfilPersona'] == 1 || $_POST['perfilPersona'] == 2 || $_POST['perfilPersona'] == 3 || $_POST['perfilPersona'] == 5){

                    $usuario->habilitarUsuarioConRut();

                }else{

                    echo 'YA VALI VERGA';

                }

            /*=============INSERTAR TABLA AUDITORIA (ACCION UPDATE)=========*/       
            date_default_timezone_set('America/Santiago');
            $fechaActual = date('Y-m-d');
            $horaActual = date("H:i:s");
     
            $auditoria->setNombreUsuario($_POST['NombreUsuario']);
            $auditoria->setRutUsuario($_POST['rutUsuario']);
            $auditoria->setFechaRegistro($fechaActual);
            $auditoria->setHoraRegistro($horaActual);
            $auditoria->setModulo('Persona');
            $auditoria->setAccion('MODIFICAR');
            $auditoria->setDescripcion('Se han modificado los datos de '.$_POST['nombrePersona1'].' '.$_POST['nombrePersona2'].' '.$_POST['apellidoPersona1'].' '.$_POST['apellidoPersona2'].', cuenta con el perfil id='.$_POST['perfilPersona']);
            $auditoria->InsertAuditoria();                              
            /*==============================================================*/  
            

                if($respuesta && isset($_GET['in'])){         
                     header('location:'.base_url.'persona/arbitros');
                }elseif($respuesta && isset($_GET['tec'])){         
                    header('location:'.base_url.'tecnico/index');
                }else if($respuesta){
                    header('location:'.base_url.'persona/index');
                }else if($_GET['in']=="crear"){                
                    header('location:'.base_url.'persona/gestionEditar&id='.$rutprimeraparte);
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
            echo 'paso1: Entra al controlador';
            $persona = new Persona();
            $usuarios = new Usuario();   
            $auditoria = new Auditoria();  
            if(isset($_GET['rutPersona'])){ 
                $persona->setRutPersona($_GET['rutPersona']);               
                $respuesta = $persona->eliminarPersona();
                $datos = $persona->obtenerUnPersona();
                $arraydatos =(array) $datos;
                
                if($respuesta == true){

                    $datos = $persona->obtenerUnPersona($_GET['rutPersona']);
                    $datosUsuario = $usuarios->obtenerUnUsuarioEliminar($_GET['rutPersona']);
                   
                    if($datos['ID_PERFIL_FK'] == 4 || $datos['ID_PERFIL_FK'] == 6 || $datos['ID_PERFIL_FK'] == 7){

                        /*=============INSERTAR TABLA AUDITORIA (ACCION DELETE)=========*/                        
                        date_default_timezone_set('America/Santiago');
                        $fechaActual = date('Y-m-d');
                        $horaActual = date("H:i:s");
     
                        $auditoria->setNombreUsuario($_GET['user']);
                        $auditoria->setRutUsuario($_GET['rutuser']);
                        $auditoria->setFechaRegistro($fechaActual);
                        $auditoria->setHoraRegistro($horaActual);
                        $auditoria->setModulo('Persona');
                        $auditoria->setAccion('DESHABILITAR');
                        $auditoria->setDescripcion('Se a deshabilitado a '.$arraydatos['NOMBRE_1'].' '.$arraydatos['NOMBRE_2'].' '.$arraydatos['APELLIDO_1'].' '.$arraydatos['APELLIDO_2'].', cuenta con el perfil id='.$arraydatos['ID_PERFIL_FK']);
                        $auditoria->InsertAuditoria(); 

                        header('location:'.base_url.'persona/index');   

                    }else{
                                                                                                   
                        $idEstadoUsuario = $datosUsuario['ID_TIPO_ESTADO_FK'];
                        $idEstadoPersona = $datos['ID_TIPO_ESTADO_FK_PERSONA'];                    

                        if($idEstadoPersona==2 && $idEstadoUsuario == 1){               
                            $usuarios->setRutUsuario($_GET['rutPersona']);                            
                            $usuarios->deshabilitarUsuarioConRut();                  

                            /*=============INSERTAR TABLA AUDITORIA (ACCION DELETE)=========*/                        
                                date_default_timezone_set('America/Santiago');
                                $fechaActual = date('Y-m-d');
                                $horaActual = date("H:i:s");
                            
                                $auditoria->setNombreUsuario($_GET['user']);
                                $auditoria->setRutUsuario($_GET['rutuser']);
                                $auditoria->setFechaRegistro($fechaActual);
                                $auditoria->setHoraRegistro($horaActual);
                                $auditoria->setModulo('Persona');
                                $auditoria->setAccion('DESHABILITAR');
                                $auditoria->setDescripcion('Se a deshabilitado a '.$arraydatos['NOMBRE_1'].' '.$arraydatos['NOMBRE_2'].' '.$arraydatos['APELLIDO_1'].' '.$arraydatos['APELLIDO_2'].', cuenta con el perfil id='.$arraydatos['ID_PERFIL_FK'].', tambien se a deshabilitado el usuario con el que contaba');
                                $auditoria->InsertAuditoria();

                                header('location:'.base_url.'persona/index');  
                        }
                      
                    }                   
                 
                }else{
                    echo 'No se a ejecutado Correctamente la consulta'; 
                }
              
            }else{
                echo 'No se a resibido valor por GET';
               
            }
                                                           
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }           
    }

    public function habilitarunapersona(){
        $persona = new Persona();             
        $usuario = new Usuario();   
        
        if(isset($_GET['rutHabilitar'])){
            $persona->setRutPersona($_GET['rutHabilitar']);        
            $respuesta = $persona->habilitarPersona();

            if($respuesta == true){
                $datosUsuario = $usuario->obtenerUnUsuarioEliminar($_GET['rutHabilitar']);
                $datos = $persona->obtenerUnPersona($_GET['rutHabilitar']);  

                if($datos['ID_PERFIL_FK'] == 4 || $datos['ID_PERFIL_FK'] == 6 || $datos['ID_PERFIL_FK'] == 7){
                     header('location:'.base_url.'persona/index');   

                }else{
                                                                                               
                    $idEstadoUsuario = $datosUsuario['ID_TIPO_ESTADO_FK'];
                    $idEstadoPersona = $datos['ID_TIPO_ESTADO_FK_PERSONA'];                  

                    if($idEstadoPersona==1 && $idEstadoUsuario == 2){               
                        $usuario->setRutUsuario($_GET['rutHabilitar']);
                        $usuario->habilitarUsuarioConRut();                  
                        header('location:'.base_url.'persona/index');  
                    }else{
        
                    }
                  
                }  
            }else{

            }

        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
       
    }

    public function arbitros(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            $arbitros = new Persona();
            $todosLosArbitros = $arbitros->obtenerArbitros();
            require_once 'views/persona/arbitros.php';
        }
    }

    public function eliminarArbitro(){
        $identity = $_SESSION['identity'];
        if(isset($_SESSION['identity']) && $identity->ID_PERFIL_FK=="1"){
            $persona = new Persona();
            $persona->setRutPersona($_GET['rut']);
            $respuesta = $persona->eliminarArbitro();
            header('location:'.base_url.'persona/arbitros');
        }else{
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    
}