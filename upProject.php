<?php

session_start();

$path = "../base/img/imgbdd";

if (!file_exists($path)) {

    //creacion de carpeta en caso de que no exista

    mkdir($path, 0777, true);



    if (isset($_POST['subir'])) {

        //Extensiones permitidas
        $extensiones = array(0 => 'image/jpg', 1 => 'image/jpeg', 2 => 'image/png', 3 => 'image/gif', 4 => 'image/webp');

        //Tamaño máximo
        $maxtm = 1024 * 1024 * 8;

        //Ruta del archivo
        $rutaIndex = dirname(realpath(__FILE__));

        //Ruta de origen del archivo
        $rutaOrigen = $_FILES['imagen']['tmp_name'];

        //Ruta de destino del archivo
        $rutaDestino  = $rutaIndex . '/img/imgbdd/' . $_FILES['imagen']['name'];


        //Si cumple todo, se añade la imagen
        if (in_array($_FILES['imagen']['type'], $extensiones)) {

            if ($_FILES['imagen']['size'] < $maxtm) {

                if (move_uploaded_file($rutaOrigen, $rutaDestino)) {
                }
            }
        }
        include "functions.php";

        $nombre = $_FILES['imagen']['name'];
        $titulo = $_POST['titulo'];

        $conexion = conexion();

        //Inserta la imagen a la base de datos

        $sentencia = $conexion->prepare("INSERT INTO imagenes
        (nombre, titulo, alt, enlace, titulo_enlace)
        VALUES (?, ?, ?, ?, ?)");

        $sentencia->bindParam(1, $nombre);
        $sentencia->bindParam(2, $titulo);
        $sentencia->bindParam(3, $alt);
        $sentencia->bindParam(4, $url);
        $sentencia->bindParam(5, $titulo_enlace);

        $sentencia->execute();

        $numFilas = $sentencia->rowCount();

        if ($numFilas > 0) {
            $mensaje = "<div class='correcto'><p>Proyecto añadido con exito</p></div>";
        } else {
            $mensaje = "<div class='error'><p>Proyecto no añadido</p></div>";
        }

        echo "<meta http-equiv='refresh' content='0; url=upImg.php?nick=" . $_GET['nick'] . "'>";
    }
} else {

    if (isset($_POST['subir'])) {
        $extensiones = array(
            0 => 'image/jpg', 1 => 'image/jpeg', 2 => 'image/png',
            3 => 'image/gif', 4 => 'image/webp'
        );

        $maxtm = 1024 * 1024 * 8;


        $rutaIndex = dirname(realpath(__FILE__));

        $rutaOrigen = $_FILES['imagen']['tmp_name'];

        $rutaDestino = $rutaIndex . '/img/imgbdd/' . $_FILES['imagen']['name'];

        if (in_array($_FILES['imagen']['type'], $extensiones)) {

            if ($_FILES['imagen']['size'] < $maxtm) {

                if (move_uploaded_file($rutaOrigen, $rutaDestino)) {
                }
            }
        }
        include "functions.php";

        $nombre = $_FILES['imagen']['name'];
        $titulo = $_POST['titulo'];
        $alt = $_POST['alt'];
        $url = $_POST['url'];
        $titulo_enlace  = $_POST['titulo_enlace'];

        $conexion = conexion();

        if ($nombre == "" || $titulo == "") {
            $mensaje = "<div class='error'><p>Introduce una imagen y un titulo valido</p></div>";
        } else {

            $sentencia = $conexion->prepare("INSERT INTO imagenes
                                        (nombre, titulo, alt, enlace, titulo_enlace)
                                        VALUES (?, ?, ?, ?, ?)");

            $sentencia->bindParam(1, $nombre);
            $sentencia->bindParam(2, $titulo);
            $sentencia->bindParam(3, $alt);
            $sentencia->bindParam(4, $url);
            $sentencia->bindParam(5, $titulo_enlace);

            $sentencia->execute();

            $numFilas = $sentencia->rowCount();

            if ($numFilas > 0) {
                $mensaje = "<div class='correcto'><p>Proyecto añadido con exito</p></div>";
            } else {
                $mensaje = "<div class='error'><p>Proyecto no añadido</p></div>";
            }
        }

        echo $mensaje;
        echo "<meta http-equiv='refresh' content='2.5; url=upProject.php'>";
    }
}

$sentencia = null;
$conexion = null;

if (isset($_SESSION['is_admin'])) {

    ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir proyecto</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light justify-content-around">
        <div class="container">
            <a class="navbar-brand icono" href="index.php"><img src="img/icono.jpg" alt="Icono de la web"></a>

            <!-- <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav menu">
          <a class="nav-link" aria-current="page" href="edicion/index.html">Edición</a>
          <a class="nav-link" href="examen/index.html">Examen</a>
          <a class="nav-link" href="cliente/index.html">Examen Cliente</a>
          <a class="nav-link" href="servidor/index.php">Examen PHP</a>
        </div>
      </div> -->
            <div class="user">
                <?php

                if (isset($_SESSION['is_admin']) == 1) {
                    echo "<i id ='user' class='bi bi-person-circle'></i></a>";
                    echo ("<div id='adminUses' class='adminUses' style='display:none;'>" .
                    "<div class='enlaces'>" .
                    "<a href='upProject.php'>Subir proyectos</a>" .
                    "<a href='mostrar.php'>Mostrar proyectos</a>" .
                    "<a href='registrar.php'>Registrar usuario</a>".
                    "<a href='cerrarSesion.php?cerrar=true'>Cerrar sesión</a>" .
                    "</div>" .
                    "</div>");
                }
                ?>
            </div>
        </div>
    </nav>
    <h1>Subir proyecto</h1>
    <main>
        <form class="logForm" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Subir imagen</legend>
                <div class="img">

                    <label for="imagen">Subir imagen de proyecto:</label>
                    <input type="file" name="imagen" id="imagen">
                </div>

                <div class="tittle">

                    <label for="titulo">Título de la imagen:</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Titulo del proyecto" required>
                </div>

                <div class="alt">

                    <label for="alt">Texto alternativo:</label>
                    <input type="text" name="alt" id="alt" placeholder="Texto alternativo" required>
                </div>

                <div class="url">

                    <label for="url">Url del proyecto</label>
                    <input type="text" name="url" id="url" placeholder="URL" required>
                </div>

                <div class="tittle">

                    <label for="titulo_enlace">Título del proyecto:</label>
                    <input type="text" name="titulo_enlace" id="titulo_enlace" placeholder="Titulo del enlace" required>
                </div>


                <div class="submit">
                    <input type="submit" name="subir" id="subir" value="Subir">
                </div>
            </fieldset>
        </form>
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

</body>

</html>