<?php
// acuerdate siempreeeeee
session_start();

require_once __DIR__ . '/../controllers/IncidenciasController.php';
require_once __DIR__ . '/../Servicios/IncidenciaService.php';


// iniciamos sesion para poder acceder a los datos del usuario logueado y mostrar el
$controlador = new IncidenciasController();
$resultado = $controlador->validarFormulario();
$errores = $resultado['errores'];
$datos = $resultado['datos'];
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
    <!-- reenviamos a  formularioIncidencia para que se envíe a sí mismo para mostrar errores sin redirigir -->
    <form action="formularioIncidencia.php" method="POST">
        <!-- Ejemplo 1: Campo de texto para el Aula -->
        <div>
            <label for="aula">Aula:</label>
             <!-- Abrimos el desplegable. id sirve para relacionarlo con el label, name es el nombre con el que llegará en $_POST -->
            <select id="aula" name="aula" required>
            <!-- Esta es la opción inicial vacía.value="" significa que no hay aula elegida todavía.
             selected hace que salga marcada al cargar. disabled impide que el usuario la envíe como opción válida --> 
            <option value="" selected disabled>Selecciona un aula</option>
            <!-- Recorremos el array que hemos creado con distintos tipos de aulas -->
            <?php foreach ($tiposAula as $aula): ?>
                <!-- Aqui damos el value a cada aula, en cad aiteración -->
            <option value="<?php echo htmlspecialchars($aula); ?>">
                <!-- Ejemplo 1: Aquí imprimimos dentro del select las distintas opciones -->
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
        <button type="submit"><a href="index.php">Volver al inicio</a></button>
    </form>
    <!-- creo un segundo formullario para que nos lleve al logout y ahí cerrar sesión y reedirigir al login.php. -->
    

    <?php if (!empty($errores)): ?> 
    <label for="errores">Errores:</label>
    <?php foreach ($errores as $error): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endforeach; ?>
<?php endif; ?>

<!-- mostramos los datos introducidos en el formulario si no hay errores -->
<?php if (empty($errores) && !empty($datos)): ?>
    <h2>Datos introducidos:</h2>
    <ul>
        <li>Aula: <?php echo htmlspecialchars($datos['aula']); ?></li>
        <li>Tipo de incidencia: <?php echo htmlspecialchars($datos['incidencias']); ?></li>
        <li>Número de equipos con incidencia: <?php echo htmlspecialchars($datos['equipos']); ?></li>
        <li>Horas totales de clase afectadas: <?php echo htmlspecialchars($datos['horasTotales']); ?></li>
    </ul>
<?php endif; ?>




</body>

</html>