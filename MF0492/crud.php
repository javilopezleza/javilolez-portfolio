<!DOCTYPE html>
<html lang="en">

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

    <section>


        <?php
        $mensaje = "";
        $valormatricula = "";
        $valorbastidor = "";
        $id = "";
        //Establecer conexión
        @$mysqli = new mysqli(
            "localhost",
            "admin",
            "1234",
            "flota"
        );

        if ($mysqli->connect_error) {
            exit("Fallo al conectar a la base de datos: " .
                $mysqli->connect_error);
        } else {
            //Configurar codificación
            $mysqli->set_charset("utf8");
        }

        //Capturar id
        if (isset($_GET["matricula"]))
            $editarMatricula = $_GET["matricula"];
        else $editarMatricula = "";

        //Capturar accion
        if (isset($_GET["accion"]))
            $accion = $_GET["accion"];
        else $accion = "";

        if ($accion == "borrar") {
            //Borrar vehiculo
            $sql = "DELETE FROM vehiculo
            WHERE matricula='$editarMatricula'";

            $mysqli->query($sql);

            if ($mysqli->error) {
                $mensaje = "Fallo al borrar dato: " .
                    $mysqli->error;
            } else {
                //Comprobar filas afectas
                if ($mysqli->affected_rows == 0)
                    $mensaje = "No se ha borrado ningún registro";
                else $mensaje = "vehiculo borrado";
            }
        }

        //Si se ha pulsado el botón de grabar, modificar registro
        if (isset($_POST["grabar"])) {
            //Procesar petición
            if (isset($_POST["matricula"])) $matricula = trim($_POST["matricula"]);
            else $matricula = "";
            if (isset($_POST["bastidor"])) $bastidor = trim($_POST["bastidor"]);
            else $bastidor = "";
            if (isset($_POST["marca"])) $marca = trim($_POST["marca"]);
            else $marca = "";
            if (isset($_POST["modelo"])) $modelo = trim($_POST["modelo"]);
            else $modelo = "";
            if (isset($_POST["proxima_revision"])) $proxima_revision = trim($_POST["proxima_revision"]);
            else $proxima_revision = "";

            if ($matricula == "" || $bastidor == ""|| $marca == "" || $modelo == "" || $proxima_revision == "") {
                $mensaje = "Los campos tienen que estar rellenos";
            } else {
                //Modificar vehiculo
                $sql = "UPDATE vehiculo
                        SET matricula='$matricula', bastidor='$bastidor', marca='$marca', modelo='$modelo', proxima_revision='$proxima_revision'
                        WHERE matricula='$matricula'";

                $mysqli->query($sql);

                if ($mysqli->error) {
                    $mensaje = "Fallo al modificar dato: " .
                        $mysqli->error;
                } else {
                    //Comprobar filas afectas
                    if ($mysqli->affected_rows == 0)
                        $mensaje = "No se ha modificado ningún registro";
                    else $mensaje = "Vehiculo modificado";
                }
            }
        }

        //Si se ha pulsado el botón de nuevo, crear nuevo registro
        if (isset($_POST["nuevo"])) {
            //Procesar petición

            if (isset($_POST["nuevo_matricula"])) $matricula = trim($_POST["nuevo_matricula"]);
            else $matricula = "";
            if (isset($_POST["nuevo_bastidor"])) $bastidor = trim($_POST["nuevo_bastidor"]);
            else $bastidor = "";
            if (isset($_POST["nuevo_marca"])) $marca = trim($_POST["nuevo_marca"]);
            else $marca = "";
            if (isset($_POST["nuevo_modelo"])) $modelo = trim($_POST["nuevo_modelo"]);
            else $modelo = "";
            if (isset($_POST["nuevo_revision"])) $proxima_revision = trim($_POST["nuevo_revision"]);
            else $proxima_revision = "";

            if ($matricula == "" || $bastidor == "" || $marca == "" || $modelo == "" || $proxima_revision == "") {
                $mensaje = "Los campos tienen que estar rellenos";
            } else {
                //Insertar nuevo vehiculo
                $sql = "INSERT INTO `vehiculo`(`matricula`, `bastidor`, marca, modelo, proxima_revision) 
                    VALUES ('$matricula','$bastidor', '$marca', '$modelo', '$proxima_revision')";
                $mysqli->query($sql);

                if ($mysqli->error) {
                    $mensaje = "Fallo al crear nuevo dato: " .
                        $mysqli->error;
                } else {
                    //Comprobar filas afectas
                    if ($mysqli->affected_rows == 0)
                        $mensaje = "No se ha creado ningún registro";
                    else $mensaje = "Nuevo vehiculo creado";
                }
            }
        }

        //Cargar datos para el listado, siempre después de hacer los cambios
        $sql = "SELECT matricula, bastidor, marca, modelo, proxima_revision FROM vehiculo";
        @$resultado = $mysqli->query($sql);

        if ($mysqli->error) {
            $mensaje = "Fallo al leer datos de vehiculos: " .
                $mysqli->error;
        }


        //Cerrar conexión
        $mysqli->close();
        ?>


        <form action='?' method='POST'>
            <table class="table table-striped">
                <thead>

                    <tr>
                        <th>Matricula</th>
                        <th>Bastidor</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Proxima revisión</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                //Cargar datos de vehiculoes
                if (isset($resultado)) {
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        if ($row["matricula"] == $editarMatricula && $accion == "editar") {
                            //Fila con edición
                            //echo "<form action='?' method='POST'>";
                            echo "<tr><td>" . "<input type='text' name='matricula' value='" . $row["matricula"] . "'/>" . "</td>";
                            echo "<td>" . "<input type='text' name='bastidor' value='" . $row["bastidor"] . "'/>" . "</td>";
                            echo "<td>" . "<input type='text' name='marca' value='" . $row["marca"] . "'/>" . "</td>";
                            echo "<td>" . "<input type='text' name='modelo' value='" . $row["modelo"] . "'/>" . "</td>";
                            echo "<td>" . "<input type='text' name='proxima_revision' value='" . $row["proxima_revision"] . "'/>" . "</td>";
                            echo "<td>" . "<input type='submit' name='grabar' value='Grabar'>" . "<input type='submit' name='cancelar' value='Cancelar'>" . "</td></tr>";
                            echo "<input type='hidden' name='id' value='" . $row['matricula'] . "'/>";
                            //</form>";
                        } else {
                            //Fila sin edición
                            echo "<tr><td>" . $row["matricula"] . "</td>";
                            echo "<td>" . $row["bastidor"] . "</td>";
                            echo "<td>{$row['marca']}</td>";
                            echo "<td>{$row['modelo']}</td>";
                            echo "<td>{$row['proxima_revision']}</td>";
                            echo "<td>" . "<a href='crud.php?matricula=" . utf8_encode($row['matricula']) . "&accion=editar'><i class='bi bi-pencil edit'></i></a>" . "</td>";
                            echo "<td>" . "<a href='crud.php?matricula=" . utf8_encode($row['matricula']) . "&accion=borrar'><i class='bi bi-trash delete'></i></a>" . "</td></tr>";
                        }
                    }
                    $resultado->free();
                }
                ?>
                <tr>
                    <td><input type='text' name='nuevo_matricula' placeholder="Nueva matricula" /></td>
                    <td><input type='text' name='nuevo_bastidor' placeholder="Nuevo bastidor"/></td>
                    <td><input type='text' name='nuevo_marca' placeholder="Nueva marca"/></td>
                    <td><input type='text' name='nuevo_modelo' placeholder="Nuevo modelo"/></td>
                    <td><input type='text' name='nuevo_revision' placeholder="Nueva revision"/></td>
                    <td><input type='submit' name='nuevo' value='Nuevo'></td>
                </tr>
            </tbody>

            </table>
        </form>
        <div class="feedback">
            <p>
                <?php
            echo $mensaje;
            ?>
        </p>
    </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>