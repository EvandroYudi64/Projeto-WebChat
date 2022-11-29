<?php
    define('HOST','127.0.0.1');
    define('USUARIO', 'root');
    define('senha','');
    define('DB','butterchat');

    $conexao = mysqli_connect(HOST, USUARIO, senha, DB) or die('Não foi possivel conectar');
?>