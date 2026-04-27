<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>HOLA MUNDO</h1>

    <?php if (isset($_SESSION['usuario'])) { ?>
        <p><?php echo "bienvenido " . $_SESSION['usuario']; ?></p>
        <?php } ?>
</body>
</html>