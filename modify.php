<?php

session_start();


if (isset($_GET['id'])) {
    include_once "functions.php";

    $conexion = conexion();

    $sentencia = $conexion->prepare("SELECT * 
                                FROM imagenes
                                WHERE id = ?
                                ORDER BY id ASC");

    $sentencia->setFetchMode(PDO::FETCH_ASSOC);

    $sentencia->bindParam(1, $_GET['id']);

    $sentencia->execute();

    $numFilas = $sentencia->rowCount();


    if ($numFilas >= 1) {

        $fila = $sentencia->fetch();
    }
}

if (isset($_POST['modificar'])) {


    include_once "functions.php";


    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $alt = $_POST['alt'];
    $titulo_enlace = $_POST['titulo_enlace'];
    $aceptado = $_POST['aceptado'];


    $conexion = conexion();

    /*
    Modifica los proyectos para poder mostrarlos en el index 
    (Cambiar el aceptado a 1 si quieres que se muestre o a 0 si no quieres mostrarlo)
    */

    $sentencia = $conexion->prepare("UPDATE imagenes SET
                                     titulo = ?,
                                     alt = ?,
                                     titulo_enlace = ?,
                                     aceptado = ? 
                                     WHERE id= ?");


    $sentencia->bindParam(1, $titulo);
    $sentencia->bindParam(2, $alt);
    $sentencia->bindParam(3, $titulo_enlace);
    $sentencia->bindParam(4, $aceptado);
    $sentencia->bindParam(5, $fila['id']);


    $sentencia->execute();

    $numFilas = $sentencia->rowCount();

    if ($numFilas > 0) {

        echo "Imagen actualizada";
        echo "<meta http-equiv='refresh' content='0; url=mostrar.php'>";
    } else {
        echo "Imagen no actualizada";
    }
}

if (isset($_SESSION['is_admin'])) {

?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mostrar proyectos</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-light justify-content-around">
            <div class="container">
                <a class="navbar-brand icono" href="index.php"><img src="img/icono.jpg" alt="Icono de la web"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav menu">
                        <!-- <a class="nav-link" aria-current="page" href="edicion/index.html">Edición</a>
          <a class="nav-link" href="examen/index.html">Examen</a>
          <a class="nav-link" href="cliente/index.html">Examen Cliente</a>
          <a class="nav-link" href="servidor/index.php">Examen PHP</a> -->
                        <!-- <a class="nav-link" href="loginAdmin.php">Log in</a> -->
                    </div>
                </div>
                <div class="user">
                    <?php

                    // Si existe la sesion de administrador muestra el icono para acceder a las funciones de administrador
                    // en caso de ser usuario normal solo prodrás cerrar sesión


                    echo "<i id ='user' class='bi bi-person-circle'></i></a>";
                    echo ("<div id='adminUses' class='adminUses' style='display:none;'>" .
                        "<div class='enlaces'>" .
                        "<a href='upProject.php?" . $_SESSION['is_admin'] . "'>Subir proyectos</a>" .
                        "<a href='mostrar.php?" . $_SESSION['is_admin'] . "'>Mostrar proyectos</a>" .
                        "<a href='registrar.php?" . $_SESSION['is_admin'] . "'>Registrar usuario</a>" .
                        "<a href='proyectos.php?" . $_SESSION['is_admin'] . "'>Ver todos los proyectos</a>" .
                        "<a href='cerrarSesion.php?cerrar=true'>Cerrar sesión</a>" .
                        "</div>" .
                        "</div>");

                    ?>
                </div>
            </div>
        </nav>


        <?php

        if ($numFilas >= 1) {
            if ($fila['aceptado'] == 0 || $fila['aceptado'] == 1) {

        ?>
                <table class="table table-striped">
                    <thead>
                        <th scope="col">ID</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Alt</th>
                        <th scope="col">Enlace</th>
                        <th scope="col">Titulo enlace</th>
                        <th scope="col">Aceptado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="#" method="post">
                    <?php
                    do {
                        echo "<tr>";
                        echo "<td> <input type='text' value='" . $fila['id'] . "' name='id' readonly></td>";
                        echo "<td> <img class='mid' src='img/imgbdd/" . $fila['nombre'] . "'</td>";
                        echo "<td> <input type='text' id='titulo' value='" . $fila['titulo'] . "' name='titulo'></td>";
                        echo "<td> <input type='text' value='" . $fila['alt'] . "' name='alt' id='alt'></td>";
                        echo "<td> <input type='text' value='" . $fila['enlace'] . "' name='url' id='url'></td>";
                        echo "<td> <input type='text' value='" . $fila['titulo_enlace'] . "' name='titulo_enlace' id='titulo_enlace' placeholder='Titulo del enlace'></td>";

                        echo "<td>";
                        echo   "<select name='aceptado' id='aceptado'>
                                        <option value='0'>0</option>
                                        <option value='1'>1</option>
                                    </select>
                                    </td>
                                    <td><input class='btn btn-success' type='submit' name='modificar' id='modificar' value='Guardar'></td>";
                    } while ($fila = $sentencia->fetch());
                    echo "</>";
                }
            } else {
                echo "<div class='error'><p>No hay nada para validar</p></div>";
            }
                    ?>
                        </form>

                    </tbody>
                </table>
            <?php
        } else {

            ?>

                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Mostrar proyectos</title>
                    <link rel="stylesheet" href="css/style.css">
                </head>
            <?php
            echo "<div class='error'><p>No tienes permisos suficientes para estar aquí</p></div>";
        }

            ?>

    <script src="js/apps.js"></script>
    </body>

    </html>