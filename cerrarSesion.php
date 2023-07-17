<?php

//Cierra la sesion y establece las cookies a nulas si las hay

if (isset($_GET['cerrar'])) {

session_start();


$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();
   
    echo "<meta http-equiv='refresh' content='0; url=login.php'>";

}else{
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}