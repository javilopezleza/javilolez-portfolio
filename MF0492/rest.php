<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rest</title>

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


    <h1>Servicio REST</h1>

    <form action="#" method="GET">
        <label for="numero">Introduce un número</label>
        <input type="text" name="numero" id="numero" placeholder="1-898">
        <button type="submit" name="submit" id="submit">Enviar</button>
    </form>

    <?php
    if (isset($_GET['submit'])) {

        $id = $_GET['numero'];

        if ($id > 898 && $id <= 10000) {
            echo "<h2 class='my-2'>Pokemon no disponible</h2>";
        }elseif ($id > 10228) {
            echo "<h2 class='my-2'>Pokemon no disponible</h2>";
        }else {
        $url = "https://pokeapi.co/api/v2/pokemon/$id/";
        $data = file_get_contents($url);
        $resultados = json_decode($data, true);

        $results = $resultados['forms'];

        $urlLocation = "https://pokeapi.co/api/v2/pokemon/$id/encounters";
        $dataLocation = file_get_contents($urlLocation);
        $resultadosLocation = json_decode($dataLocation, true);

        $resultsLocation = $resultados['held_items'];

        $urlImage = "https://pokeapi.co/api/v2/pokemon-form/$id/";
        $dataImage = file_get_contents($urlImage);
        $resultadosImage = json_decode($dataImage, true);

        $resultsImage = $resultados['sprites'];

        foreach ($results as $result) {
            // $id = $results["id"];
            $name = $result["name"];
            $url = $resultsImage["front_default"];
            $urlBack = $resultsImage["back_default"];

            echo "<h2>$name</h2>";
            echo "<div class='d-flex'>";
            echo "<img src='{$url}' style='width='150px'; height='150px';'><br>";
            echo "<img src='{$urlBack}' style='width='150px'; height='150px';'><br>";
            echo "</div>";
            // echo "$abilities";
        }
    }
    }

    ?>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</body>

</html>