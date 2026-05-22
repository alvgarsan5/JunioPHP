<?php

class AutenticarService {

    public function validarUsuario($usuario, $contrasenya) {
        $usuarioParaLogin = "Alvaro";
        $hashalmacenado = '$2y$10$2o6U5FupqymkXd3c1vSbjOg0h0GI2PBiCV9PvXjMdwFqiZWdZiDWy';
         // la otra forma es asi password_hash("Alvaro1234", PASSWORD_DEFAULT);

    if ($usuario === $usuarioParaLogin && password_verify($contrasenya, $hashalmacenado)) {
    return true;
    } else {
        return false;
        }
    }
}
