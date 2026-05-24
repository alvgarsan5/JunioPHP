<?php

class PrestamoController {

public function validarPrestamo(){
// creamos un array de errores antes del condicional
//  para almacenar los errores de validación del formulario
$errores = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    return ['errores' => [], 'datos' => []];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1.Validacion basico del formulario
    $aula = $_POST['aula'] ?? '';
    $numeroTablets = $_POST['numeroTablets'] ?? '';
    $horasUso = $_POST['horasUso'] ?? '';
    $prestamo = $_POST['prestamo'] ?? '';
    

    if ($aula === '') {
        $errores[] = "Selecciona un aula.";
    }

    if ($numeroTablets === '' || !is_numeric($numeroTablets) || (int)$numeroTablets <= 0) {
        $errores[] = "Introduce un número válido de tablets.";
    }

    if ($horasUso === '' || !is_numeric($horasUso) || (int)$horasUso <= 0) {
        $errores[] = "Introduce un número válido de horas de uso.";
    }

    if ($prestamo === '') {
        $errores[] = "Selecciona un tipo de préstamo.";
    }

    if(empty($errores)) {
        $servicio = new PrestamosService();
        $servicio->crearPrestamo($aula, $numeroTablets, $horasUso, $prestamo);

        $_SESSION['prestamos'][] = [
        'aula' => $aula,
        'numeroTablets' => $numeroTablets,
        'horasUso' => $horasUso,
        'prestamo' => $prestamo
        ];
    }

    // Si no hay errores, podemos procesar el préstamo, recogemos los datos del formulario
    // que ha n sido puesto en cada campo del formulario y los devolvemos en un array para que el
    // formulario pueda mostrar los datos introducidos.
    return [   
    'errores' => $errores,
    'datos' => [
        'aula' => $aula,
        'numeroTablets' => $numeroTablets,
        'horasUso' => $horasUso,
        'prestamo' => $prestamo
    ]
];
}

}
}

