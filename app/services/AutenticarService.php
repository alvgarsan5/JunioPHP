<?php

class AuthService {
    // Este servicio se encarga de validar el usuario para el login
    public function validarUsuario($usuario) {
        return $usuario === "Alvaro";
    }
}