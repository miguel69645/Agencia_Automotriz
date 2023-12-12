<?php 
    $host = 'localhost';
    $dbname = 'Agencia';
    $user = 'root';
    $password = '';
    $port = '3306';
    $conexion = mysqli_connect($host, $user, $password, $dbname, $port);
    
    if(!$conexion){ 
        echo "Error al conectar a la BD";
        exit;
    }
?>