<?php

session_start();

include_once "functions.php";

$conexion = conexion();

$sentencia = $conexion->prepare("SELECT * 
                                FROM imagenes
                                ORDER BY id ASC");
$sentencia->execute();

$numFilas = $sentencia->rowCount();


if ($numFilas >= 1) {

    $fila = $sentencia->fetch();
}

if (isset($_POST['submit'])) {


    include_once "functions.php";


    $id = $_POST['id'];
    // $titulo = $_POST['titulo'];
    // $alt = $_POST['alt'];
    $aceptado = $_POST['aceptado'];




    $conexion = conexion();

    $sentencia = $conexion->prepare("UPDATE imagenes SET
                                     aceptado = ? 
                                     WHERE id=" . $id);

    $sentencia->bindParam(1, $id);
    $sentencia->bindParam(2, $aceptado);


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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light justify-content-around sticky-top">
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
        <main>
            <h1>Todos los proyectos</h1>
            <span class="to-top"> <i class="bi bi-chevron-up"></i> </span>
            <div class="container-fluid">

                    <?php

                    if ($numFilas >= 1) {
                    ?>
                        <table class="table table-striped">
                            <thead>
                                <th scope="col">ID</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Alt</th>
                                <th scope="col">Enlace</th>
                                <th scope="col">Titulo enlace</th>
                                <th scope="col">Modificar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                                <?php
                                do {
                                    echo "<tr>";
                                    echo "<td> <input type='text' value='" . $fila['id'] . "' name='id' readonly></td>";
                                    echo "<td> <img class='min'src='img/imgbdd/" . $fila['nombre'] . "'readonly ></td>";
                                    echo "<td> <input type='text' id='titulo' value='" . $fila['titulo'] . "' name='titulo'readonly></td>";
                                    echo "<td> <input type='text' value='" . $fila['alt'] . "' name='alt' id='alt'readonly></td>";
                                    echo "<td> <input type='text' value='" . $fila['enlace'] . "' name='url' id='url'readonly></td>";
                                    echo "<td> <input type='text' value='" . $fila['titulo_enlace'] . "' name='titulo_enlace' id='titulo_enlace' placeholder='Titulo del enlace'readonly></td>";
                                    echo "<td> <input type='text' value='" . $fila['aceptado'] . "' name='titulo_enlace' id='titulo_enlace' placeholder='Titulo del enlace'readonly></td>";
                                    echo "<td>";
                                    echo "<a class='btn btn-info' href='modify.php?id=" . $fila['id']."'>Modificar</a></input>"; //Enlace necesario para poder modificar el elemento por ID
                                    echo "<a class='btn btn-danger my-2' href='delete.php?id=" . $fila['id']."'>Eliminar</a></input>";
                                    
                                    echo "<td>";
                                } while ($fila = $sentencia->fetch());
                            } else {
                                echo "<div class='error'><p>No hay proyectos</p></div>";
                            }
                                ?>
                                </form>
                            </tbody>
                        </table>

                </div>
            </div>
        </main>
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
    echo "<div class='error'><p>No tienes permisos suficientes para estar aquí y serás redirigido</p></div>";
    echo "<meta http-equiv='refresh' content='1; url=index.php?'>";
}

    ?>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="js/apps.js"></script>
    </body>

    </html>