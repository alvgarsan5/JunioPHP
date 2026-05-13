<?php

class AutenticarController {

    public function showLogin() {

    // iniciamos sesion 
    session_start();
    // Si el usuario ya ha iniciado sesión, lo redirigimos al index.php
    if (isset($_SESSION['usuario'])) {
        header("Location: index.php");
        exit;
    }
    // si no hay sesion iniciada, enviamos el formulario de login
    require_once "app/views/login.php";
    }

    public function login() {
        // inicamos sesion
        session_start();

        // recogemos el POST del formulario de login
        $usuario = $_POST['usuario'];
        // llamamos al servicio de autenticacion para validar el usuario
        if ($usuario === "Alvaro") {
            // si es correcto, guardamos a sesion y lo redirigmos a index.php
            $_SESSION['usuario'] = $usuario;
            header("Location: index.php");
            exit;

        } else {
            // si no es correcto, redirigimos al login.php con un mensaje de error
            $_SESSION['error'] = "Usuario o contraseña incorrectos";
            header("Location: login.php");
            exit;
        }
    }

    public function logout() {
        // iniciamos sesion
        session_start();
        // destruimos la sesion para cerrar la sesión del usuario
        session_destroy();
        // redirigimos al login.php
        header("Location: login.php");
        exit;
    }
}