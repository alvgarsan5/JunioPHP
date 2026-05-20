<?php

class IncidenciasController {

public function validarFormulario(){
// creamos un array de errores antes del condicional para almacenar los errores de validación del formulario
$errores = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {    




        // 1. Validación básica de formulario
        $aula = $_POST['aula'] ?? '';
        $tipo = $_POST['incidencias'] ?? '';
        $equipos = $_POST['equipos'] ?? '';
        $horas = $_POST['horasTotales'] ?? '';

    if ($aula === '') {
        $errores[] = "Selecciona un aula.";
    }

    if ($tipo === '') {
        $errores[] = "Selecciona un tipo de incidencia.";
    }

    if ($equipos === '' || !is_numeric($equipos) || (int)$equipos <= 0) {
        $errores[] = "Introduce un número válido de equipos.";
    }

    if ($horas === '' || !is_numeric($horas) || (int)$horas <= 0) {
        $errores[] = "Introduce un número válido de horas.";
    }

    // Condicional extra, por ejemplo si quieres validar que el tipo sea uno de los permitidos
    if (!in_array($tipo, ['Hardware', 'Software', 'Red'], true)) {
        $errores[] = "Tipo de incidencia no válido.";
    }

    return $errores;

}



}

}