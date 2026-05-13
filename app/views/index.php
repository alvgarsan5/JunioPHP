<?php
session_start();

    // recupero los datos de las cookies para mostrarlos luego donde muestro el resumen ,
    // los tengo que poner encima de las variables vacias para que no me salte error
    $aulaCookie = $_COOKIE['aula'] ?? "";
    $incidenciaCookie = $_COOKIE['incidencia'] ?? "";
    // inicializo las variables vacías para que no me salgan errores ni warnings en index.php cuando me redirijo del login
    $aula = "";
    $equipos = "";
    $incidencias = "";
    $horasTotales = "";
    $nivelIncidencia = "";
    $mensajeElegido = "";
    $recomendaciones = [];
    $pasosProtocolo = [];


    if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $aula = $_POST['aula'];
    $equipos = $_POST['equipos'];
    $incidencias = $_POST['incidencias'];
    $horasTotales = $_POST['horasTotales'];
    $nivelIncidencia = nivelCriticidad($horasTotales, $equipos);
    $mensajeElegido = "";
    $resumen = "";

    // Solo si el usuario envió datos, actualizamos las cookies para la próxima vez durante 1 hora , para poder verlas la proxima vez
    setcookie("aula", $aula, time() + 3600);
    setcookie("incidencia", $incidencias, time() + 3600);    
    



     // array asociativo para las recomendaciones dependiendo del tipo de incidencia
    $recomendaciones = array(
        "red" => "Revisa los cables de red que no esten muy doblados o si estan bien conectador al interruptor.",
        "hardware" => "Comprueba si la fuente de alimentación falla o hay piezas sueltas( suele pasar).",
        "software" => "Fijate en actualizaciones del sistema, puede que falta alguna por instalar ."
        );


    $pasosProtocolo = array(
        "Abrir ticket en el sistema del TIC.",
        "Avisar a Marián de la hora siguiente del estado del aula.",
        "Probar a reiniciar",
        "Comprobar que no haya ningún cable pelado expuesto.",
        "Dejar un post-it en la torre del ordenador avisando de la incidencia."
        );

        
        switch ($incidencias) {
            case "red":
                $mensajeElegido = $recomendaciones["red"];
                break;
            case "hardware":
                $mensajeElegido = $recomendaciones["hardware"];
                break;
            case "software":
                $mensajeElegido = $recomendaciones["software"];
                break;
        }


        if ($equipos <= 0 || !is_numeric($equipos)) {
            echo "El número no puede ser menor a 0 o no estas poniendo el tipo de valor correcto";
            return;
        }

        if ($horasTotales == 0 || !is_numeric($horasTotales)) {
            echo "El número no puede ser menor a 0 o no estas poniendo el tipo de valor correcto";
            return;
    }


    $resumen = "Hoy en el aula $aula hay $equipos equipos afectados principalmente por problemas de $incidencias y se han perdido $horasTotales horas de clase. Nivel de criticidad: $nivelIncidencia.";

    $_SESSION['resumen'] = $resumen;

    }


    function nivelCriticidad($horasTotales, $equipos)
    {
        if ($horasTotales <= 8 && $equipos >= 6) {
            return "Bajo";
        } elseif ($horasTotales >= 4 && $equipos >= 4) {
            return "Medio";
        } elseif ($horasTotales >= 3 && $equipos >= 3) {
            return "Alto";
        } else {
            return "por determinar, prueba a hacer el calculo otra vez :)";

        }
    }

    


    ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Calculadora de Incidencias</title>
</head>

<body>
    <h1>Calculadora de Incidencias del IES CAMP DE MORVEDRE</h1>

    <form action="index.php" method="POST">
        <!-- Ejemplo 1: Campo de texto para el Aula -->
        <div>
            <label for="aula">Aula:</label>
            <input type="text" id="aula" name="aula" required value="<?php echo htmlspecialchars($aulaCookie); ?>">
        </div>
        <br>

        <div>
            <label for="equipos">Número de equipos con incidencia.:</label>
            <input type="number" id="equipos" name="equipos" required>
        </div>
        <br>

        <div>
            <label for="incidencias">Tipo de incidencia principal (select: “Red”, “Hardware”, “Software”).</label>
            <select id="incidencias" name="incidencias">
                <option value="red" <?= $incidenciaCookie == 'red' ? 'selected' : '' ?>>“Red”</option>
                <option value="hardware" <?= $incidenciaCookie == 'hardware' ? 'selected' : '' ?>>“Hardware”</option>
                <option value="software" <?= $incidenciaCookie == 'software' ? 'selected' : '' ?>>“Software”</option>
            </select>
        </div>
        <br>

        <div>
            <label for="horasTotales">Horas totales de clase afectadas.:</label>
            <input type="number" id="horasTotales" name="horasTotales" required>
        </div>
        <br>
        <button type="submit">Enviar Datos</button>
    </form>
    <!-- creo un segundo formullario para que nos lleve al logout y ahí cerrar sesión y reedirigir al login.php. -->
    <form action="logout.php" method="POST">
    <button type="submit">Cerrar sesión</button>
    </form>


    <?php if (isset($_SESSION['resumen'])) { ?>
        <p><?php echo "En la última sesión, el usuario  " . $_SESSION['usuario'] . "
        nos ha informado que las incidencias en la última sesión fueron estaS: " . $_SESSION['resumen']; ?></p>
        <?php } ?>

    <p>
        Como recomendación te diremos que: <?= htmlspecialchars($mensajeElegido) ?>
    </p>

    <p>Protocolo de actuación paso a paso:</p>

    <?php foreach ($pasosProtocolo as $paso): ?>
        <p><?= htmlspecialchars($paso) ?></p>
    <?php endforeach; ?>


    <?php if (isset($_SESSION['usuario'])) { ?>
        <p><?php echo "bienvenido " . $_SESSION['usuario']; ?></p>
        <?php } ?>











</body>

</html>