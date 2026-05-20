<?php
session_start();

// si no hay usuario detectado en la sesión, redirigimos al login.php para que se loguee antes de acceder al index.php
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>
<h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h1>

<p>Que quieres hacer en el día de hoy:</p>

<ul>
    <li><a href="formularioIncidencia.php">Crear nueva incidencia</a></li>
    <li><a href="mostrarIncidencias.php">Mostrar incidencias recientes</a></li>
    <li><a href="logout.php">Cerrar sesión</a></li>
</ul>