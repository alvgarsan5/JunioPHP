<?php
require_once __DIR__ . '/../Servicios/IncidenciaService.php';
class IncidenciasController {

public function validarFormulario(){

// creamos un array de errores antes del condicional para almacenar los errores de validación del formulario
$errores = [];
// Si el método de la petición no es POST, devolvemos un array vacío de errores y datos.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    return ['errores' => [], 'datos' => []];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {    

    // 1. Validación básica de formulario
    $aula = $_POST['aula'] ?? '';
    $tipo = $_POST['incidencias'] ?? '';
    $equipos = $_POST['equipos'] ?? '';
    $horas = $_POST['horasTotales'] ?? '';
    // con un radio button seria igual pero poniendo null no "";
    // si queremos que sean varias selecciones en un checkbox simplemente en el name ponemos que sea un array y ya esta ej:reservas[];
    

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

     // guardamos la incidencia en el array de sesión
    //El [] al final significa "añadir al array", no sobreescribirlo.
    if(empty($errores)) {
        $servicio = new IncidenciaService();
        $servicio->crearIncidencia($aula, $tipo, $equipos, $horas);

        $_SESSION['incidencias'][] = [
        'aula'    => $aula,
        'tipo'    => $tipo,
        'equipos' => $equipos,
        'horas'   => $horas

        ];


        }

    // Si no hay errores, podemos procesar la incidencia, recogemos los datos del formulario 
    // que ha n sido puesto en cada campo del formulario y los devolvemos en un array para que el
    // formulario pueda mostrar los datos introducidos.
    return [
    'errores' => $errores,
    'datos' => [
        'aula' => $aula,
        'incidencias' => $tipo,
        'equipos' => $equipos,
        'horasTotales' => $horas,
    ],
];

}
}


public function mostrarIncidencias() {
    $servicio = new IncidenciaService();
    return $servicio->obtenerIncidenciasRecientes();
}

}