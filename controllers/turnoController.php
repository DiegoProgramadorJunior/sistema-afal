<?php
require_once 'config/parameters.php';
require_once 'config/database.php';
require_once 'models/partido.php';
require_once 'models/partido_jugadores.php';
require_once 'models/tipo_gol.php';
require_once 'models/tipo_falta.php';
require_once 'models/tipo_tarjeta.php';
require_once 'models/estado_partido.php';
require_once 'models/tabla_posiciones.php';

require_once 'models/tecnico.php';


class turnoController{

    public function index(){
        $identity = $_SESSION['identity'];
        $partidos = new Partido();
        $tecnico = new Tecnico();

        $estados = new Estado_Partido();
        $estadoPartidos = $estados->obtenerEstados();
        $partidos->setRutTurno($identity->RUT_PERSONA_FK);
        $partidosTurno = $partidos->obtenerPartidosTurno();
        
        require_once 'views/turno/inicio.php';
    }

    public function gestionPartidos(){
        /*CLASES*/
        $partidoJugadores = new Partido_Jugadores();
        $partido = new Partido();
        $tipoGol = new Tipo_Gol();
        $tipotarjeta = new Tipo_Targeta();
        $tipofalta = new Tipo_Falta();        
        /*===================================================*/
        $partidoJugadores->setIdPartidosFk($_GET['partido']);
        $partido->setIdPartido($_GET['partido']);

        $datosPartido = $partido->obtenerUnPartido();
        $todosLosTiposGoles = $tipoGol->obtenerTiposGoles(); /*OBTENER TIPOS DE GOLES*/
        $todosLosTiposTarjeta = $tipotarjeta->obtenerTiposTarjetas(); /*OBTENER TIPOS DE TARJETA*/
        $todosLosTiposFalta = $tipofalta->obtenerTiposFaltas(); /*OBTENER TIPOS DE FALTAS*/
        $jugadoresLocal = $partidoJugadores->obtenerJugadoresLocal($datosPartido->ID_CLUB_LOCAL_FK);
        $jugadoresVisita = $partidoJugadores->obtenerJugadoresVisita($datosPartido->ID_CLUB_VISITA_FK);
        $datosClubTecnico = $partidoJugadores->datosPartidosClubes($datosPartido->ID_SERIE_FK);

        

        require_once 'views/turno/gestionPartidos.php';
    }

    public function terminarPartido(){
        if(isset($_GET['empate'])){
            //rescatar id de los clubes, buscar en las tablas de posiciones, rescatando el campeonato del partido.
            $partido = new Partido();
            $partido->setIdPartido($_GET['partido']);
            $datosPartido = $partido->obtenerUnPartido();
            $clubLocal = $datosPartido->ID_CLUB_LOCAL_FK;
            $clubVisita = $datosPartido->ID_CLUB_VISITA_FK;
            $campeonato = $datosPartido->ID_CAMPEONATO;
        }else{
            $ganador = $_GET['ganador'];
            $perdedor = $_GET['perdedor'];

            $partido = new Partido();
            $partido->setIdPartido($_GET['partido']);
            $partido->setEstado(4);
            $datosPartido = $partido->obtenerUnPartido();
            $campeonato = $datosPartido->ID_CAMPEONATO;

            $tablaGanador = new Tabla_Posiciones();
            $tablaGanador->setidCampeonatoFk($campeonato);
            $tablaGanador->setidClubFk($ganador);
            $datosClubGanador = $tablaGanador->obtenerDatosEquipo();
            $ptsGanador = (int)$datosClubGanador->PTS+3;
            $pjGanador = (int)$datosClubGanador->PJ+1;
            $pgGanador = (int)$datosClubGanador->PG+1;
            $peGanador = (int)$datosClubGanador->PE;
            $ppGanador = (int)$datosClubGanador->PP;
            $gfGanador = (int)$datosClubGanador->GF+(int)$_GET['gg'];
            $gcGanador = (int)$datosClubGanador->GC+(int)$_GET['gp'];
            $difGanador = $gfGanador+$gcGanador;
            $tablaGanador->setPTS($ptsGanador);
            $tablaGanador->setPJ($pjGanador);
            $tablaGanador->setPG($pgGanador);
            $tablaGanador->setPE($peGanador);
            $tablaGanador->setPP($ppGanador);
            $tablaGanador->setGF($gfGanador);
            $tablaGanador->setGC($gcGanador);
            $tablaGanador->setDIF($difGanador);

            $tablaPerdedor = new Tabla_Posiciones();
            $tablaPerdedor->setidCampeonatoFk($campeonato);
            $tablaPerdedor->setidClubFk($perdedor);
            $datosClubPerdedor = $tablaPerdedor->obtenerDatosEquipo();
            $ptsPerdedor = (int)$datosClubPerdedor->PTS+0;
            $pjPerdedor = (int)$datosClubPerdedor->PJ+1;
            $pgPerdedor = (int)$datosClubPerdedor->PG+0;
            $pePerdedor = (int)$datosClubPerdedor->PE+0;
            $ppPerdedor = (int)$datosClubPerdedor->PP+1;
            $gfPerdedor = (int)$datosClubPerdedor->GF+(int)$_GET['gp'];
            $gcPerdedor = (int)$datosClubPerdedor->GC+(int)$_GET['gg'];
            $difPerdedor = $gfPerdedor-$gcPerdedor;
            $tablaPerdedor->setPTS($ptsPerdedor);
            $tablaPerdedor->setPJ($pjPerdedor);
            $tablaPerdedor->setPG($pgPerdedor);
            $tablaPerdedor->setPE($pePerdedor);
            $tablaPerdedor->setPP($ppPerdedor);
            $tablaPerdedor->setGF($gfPerdedor);
            $tablaPerdedor->setGC($gcPerdedor);
            $tablaPerdedor->setDIF($difPerdedor);

            $res1 = (int)$tablaGanador->actualizarTabla();
            $res2 = (int)$tablaPerdedor->actualizarTabla();
            $res3 = (int)$partido->actualizarEstado();
            if(($res1==1) && ($res2==1)){
                if($res3==1){
                    header('location:'.base_url.'turno/index');
                }
            }
        }
    }
}