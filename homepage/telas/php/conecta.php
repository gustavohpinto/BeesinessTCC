
<?php
    $host ="fdb33.awardspace.net";
    $usuario ="3880156_tcc";
    $senha ="carlosvaz1@";
    $banco="3880156_tcc";

    $conexao = new MySQLi("$host","$usuario","$senha","$banco");


    if($conexao -> connect_error){
        echo "Erro de Conexão!!!";
    }else {
        // [echo "Sucesso";
    }



?>