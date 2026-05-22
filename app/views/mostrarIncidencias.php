<?php   
session_start();
require_once __DIR__ .  "/../controllers/IncidenciasController.php";
require_once __DIR__ .  "/../Servicios/IncidenciaService.php";

// aqui vamos a hacer un html imprimiendo cada una de las incidencias que hay 
// guardadas en local con un foreach y mostrando el aula, el tipo de incidencia, el número de equipos afectados y las horas totales de clase afectadas por cada incidencia. Para ello, vamos a llamar al servicio de incidencias para obtener todas las incidencias y luego las imprimimos en el html.

$controlador = new IncidenciasController();
$incidencias = $controlador->mostrarIncidencias();


// for each para imprimir cada una de las incidencias que hay guardadas en local con un foreach.
?>
<h1>Incidencias recientes</h1>
<?php if (empty($incidencias)): ?>
    <p>No hay incidencias recientes.</p>
<?php else: ?>
    <ul>
        <?php foreach ($incidencias as $incidencia): ?>
            <li>
                <strong>Aula:</strong> <?php echo htmlspecialchars($incidencia['aula']); ?>,
                <strong>Tipo de incidencia:</strong> <?php echo htmlspecialchars($incidencia['tipo']); ?>,
                <strong>Número de equipos afectados:</strong> <?php echo htmlspecialchars($incidencia['equipos']); ?>,
                <strong>Horas totales de clase afectadas:</strong> <?php echo htmlspecialchars($incidencia['horas']); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<button type="submit"><a href="index.php">Volver al inicio</a></button>
