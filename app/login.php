<?php
    session_start();

    
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $usuario = $_POST['usuario'];
        $contrasenya = $_POST['contrasenya'];

        $usuarioParaLogin = "Alvaro";
        $hashalmacenado =  password_hash("Alvaro1234", PASSWORD_DEFAULT);

        if($usuario === $usuarioParaLogin && password_verify($contrasenya,$hashalmacenado)){
            $_SESSION['usuario'] = $usuario;
            header("Location: index.php");
            exit;
            
        } else {
            $error = "contraseña o usuario erróneo, vuelvo a tenerlo porfa";
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