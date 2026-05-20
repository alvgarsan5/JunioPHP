<?php

require_once __DIR__ . '/../controllers/IncidenciasController.php';
require_once __DIR__ . '/../Servicios/InicidenciasService.php';


// iniciamos sesion para poder acceder a los datos del usuario logueado y mostrar el
$controlador = new IncidenciasController();
$errores = $controlador->validarFormulario();
$servicioIncidencia = new IncidenciaService();
$tiposAula = $servicioIncidencia->obtererAula();
$tiposIncidencia = $servicioIncidencia->obtererTipoIncidencia();


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Calculadora de Incidencias</title>
</head>

<body>
    <h1>Calculadora de Incidencias del IES CAMP DE MORVEDRE</h1>

    <form action="index.php" method="POST">
        <!-- Ejemplo 1: Campo de texto para el Aula -->
        <div>
            <label for="aula">Aula:</label>
            <select id="aula" name="aula" required>
            <option value="" selected disabled>Selecciona un aula</option>
            <?php foreach ($tiposAula as $aula): ?>
            <option value="<?php echo htmlspecialchars($aula); ?>">
            <?php echo htmlspecialchars($aula); ?>
            </option>
            <?php endforeach; ?>
            </select>
        </div>
        <br>

        <div>
            <label for="equipos">Número de equipos con incidencia.:</label>
            <input type="number" id="equipos" name="equipos" required
            value="<?php echo htmlspecialchars($equipos ?? ''); ?>">
        </div>
        <br>

        <div>
            <label for="incidencias">Tipo de incidencia principal (select: “Red”, “Hardware”, “Software”).</label>
            <select id="incidencias" name="incidencias" required>
            <option value="" selected disabled>Selecciona un tipo de incidencia</option>
            <?php foreach ($tiposIncidencia as $tipo): ?>
            <option value="<?php echo htmlspecialchars($tipo); ?>">
            <?php echo htmlspecialchars($tipo); ?>
            </option>
            <?php endforeach; ?>
            </select>
        </div>
        <br>

        <div>
            <label for="horasTotales">Horas totales de clase afectadas.:</label>
            <input type="number" id="horasTotales" name="horasTotales" required
            value="<?php echo htmlspecialchars($horasTotales ?? ''); ?>">
        </div>
        <br>
        <button type="submit">Enviar Datos</button>
    </form>
    <!-- creo un segundo formullario para que nos lleve al logout y ahí cerrar sesión y reedirigir al login.php. -->
    

    <?php if (!empty($errores)): ?>
    <?php foreach ($errores as $error): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endforeach; ?>
<?php endif; ?>




</body>

</html>