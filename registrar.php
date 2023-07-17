<?php

session_start();

//Almacena el nombre de usuario en caso de que la contraseña sea incorrecta

if (isset($_POST['enviar'])) {

    if (isset($_POST['nick'])) {
        $usuario = ($_POST['nick']);
    } else {
        $usuario = "";
    }

    if (isset($_POST['pass'])) {
        $pass = ($_POST['pass']);
    } else {
        $pass = "";
    }

    if ($usuario == "" || $pass == "") {
        $mensaje = "<div><p>Usuario o contraseña invalidos</p></div>";
    } else {
        $mensaje = "Validando usuario {$_POST["nick"]}
        y contraseña {$_POST["pass"]}";
    }
} else {
    $usuario = "";
    $pass = "";
}

// if (isset($_SESSION['is_admin'])) {

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
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

    <h1>Registrar Usuario</h1>
    <form class="logForm" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
        <fieldset>
            <legend>Sign Up</legend>
            <div class="name">
                <label for="nick">Nick:</label>
                <input type="text" value="<?= $usuario ?>" class="user" name="nick" id="nick" placeholder="Nick">
            </div>
            <div class="pass">
                <label for="pass">Password:</label>
                <input type="password" class="pass" name="pass" id="pass" placeholder="Contraseña">
            </div>
            <div class="name">
                <label for="is_admin">Admin:</label>
                <input type="text" class="user" name="is_admin" id="is_admin" placeholder="0 o 1">

            </div>

            <div class="submit">
                <input type="submit" name="enviar" id="enviar" value="Enviar">
            </div>
        </fieldset>
    </form>

    <?php

    //Extrae datos de la base de datos para comprobar si coinciden

    if (isset($_POST['enviar'])) {
        include_once "functions.php";

        $nick  = $_POST['nick'];
        $pass = $_POST['pass'];
        $is_admin = $_POST['is_admin'];

        $nick = strtolower($nick);
        $pass = strtolower($pass);
        //Encriptacion de la contraseña

        $hash = password_hash($pass, PASSWORD_DEFAULT);

        $conexion = conexion();
        $sentencia = $conexion->prepare("INSERT INTO usuario
                                        (id, nick, pass, is_admin)
                                        VALUES (?, ?, ?, ?)");

        $sentencia->bindParam(1, $id);
        $sentencia->bindParam(2, $nick);
        $sentencia->bindParam(3, $hash);
        $sentencia->bindParam(4, $is_admin);




        $sentencia->execute();

        $numFilas = $sentencia->rowCount();

        if ($numFilas > 0) {
            $fila = $sentencia->fetch();

            $_SESSION['nick'] = $nick;


            echo "<meta http-equiv='refresh' content='5; url=index.php?'>";



            $conexion = null;
            $sentencia = null;
        }
    } else {
    }

    ?>


    <?php

    // }else{
    ?>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mostrar proyectos</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <?php
    // echo "<div class='error'><p>No tienes permisos suficientes para estar aquí y serás redirigido</p></div>";
    // echo "<meta http-equiv='refresh' content='1; url=index.php?'>";
    // }

    ?>

    <script src="js/apps.js"></script>
</body>

</html>