<?php
// acuerdate siempreeeeee
session_start();

require_once __DIR__ . '/../controllers/PrestamoController.php';
require_once __DIR__ . '/../Servicios/PrestamosService.php';

$controller = new PrestamoController();
$resultado = $controller->validarPrestamo();    
$errores = $resultado['errores'];
$datos = $resultado['datos'];
// lo ponemos asi para que no salte el warning de que no existe esta variable 
$tipoPrestamo =  $datos['prestamo'] ?? "";
$servicioPrestamos = new PrestamosService();
$tiposPrestamo = $servicioPrestamos->obtenerPrestamo();
$recomendacion = $servicioPrestamos->obtenerRecomendaciones($tipoPrestamo);




?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Préstamo de Tablets</title>
</head>
<body>

    <h1>Préstamo de Tablets del IES CAMP DE MORVEDRE</h1>

    <form action="prestamosTablets.php" method="POST">
        
        <div>
            <label for="aula">Aula:</label>
            <input type="text" id="aula" name="aula" required>
        </div>

        <br>

        <div>
            <label for="numeroTablets">Número de Tablets:</label>
            <input type="number" id="numeroTablets" name="numeroTablets"  required>
        </div>

        <br>

        <div>
            <label for="horasUso">Horas de uso:</label>
            <input type="number" id="horasUso" name="horasUso"  required>
        </div>

        <br>

        <div>
            <label for="prestamo">Tipo de préstamo:</label>
            <select id="prestamo" name="prestamo" required>
                <option value="">Selecciona una opción</option>
                <option value="clase">Clase</option>
                <option value="guardia">Guardia</option>
                <option value="examen">Examen</option>
            </select>
        </div>

        <br>

        <button type="submit">Guardar préstamo</button>
        <button type="submit"><a href="index.php">Volver al inicio</a></button>
        <button type="submit"><a href="mostrarTablets.php">Volver al inicio</a></button>

    </form>


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
        <li>Tipo de prestamo: <?php echo htmlspecialchars($datos['prestamo']); ?></li>
        <li>Horas de uso: <?php echo htmlspecialchars($datos['horasUso']); ?></li>
        <li>Horas totales de tablets: <?php echo htmlspecialchars($datos['numeroTablets']); ?></li>
        <br>
        <li>Recomendaciones según prestamo: <?php echo htmlspecialchars($recomendacion); ?></li>
    </ul>
<?php endif; ?>
</body>
</html>