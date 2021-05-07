<?php
require_once 'models/serie.php';
require_once 'models/partido.php';
require_once 'models/campeonato.php';
require_once 'models/tabla_posiciones.php';

class publicoController{

    public function programacion(){
        $series = new Serie();
        $todasLasSeries = $series->obtenerSeries();
        if(isset($_GET['serie'])){
            $partido = new Partido();
            $partidos = $partido->cargarProgramacion((int)$_GET['serie']);
        }
        require_once 'views/publico/programacion.php';
    }

    public function posiciones(){
        $campeonato = new Campeonato();
        $campeonatos= $campeonato->obtenerCampeonatosVigentes();
        if(isset($_GET['campeonato'])){
            $tabla = new Tabla_Posiciones();
            $tabla->setidCampeonatoFk((int)$_GET['campeonato']);
            $tablaPosiciones = $tabla->obtenerTablaCampeonato();
            require_once 'views/publico/posiciones.php';
        }
    }

    public function resultados(){
        $series = new Serie();
        $todasLasSeries = $series->obtenerSeries();
        if(isset($_GET['serie'])){
            $partido = new Partido();
            $partidos = $partido->obtenerResultados((int)$_GET['serie']);
        }
        require_once 'views/publico/resultados.php';
    }
}