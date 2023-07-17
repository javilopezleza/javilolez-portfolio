<?php

session_start();

//Almacena el id y el nick del usuario, descartado por el momento

/*if (isset($_POST['id']) && isset($_POST['nick'])) {

   include_once "functions.php";

   $id = $_POST['id'];
   $nick = $_POST['nick'];

   $conexion = conexion();

   $sentencia = $conexion->prepare("SELECT id, nick, pass
                                  FROM usuarios
                                  WHERE id = ?
                                  AND nick = ?");

   $sentencia->setFetchMode(PDO::FETCH_ASSOC);
   $sentencia->bindParam(1, $id);
   $sentencia->bindParam(2, $nick);

   $sentencia->execute();

   $numFilas = $sentencia->rowCount();

   if ($numFilas > 0) {
     $fila = $sentencia->fetch();
   }
   $sentencia  = null;
   $conexion = null;
 }*/

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LandingPage</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light justify-content-around sticky-top">
    <div class="container">
      <a class="navbar-brand icono" href="#"><img src="img/icono.jpg" alt="Icono de la web"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav menu">
          <!-- <a class="nav-link" aria-current="page" href="edicion/index.html">Edición</a>
          <a class="nav-link" href="examen/index.html">Examen</a>
          <a class="nav-link" href="cliente/index.html">Examen Cliente</a>
          <a class="nav-link" href="servidor/index.php">Examen PHP</a> -->

          <div class="user">

            <?php
            if (isset($_SESSION['is_admin'])) {
              echo "<i id ='user' class='bi bi-person-circle'></i></a>";
              echo ("<div id='adminUses' class='adminUses' style='display:none;'>" .
                "<div class='enlaces'>" .
                "<i id='close' class='bi bi-x close'></i>" .
                "<a href='upProject.php?" . $_SESSION['is_admin'] . "'>Subir proyectos</a>" .
                "<a href='mostrar.php?" . $_SESSION['is_admin'] . "'>Mostrar proyectos</a>" .
                "<a href='registrar.php?" . $_SESSION['is_admin'] . "'>Registrar usuario</a>" .
                "<a href='proyectos.php?" . $_SESSION['is_admin'] . "'>Ver todos los proyectos</a>" .
                "<a href='cerrarSesion.php?cerrar=true'>Cerrar sesión</a>" .
                "</div>" .
                "</div>");
            } elseif (isset($_SESSION['is_user'])) {
              echo "<i id ='user' class='bi bi-person-circle'></i></a>";
              echo ("<div id='adminUses' class='adminUses' style='display:none;'>" .
                "<div class='enlaces'>" .
                "<a href='cerrarSesion.php?cerrar=true'>Cerrar sesión</a>" .
                "</div>" .
                "</div>");
            ?>
          </div>
        <?php
            } else {
              echo "<a class='nav-link' href='login.php'>Log in</a>";
            }
        ?>
        </div>
      </div>
    </div>
  </nav>

  <h1>Bienvenido a mi landingpage</h1>

  <h2>Echa un vistazo a mis proyectos</h2>

  <span class="to-top"> <i class="bi bi-chevron-up"></i> </span>

  <?php
  try {

    include_once "functions.php";

    $conexion = conexion();

    // Extrae los proyectos de la base de datos

    $sentencia = $conexion->prepare("SELECT nombre, titulo, alt, enlace, titulo_enlace
                                 FROM imagenes
                                 WHERE aceptado = 1
                                 ORDER BY id DESC");

    $sentencia->execute();

    $numFilas = $sentencia->rowCount();
  ?>


    <div class='proyectos'>
      <div class="container">

        <?php
        //Bucle while para mostrar los proyectos almacenados en la base de datos

        if ($numFilas >= 1) {
          echo "<div class='row'>";
          while ($fila = $sentencia->fetch()) {


            if ($fila['titulo_enlace'] == "Proximamente" || $fila['titulo_enlace'] == "proximamente") {
              echo ("<div class='card col-3 item' style='width: 28rem';'>
              <img src='img/imgbdd/" . $fila['nombre'] . "' class='card-img-top imgP' alt='" . $fila['alt'] . "'>
              <div class='card-body'>");
            } else {
              echo ("<div class='card col-3 item' style='width: 28rem';'>
              <img src='img/imgbdd/" . $fila['nombre'] . "' class='card-img-top imgP' alt='" . $fila['alt'] . "'>
              <div class='card-body'>
              <h5 class='card-title'>" . $fila['titulo_enlace'] . "</h5>
              <p class='card-text'>" . $fila['alt'] . "</p>
              <a href='" . $fila['enlace'] . "' class='btn btn-outline-primary j'>Ir a " . $fila['titulo_enlace'] . "</a>");
            }
            echo "</div>";
            echo "</div>";
          }
          echo "</div>";
        }
        ?>
      </div>
    </div>

  <?php
    $conexion = null;
    $sentencia = null;
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script src="js/apps.js"></script>

  <script>

  </script>
</body>

</html>