<?php

class IndexController {

public function verificarUsuario(){
    if(!isset($_SESSION['usuario'])){
        header("Location: /views/login.php");
        exit;
    }
}

}