<?php

class AutenticarController {

    public function showLogin() {

    // Si el usuario ya ha iniciado sesión, lo redirigimos al index.php
    if (isset($_SESSION['usuario'])) {
        header("Location: /views/index.php");
        exit;
    }
    // si no hay sesion iniciada, enviamos el formulario de login
    require_once "app/views/login.php";
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
            header("Location: /views/index.php");
            exit;

        } else {
            // si no es correcto, redirigimos al login.php con un mensaje de error
            $errores[] = "Usuario o contraseña incorrectos";
}
    return $errores;
    }

    public function logout() {
        // destruimos la sesion para cerrar la sesión del usuario
        session_destroy();
        // redirigimos al login.php
        header("Location: login.php");
        exit;
    }
}