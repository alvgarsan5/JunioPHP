<?php

require_once __DIR__ . '/../models/Prestamo.php';

class PrestamosService {

    public function obtenerPrestamo() {
        // para cargar dinamicamente las tipos de prestamos en el formulario
        return["Clase","Guardia", "Examen"];
    }

    public function crearPrestamo($aula, $numeroTablets, $horasUso, $prestamo) {
        // Aquí podrías guardar el préstamo en una base de datos o en un archivo
        // Por simplicidad, vamos a crear un objeto Prestamo y devolverlo
        $nuevoPrestamo = new Prestamo($aula, $numeroTablets, $horasUso, $prestamo);
        return $nuevoPrestamo;
    }


    public function obtenerPrestamosRecientes() {
        // Aquí podrías recuperar los préstamos recientes de una base de datos o de un archivo
        // Por simplicidad, vamos a devolver un array con algunos préstamos de ejemplo
        return $_SESSION['prestamos'] ?? [];
    } 
    
    
}