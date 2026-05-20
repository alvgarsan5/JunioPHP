<?php

class IncidenciaService {

public function obtererAula(){
    // para cargar dinamicamente las aulas en el formulario
    return["Aula 1","Aula DAW", "Aula i55"];
}

public function obtererTipoIncidencia(){
    // para cargar dinamicamente los tipos de incidencia en el formulario
    return["Hardware", "Software", "Red"];

}
    public function crearIncidencia($aula, $tipoIncidencia, $equipos, $horasTotales) {
        try {
            $incidencia = new Incidencia($aula, $tipoIncidencia, $equipos, $horasTotales);
            // Aquí podrías guardar la incidencia en una base de datos o realizar otras acciones necesarias
            return $incidencia;
        } catch (InvalidArgumentException $e) {
            // Manejar errores de validación
            exit("Error al crear la incidencia: " . $e->getMessage());
        }
    }

    public function obtenerIncidenciasRecieentes() {
        
    }



}