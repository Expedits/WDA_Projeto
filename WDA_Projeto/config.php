<link rel="stylesheet" href="estilos/style.css?" <?php rand(1, 1000); ?>>
<?php
    $dbHost = 'localhost';
    $dbUsername= 'admin';
    $dbPassword = 'admin';
    $dbName = 'wda-projeto';

    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
?>