<?php
    $host = "localhost";
    $user = "root";
    $pw = "";
    $db = "pruebas";
    $con = mysqli_connect($host,$user,$pw,$db);
    if(mysqli_connect_errno()){
        echo "conexion fallida";
        exit();
    }
?>



    