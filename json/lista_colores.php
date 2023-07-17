<?php
$url = "http://localhost/Javier/php/php_victor/base/json/colores.json";
$data = file_get_contents($url);
$colores = json_decode($data, true);

$colors = $colores['arrayColores'];



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JSON</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h1>JSON de colores</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Nombre del color</th>
                <th scope="col">Color</th>
            </tr>
        </thead>
        <tbody>

            <?php

            foreach ($colors as $color => $valor) {
                echo "<tr>";
                $name = $colors[$color]["nombreColor"];
                $hex = $colors[$color]["valorHexadec"];

                echo "<td class='table-secondary'><p>El color <span style='color:{$hex};font-weight:bold;text-transform: uppercase;'>$name</span> tiene un código hexadecimal <span style='color:{$hex};'>$hex</span></p>" . '</td>';
                echo "<td style='background-color:{$hex}' class='color'><div class='full' color:$hex;'></div></td>";

                echo "</tr>";
            }

            ?>
        </tbody>


    </table>


</body>

</html>