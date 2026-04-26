<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $usuario = $_POST['usuario'];
        $contrasenya = $_POST['contrasenya'];

        $usuarioParaLogin = "Alvaro";
        $contrasenyaParaLogin = "Alvaro1234";

        if($usuario === $usuarioParaLogin && $contrasenya === $contrasenyaParaLogin){
            $_SESSION['usuario'] = $usuario;
            header("Location: incidencias.php");
            exit;
            
        } elseif ($contrasenya != $contrasenyaParaLogin) {
            $error = "Contraseña incorrecta, por  favor vuelve a intentarlo";

        } elseif ($usuario != $usuarioParaLogin){
            $error = "Usuario incorrecto o no registrado, por  favor vuelve a intentarlo";
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form   method="POST">
        <div>
            <label for="usuario">LOGIN USUARIO:</label>
        <br>


        <div>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>
        </div>
        <br>

        <div>
            <label for="contrasenya">Contraseña:</label>
            <input type="password" id="contrasenya" name="contrasenya" required>
        </div>
        <br>

        <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
        <?php } ?>

        <button type="submit">Entrar</button>
    </form> 


</body>
</html>