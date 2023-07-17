<?php

$array = ["Coche" => "rojo", "Moto" => "verde", "Avión" => "azul", "Tren" => "gris", "Autobus" => "naranja"];

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array asociativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container menu ">
                <a class="navbar-brand" href="index.php">PHP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link enlace" aria-current="page" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link enlace" href="array_indexado.php">Array indexado</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link enlace" href="array_asociativo.php">Array asociativo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link enlace" href="Clases.php">Clases</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>

        
        <div class="listado">
            <h1>Arrays asociativos</h1>

            <div class="todo">
                <h2>Todos los vehiculos</h2>
                <ul>

                    <?php
                foreach ($array as $vehiculo => $color) {
                    echo "<li>El vehiculo <strong>$vehiculo</strong> es de color: <strong>$color</strong></li>";
                }
                ?>
                </ul>
            </div>

            <br>

            <div class="tren">
                <h2>Tren solo</h2>
                <?php
                foreach ($array as $vehiculo => $color) {
                    if ($vehiculo == "Tren") {
                        echo "El color del Tren es: <strong>$color</strong> <br>";
                    }
                }
                ?>
            </div>

        </div>

    </main>

    <footer>
        &copy;Javier López Lezama examen PHP.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>