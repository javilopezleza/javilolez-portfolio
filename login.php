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
            <a class="navbar-brand icono" href="index.php"><img src="img/icono.jpg" alt="Icono de la web"><p class="ini">Inicio</p></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav menu">
                </div>
            </div>
            <div class="user">
                <?php

            //Funciones admin

            if (isset($_SESSION['is_admin'])) {

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

                //Funciones usuario
            }elseif(isset($_SESSION['is_user']) == 1){
                echo "<i id ='user' class='bi bi-person-circle'></i></a>";
                echo ("<div id='adminUses' class='adminUses' style='display:none;'>" .
                  "<div class='enlaces'>" .
                  "<a href='cerrarSesion.php?cerrar=true'>Cerrar sesión</a>" .
                  "</div>" .
                  "</div>");
              }

                ?>
            </div>
        </div>
    </nav>

        <!--Hay un usuario creado
            Usuario: user
            Contraseña: usuario -->

    <form class="logForm" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
        <fieldset>
            <legend>Login</legend>
            <div class="name">
                <label for="nick">Nick:</label>
                <input type="text" value="<?= $usuario ?>" class="user" name="nick" id="nick" placeholder="Nick">
            </div>
            <div class="pass">
                <label for="pass">Password:</label>
                <input type="password" class="pass" name="pass" id="pass" placeholder="Contraseña">
            </div>
            <!-- <div class="log-check">
                <input type="checkbox" class="check" name="ml" id="ml">
                <p>Mantenerme conectado</p>
            </div> -->

            <div class="submit">
                <input type="submit" name="conectar" id="conectar" value="Conectar">
            </div>
        </fieldset>
    </form>

    <?php

    //Extrae datos de la base de datos para comprobar si coinciden

    if (isset($_POST['conectar'])) {
        include_once "functions.php";

        $nick  = $_POST['nick'];
        $pass = $_POST['pass'];

        $conexion = conexion();
        $sentencia = $conexion->prepare("SELECT nick, pass, is_admin, is_user
                                        FROM usuario
                                        WHERE nick = ?");

        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $sentencia->bindParam(1, $nick);


        $sentencia->execute();

        $numFilas = $sentencia->rowCount();



        if ($numFilas > 0) {
            $fila = $sentencia->fetch();
            if (password_verify($pass, $fila['pass'])) {

                if ($fila['is_admin'] == 1) {
                    $_SESSION['is_admin'] = 1;
                    $mensaje = "<div class='correcto'><p>Usuario correcto, espere.</p></div>";
                    echo $mensaje;
                    echo "<meta http-equiv='refresh' content='1; url=index.php?" . $_SESSION['is_admin'] . "'>";
                } elseif ($fila['is_user'] == 1) {
                    $_SESSION['is_user'] = 0;
                    $mensaje = "<div class='correcto'><p>Usuario correcto, espere.</p></div>";
                    echo $mensaje;
                    echo "<meta http-equiv='refresh' content='1; url=index.php?" . $_SESSION['is_user'] . "'>";
                } else {
                    $mensaje = "<div class='error'><p>Usuario incorrecto, compruebe sus datos</p></div>";
                    echo $mensaje;
                    echo "<meta http-equiv='refresh' content='1.5; url=login.php?'>";
                }
            } else {
                echo "<div class='error'><p>Usuario o contraseña incorrectos</p></div>";
            }
        } else {
            echo "No hay filas";
        }
        $conexion = null;
        $sentencia = null;
    } else {
    }

    ?>

    <script src="js/apps.js"></script>
</body>

</html>
