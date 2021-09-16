<?php
include 'restrita/conecta.php';
ob_start();
$email = $_POST['email'];
$senha = $_POST['pass'];

$consulta = "SELECT * FROM usuario 
WHERE email ='$email' AND senha ='$senha'";

$resultado = $conexao -> query($consulta); 
$registros = $resultado -> num_rows;

$registro_usuarios = mysqli_fetch_assoc($resultado);

if ($registros == 1) {
    session_start();
    $_SESSION['id'] = $registro_usuarios['codUsuario'];
    $_SESSION['nome'] = $registro_usuarios['nome'];
    $_SESSION['email'] = $registro_usuarios['email'];
   
    header('Location: ../../../dashboard/dash.php');
    ob_end_flush();
} else{
    $_SESSION['email'] = $email;
    $_SESSION['senha'] =  $senha;
    unset( $_SESSION['email'],$_SESSION['senha'] );
    header('Location: ../login.html');
    ob_end_flush();
}

?>