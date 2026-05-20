<?php

class Incidencia {
    private $aula;
    private $tipoIncidencia;
    private $equipos;

    private $horasTotales;

    public function __construct($aula, $tipoIncidencia, $equipos, $horasTotales) {
        $this->aula = $aula;
        $this->tipoIncidencia = $tipoIncidencia;
        $this->equipos = $equipos;
        $this->horasTotales = $horasTotales;
    }

    public function getAula() {
        return $this->aula;
    }

    public function getTipoIncidencia() {
        return $this->tipoIncidencia;
    }

    public function getEquipos() {
        return $this->equipos;
    }

    public function getHorasTotales() {
        return $this->horasTotales;
    }



}