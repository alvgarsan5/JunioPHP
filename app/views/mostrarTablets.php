<?php
session_start();


require_once __DIR__ . '/../Servicios/PrestamosService.php';
$servicioPrestamos = new PrestamosService();
$prestamos = $servicioPrestamos->obtenerPrestamosRecientes();

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mostrar Préstamos de Tablets</title>

    <!-- for each para imprimir cada uno de los prestamos que hay guardados en local con un foreach.
    // vamos a mostrar el aula, el número de tablets, las horas de uso y el tipo de préstamo de cada préstamo. Para ello, 
    // vamos a llamar al servicio de prestamos para obtener todos los prestamos y luego los imprimimos en el html -->

    <h1>Préstamos de Tablets recientes</h1>
<?php if (empty($prestamos)): ?>
    <p>No hay préstamos de tablets recientes.</p>
<?php else: ?>
    <ul>
        <?php foreach ($prestamos as $prestamo): ?>
            <li>
                <strong>Aula:</strong> <?php echo htmlspecialchars($prestamo['aula']); ?>,
                <strong>Número de Tablets:</strong> <?php echo htmlspecialchars($prestamo['numeroTablets']); ?>,
                <strong>Horas de Uso:</strong> <?php echo htmlspecialchars($prestamo['horasUso']); ?>,
                <strong>Tipo de Préstamo:</strong> <?php echo htmlspecialchars($prestamo['prestamo']); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<button type="submit"><a href="index.php">Volver al inicio</a></button>
<button type="submit"><a href="logout.php">Cerrar sesión</a></button>

</head>

