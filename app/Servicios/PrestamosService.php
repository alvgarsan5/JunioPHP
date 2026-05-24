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


    public function obtenerRecomendaciones ($prestamo) {
        // para cargar dinamicamente las tipos de prestamos en el formulario
    if($prestamo === "clase"){
        return("Nos debes 20 euros si es para clase");
    }elseif($prestamo === "guardia"){
        return("Nos debes 10 euros y luego lo dejas en secrretaria");
    }elseif($prestamo === "examen"){
        return("No  nos debes nada y muchas suerte en el examen");
    }else{
        return("ese tipo de prestamo no es valido");
    }

    }



    public function obtenerPrestamosRecientes() {
        // Aquí podrías recuperar los préstamos recientes de una base de datos o de un archivo
        // Por simplicidad, vamos a devolver un array con algunos préstamos de ejemplo
        return $_SESSION['prestamos'] ?? [];
    } 
    
    
}