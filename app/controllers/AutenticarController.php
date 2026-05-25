<?php

class AutenticarController {

    public function showLogin() {

    // Si el usuario ya ha iniciado sesión, lo redirigimos al index.php
    if (isset($_SESSION['usuario'])) {
        header("Location: /views/index.php");
        exit;
    }

    // Si el usuario no ha iniciado sesión, mostramos el formulario de login
    

    
    }

    public function login() {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    return []; 
    }
        $errores = [];

        // recogemos el POST del formulario de login
        $usuario = $_POST['usuario'];
        // guardamos el usuario en una cookie para recordar el último usuario que ha iniciado sesión
        setcookie('ultimo_usuario', $usuario, time() + 86400, '/');
        // llamamos al servicio de autenticacion para validar el usuario
        $autentinticarService = new AutenticarService();
        if ($autentinticarService->validarUsuario($usuario, $_POST['contrasenya'])) {
            // si el usuario es correcto, guardamos el usuario en la sesión y redirigimos al index.php
            $_SESSION['usuario'] = $usuario;
            header("Location: /views/prestamosTablets.php");
            exit;

        } else {
            // si no es correcto, redirigimos al login.php con un mensaje de error
            $errores[] = "Usuario o contraseña incorrectos";
}
    return $errores;
    }

public function logout() {
    // iniciamos sesion aqui porque en logout.php no se ha iniciado sesion, y necesitamos iniciar sesion para poder destruirla
    session_start();
    // vaciamos el array de sesión para quitar las variables de sesión y destruimos la sesión 
    $_SESSION = [];
    // destruimos la sesión
    session_destroy();
     // Eliminamos la cookie poniendo fecha de expiración en el pasado
    setcookie('ultimo_usuario', '', time() - 3600, '/');

    header("Location: login.php");
    exit;
}
}