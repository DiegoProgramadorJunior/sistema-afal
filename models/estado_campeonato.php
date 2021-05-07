<?php 

class EstadoCampeonato{

    private $id_estado_campeonato;
    private $nombre_estado_campeonato;

    public function getIdEstadoCampeonato(){
        return $this->id_estado_campeonato;
    }

    public function setIdEstadoCampeonato($id_estado_campeonato){
        $this->id_estado_campeonato = $id_estado_campeonato;
    }

    public function getNombreEstadoCampeonato(){
        return $this->nombre_estado_campeonato;
    }

    public function setNombreEstadoCampeonato($nombre_estado_campeonato){
        $this->nombre_estado_campeonato = $nombre_estado_campeonato;
    }

    public function obtenerEstadosDeCampeonatos(){

        $resultado = false;
        $database = Database::connect();

        $sql = "SELECT * FROM estado_campeonato";

        $respuesta = $database->query($sql);

        if($respuesta && $respuesta->num_rows > 0){
            $resultado = $respuesta;
        }

        return $resultado;
    }
}

?>