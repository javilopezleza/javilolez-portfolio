<?php
include "functions.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehiculos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<span class="to-top"> <i class="bi bi-chevron-up"></i> </span>

    <nav class="navbar navbar-expand-lg navbar-light justify-content-around sticky-top">
        <div class="container">
            <a class="navbar-brand icono" href="#">UMF0492</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav menu">
                    <a class="nav-link en" aria-current="page" href="index.php">Inicio</a>
                    <a class="nav-link en" href="conductores.php">Conductores</a>
                    <a class="nav-link en" href="vehiculos.php">Vehiculos</a>
                    <a class="nav-link en" href="crud.php">CRUD</a>
                    <a class="nav-link en" href="rest.php">REST</a>
                </div>
            </div>
        </div>
    </nav>


    <?php

    $conexion = conexion();

    $sentencia = $conexion->prepare("SELECT vehiculo.matricula, vehiculo.modelo, conductor.nombre, vehiculo_conductor.fecha
                                     FROM vehiculo, vehiculo_conductor
                                     INNER JOIN conductor ON conductor.id = vehiculo_conductor.conductor
                                     ORDER BY vehiculo_conductor.fecha DESC");
    $sentencia->execute();

    $numFilas  = $sentencia->rowCount();

    if ($numFilas > 1) {
        $fila = $sentencia->fetch();
    }
    ?>

    <table class="table table-striped">
        <tr>
            <th>Matricula</th>
            <th>Modelo</th>
            <th>Nombre del conductor</th>
            <th>Fecha</th>
        </tr>

        <?php
        do {
            echo "<tr>
            <td>{$fila['matricula']}</td>
            <td>{$fila['modelo']}</td>
            <td>{$fila['nombre']}</td>
            <td>{$fila['fecha']}</td>
            </tr>";
        } while ($fila = $sentencia->fetch());

        ?>
    </table>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="js/apps.js"></script>

</body>

</html>