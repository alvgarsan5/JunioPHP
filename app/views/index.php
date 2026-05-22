<?php
session_start();


?>
<h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h1>

<p>Que quieres hacer en el día de hoy:</p>

<ul>
    <li><a href="formularioIncidencia.php">Crear nueva incidencia</a></li>
    <li><a href="mostrarIncidencias.php">Mostrar incidencias recientes</a></li>
    <li><a href="logout.php">Cerrar sesión</a></li>
</ul>