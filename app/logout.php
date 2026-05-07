<?php
session_start();
$_SESSION =[];// vaciamos la sesion antes de eliminarla para que no quede ningún dato guardado en la sesión.
session_destroy(); // destruyo la sesión para cerrar sesión y que no se pueda acceder a index.php sin loguearse de nuevo
header("Location: login.php"); // enviamos al login.php para que el usuario tenga que volver a loguearse
exit; 