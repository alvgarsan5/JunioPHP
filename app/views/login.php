<?php
require_once __DIR__ .  "/../controllers/AutenticarController.php";
require_once __DIR__ .  "/../Servicios/AutenticarService.php";
    session_start();
    $controlador = new AutenticarController();
    $vistas = $controlador->showLogin();
    $errores = $controlador->login();
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
            <input type="text" id="usuario" name="usuario" required
            value="<?php echo htmlspecialchars($_COOKIE['ultimo_usuario'] ?? ''); ?>">
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
    <!-- si hay errores, los mostramos -->
    <ul>
        <?php foreach ($errores as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>

</body>
</html>