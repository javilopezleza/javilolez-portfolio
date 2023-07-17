<?php

//Conexion a la base de datos

function conexion(){
    try {
        $conexion = @new PDO(
            'mysql:host=localhost;dbname=dbcurso',//host y nombre de la base de datos
            'root',//usuario
            '',//contraseña que se haya puesto en MySql
            array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8")
        );
    }catch (PDOException $e) {
        echo $e -> getMessage();
    }
    return $conexion;
}
