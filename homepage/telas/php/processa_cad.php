<?php
session_start();
ob_start();
include 'restrita/conecta.php';
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['pass'];


$consulta = $conexao -> prepare(
    "INSERT INTO usuario (nome, email, senha) VALUES('$nome', '$email','$senha' )"
);
    try {
        $consulta -> execute();
        
        header('Location: ../login.html');
        ob_end_flush();
    
    } catch (\Throwable $th) {
        Echo"Erro";
    }

?>