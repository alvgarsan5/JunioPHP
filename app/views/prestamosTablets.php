<?php
// acuerdate siempreeeeee
session_start();

require_once __DIR__ . '/../controllers/PrestamoController.php';
$controller = new PrestamoController();
$resultado = $controller->validarPrestamo();    
$prestamo = $_SESSION['prestamos'];
$errores = $resultado['errores'];
$datos = $resultado['datos'];
$servicioPrestamos = new PrestamosService();
$tiposPrestamo = $servicioPrestamos->obtenerPrestamo();



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title> Préstamo de Tablets</title>
</head>

<body>

<h1>Prestamos de Tablets del IES CAMP DE MORVEDRE</h1>
    <table border="1">
        <tr>
            <th>Aula</th>
            <th>Número de Tablets</th>
            <th>Horas de Uso</th>
            <th>Tipo de Préstamo</th>
        </tr>
        <?php foreach ($prestamos as $prestamo): ?>
        <tr>
            <td><?php echo htmlspecialchars($prestamo['aula']); ?></td>
            <td><?php echo htmlspecialchars($prestamo['numeroTablets']); ?></td>
            <td><?php echo htmlspecialchars($prestamo['horasUso']); ?></td>
            <td><?php echo htmlspecialchars($prestamo['prestamo']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>