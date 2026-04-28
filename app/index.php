<?php
session_start();
        // inicializo las variables vacías para que no me salgan errores ni warnings en idex.php cuando me redirijo del login
        $aula = "";
        $equipos = "";
        $incidencias = "";
        $horasTotales = "";
        $nivelIncidencia = "";
        $mensajeElegido = "";
        $recomendaciones = [];
        $pasosProtocolo = [];
        $resumen = "";

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
       

        $recomendaciones = array(
            "red" => "Revisa los cables de red que no esten muy doblados o si estan bien conectador al interruptor.",
            "hardware" => "Comprueba si la fuente de alimentación falla o hay piezas sueltas( suele pasar).",
            "software" => "Fijate en actualizaciones del sistema, puede que falta alguna por isntalar ."
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

    $resumen = "Hoy en el aula $aula hay $equipos equipos afectados principalmente por problemas de $incidencias y se han perdido $horasTotales horas de clase. Nivel de criticidad: $nivelIncidencia.";

    $_SESSION['resumen'] = $resumen;


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
            <input type="text" id="aula" name="aula" required>
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
                <option value="red">“Red”</option>
                <option value="hardware">“Hardware”</option>
                <option value="software">“Software”</option>
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