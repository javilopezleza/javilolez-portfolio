<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpath en php</title>
</head>

<body>
    <?php
    $dom = new DOMDocument();
    $dom->load("usuarios2.xml");

    //Validar documento xml
    if ($dom->validate())
        echo "Documento xml válido<br>";
    else exit("Documento xml no válido<br>");

    echo "<h1>Listado de usuarios con XML</h1>";

    //Acceder a un nodo por id
    $usuario = $dom->getElementById("u33");
    $nombre = $usuario->getElementsByTagName("nombre")
        ->item(0)->nodeValue;
    $apellido = $usuario->getElementsByTagName("apellido")
        ->item(0)->nodeValue;

    $usuario2 = $dom->getElementById("u23");
    $nombre2 = $usuario2->getElementsByTagName("nombre")
        ->item(0)->nodeValue;
    $apellido2 = $usuario2->getElementsByTagName("apellido")
        ->item(0)->nodeValue;

    $usuario3 = $dom->getElementById("u40");
    $nombre3 = $usuario3->getElementsByTagName("nombre")
        ->item(0)->nodeValue;
    $apellido3 = $usuario3->getElementsByTagName("apellido")
        ->item(0)->nodeValue;


    echo "El usuario con id u33 se llama $nombre $apellido<br>";

    echo "El usuario con id u23 se llama $nombre2 $apellido2<br>";

    echo "El usuario con id u40 se llama $nombre3 $apellido3<br>";


    echo "<h2>Usuario de Granada</h2>";

    echo "El usuario de Granada se llama $nombre3 $apellido3<br>";
    ?>
</body>

</html>