<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF8">
    <title>Oferta empleo Salamanca</title>
</head>

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<link rel="stylesheet" href="css/style.css">

<body>

    <h1>Ofertas de empleo en Salamanca</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Referencia</th>
                <th scope="col">Convocatoria</th>
                <th scope="col">Entidad convocante</th>
                <th scope="col">Regimen</th>
                <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $ofertas = simplexml_load_file("https://datosabiertossalamanca.es/dataset/ae63cc96-7260-490e-bca3-96780d5b63cd/resource/da1d9fdf-714b-4ff0-98e1-fcfaf50aa821/download/ofertaempleo202011.xml");


            foreach ($ofertas as $oferta) {
                echo "<tr class='table-info'>";
                echo "<td>Referencia: " . $oferta->Referencia . "</td>";
                echo "<td>Convocatoria: " . $oferta->Convocatoria . "</td>";
                echo "<td>Entidad convocante: " . $oferta->EntidadConvocante . "</td>";
                echo "<td>Regimen: " . $oferta->Regimen . "</td>";
                echo "<td>Estado: " . $oferta->Estado . "</td>";
            }

            ?>
        </tbody>

        </tr>

    </table>