<?php

class Prestamo {
    private $aula;

    private $numeroTablets;

    private $horasUso;
    private $prestamo;
    

    public function __construct($aula, $numeroTablets, $horasUso, $prestamo) {
        $this->aula = $aula;
        $this->numeroTablets = $numeroTablets;
        $this->horasUso = $horasUso;
        $this->prestamo = $prestamo;
    }

    public function getAula() {
        return $this->aula;
    }
    
    public function getNumeroTablets() {
        return $this->numeroTablets;
    }
    
    public function getHorasUso() {
        return $this->horasUso;
    }

    public function getPrestamo() {
        return $this->prestamo;
    }

    

}