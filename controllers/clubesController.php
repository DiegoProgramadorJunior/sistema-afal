<?php
require_once 'models/club.php';
require_once 'models/asociacion.php';
require_once 'config/parameters.php';
require_once 'models/persona.php';
require_once 'models/direccion.php';
require_once 'models/provincia.php';
require_once 'models/comuna.php';
require_once 'models/auditoria.php';
class clubesController
{

    public function index()
    {
        $identity = $_SESSION['identity'];
        if (isset($_SESSION['identity']) && $identity->ID_PERFIL_FK == "1") {
            $club = new Club();
            $todoslosClubes = $club->obtenerClubes();
            include_once 'views/clubes/clubes.php';
        } else {
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function gestionCrear()
    {
        $identity = $_SESSION['identity'];
        if (isset($_SESSION['identity']) && $identity->ID_PERFIL_FK == "1") {
            $asociacion = new Asociacion();
            $todasLasAsociaciones = $asociacion->obtenerAsociaciones();
            require_once 'views/clubes/gestionClubes.php';
        } else {
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function crear()
    {
        $identity = $_SESSION['identity'];
        if (isset($_SESSION['identity']) && $identity->ID_PERFIL_FK == "1") {
            $direccion = new Direccion();
            $club = new Club();
            $auditoria = new Auditoria();

            $direccion->setCallePasaje($_POST['calle']);
            $direccion->setComuna($_POST['comuna']);
            $direccion->setProvincia($_POST['provincia']);
            $direccion->setRegion($_POST['region']);

            $verificarDireccion = $direccion->verificarDireccion();
            if ($verificarDireccion < 1) {
                $ingresar = $direccion->ingresarDireccion();
                $resultado = $direccion->obtenerDireccion();
                $club->setIdDireccion($resultado['ID_DIRECCION']);
            } else {
                $resultado = $direccion->obtenerDireccion();
                $club->setIdDireccion($resultado['ID_DIRECCION']);
            }

            $club->setRutClub($_POST['rutClub']);
            $club->setDvClub($_POST['dvClub']);
            $club->setNombreClub($_POST['nombreClub']);
            $club->setFechaFundacionClub($_POST['fechaFundacion']);
            $club->setNombreEstadio($_POST['nombreEstadio']);
            $club->setIdCorreo($_POST['correoClub']);
            $club->setIdAsociacion($_POST['nombreAsociacion']);
            $ingreso = $club->ingresarClub();

            /*=============INSERTAR TABLA AUDITORIA (ACCION INSERT)=========*/
            date_default_timezone_set('America/Santiago');
            $fechaActual = date('Y-m-d');
            $horaActual = date("H:i:s");

            $auditoria->setNombreUsuario($_POST['NombreUsuario']);
            $auditoria->setRutUsuario($_POST['rutUsuario']);
            $auditoria->setFechaRegistro($fechaActual);
            $auditoria->setHoraRegistro($horaActual);
            $auditoria->setModulo('Club');
            $auditoria->setAccion('INSERTAR');
            $auditoria->setDescripcion('Se a registrado a ' . $_POST['nombreClub'] . ' Rut: ' . $_POST['rutClub'] . '-' . $_POST['dvClub']);
            $auditoria->InsertAuditoria();

            /*==============================================================*/
            if ($ingreso == false) {
                header('location:' . base_url . 'clubes/gestionCrear&errorcreate=true');
            } else {
                header('location:' . base_url . 'clubes/index');
            }
        } else {
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function gestionEditar()
    {
        $club = new Club();
        $asociacion = new Asociacion();
        $provincia = new Provincia();
        $comuna = new Comuna();
        $todasLasAsociaciones = $asociacion->obtenerAsociaciones();
        $clubSeleccionado = $club->obtenerUnClub($_GET['clubSeleccionado']);
        $todasLasProvincias = $provincia->obtenerProvinciasDeRegion($clubSeleccionado['ID_REGION_FK']);
        $todasLasComunas = $comuna->obtenerComunasDeProvincia($clubSeleccionado['ID_PROVINCIA_FK']);
        require_once 'views/clubes/gestionClubes.php';
    }

    public function editar()
    {
        $identity = $_SESSION['identity'];
        if (isset($_SESSION['identity']) && $identity->ID_PERFIL_FK == "1") {
            $club = new Club();
            $direccion = new Direccion();
            $auditoria = new Auditoria();

            $direccion->setCallePasaje($_POST['calle']);
            $direccion->setComuna($_POST['comuna']);
            $direccion->setProvincia($_POST['provincia']);
            $direccion->setRegion($_POST['region']);

            $verificarDireccion = $direccion->verificarDireccion();
            if ($verificarDireccion < 1) {
                $ingresar = $direccion->ingresarDireccion();
                $resultado = $direccion->obtenerDireccion();
                if (!is_object($resultado)) {
                    header('location:' . base_url . 'clubes/gestionEditar&clubSeleccionado=' . $_POST['idClub'] . '&erroredit=true');
                } else {
                    $club->setIdDireccion($resultado['ID_DIRECCION']);
                }
            } else {
                $resultado = $direccion->obtenerDireccion();
                $club->setIdDireccion($resultado['ID_DIRECCION']);
            }
            $club->setIdClub($_POST['idClub']);
            $club->setRutClub($_POST['rutClub']);
            $club->setDvClub($_POST['dvClub']);
            $club->setNombreClub($_POST['nombreClub']);
            $club->setFechaFundacionClub($_POST['fechaFundacion']);
            $club->setNombreEstadio($_POST['nombreEstadio']);
            $club->setIdCorreo($_POST['correoClub']);
            $club->setIdAsociacion($_POST['nombreAsociacion']);
            $editar = $club->editarClub();


            /*=============INSERTAR TABLA AUDITORIA (ACCION UPDATE)=========*/
            date_default_timezone_set('America/Santiago');
            $fechaActual = date('Y-m-d');
            $horaActual = date("H:i:s");

            $auditoria->setNombreUsuario($_POST['NombreUsuario']);
            $auditoria->setRutUsuario($_POST['rutUsuario']);
            $auditoria->setFechaRegistro($fechaActual);
            $auditoria->setHoraRegistro($horaActual);
            $auditoria->setModulo('Club');
            $auditoria->setAccion('MODIFICAR');
            $auditoria->setDescripcion('Se han modificado los datos del club ' . $_POST['nombreClub'] . ' Rut: ' . $_POST['rutClub'] . '-' . $_POST['dvClub']);
            $auditoria->InsertAuditoria();

            /*==============================================================*/

            if ($editar == false) {
                echo 'el false: ' . $editar;
                header('location:' . base_url . 'clubes/gestionCrear&erroredit=true');
            } else {
                header('location:' . base_url . 'clubes/index');
                echo 'el else: ' . $editar;
            }
        } else {
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function eliminar()
    {
        $identity = $_SESSION['identity'];
        if (isset($_SESSION['identity']) && $identity->ID_PERFIL_FK == "1") {
            $club = new Club();
            $auditoria = new Auditoria();

            $club->setIdClub($_GET['idclub']);
            $club->setIdTipoEstado(2);
            $respuesta = $club->eliminar();
            $datos = $club->obtenerUnClub($_GET['idclub']);
            $arrayDatos = (array) $datos;
            $arrayDatos['NOMBRE_CLUB'];
            $arrayDatos['RUT_CLUB'];
            /*=============INSERTAR TABLA AUDITORIA (ACCION DELETE)=========*/
            date_default_timezone_set('America/Santiago');
            $fechaActual = date('Y-m-d');
            $horaActual = date("H:i:s");

            $auditoria->setNombreUsuario($_GET['user']);
            $auditoria->setRutUsuario($_GET['rutuser']);
            $auditoria->setFechaRegistro($fechaActual);
            $auditoria->setHoraRegistro($horaActual);
            $auditoria->setModulo('Club');
            $auditoria->setAccion('ELIMINAR');
            $auditoria->setDescripcion('A deshabilitado al club ' . $arrayDatos['NOMBRE_CLUB'] . ' Rut: ' . $arrayDatos['RUT_CLUB'] . '-' . $arrayDatos['DV_CLUB']);
            $auditoria->InsertAuditoria();
            /*==============================================================*/
            if ($respuesta) {
                header('location:' . base_url . 'clubes/index');
            }
        } else {
            echo '<div class="container mt-5">';
            echo '<h1>No tienes permiso para acceder a este apartado del sistema</h1>';
            echo '</div>';
        }
    }

    public function habilitarUnClub()
    {

        $club = new Club();

        if (isset($_GET['idClub'])) {

            echo '<div class="container mt-5">';
            echo '<h1>"'+$_GET['idClub']+'"</h1>';
            echo '</div>';
        } else {
        }
    }
}
