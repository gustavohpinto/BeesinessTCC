<?php
//Processa

//SESSION PSEUDOVARIAVEL(CRUD)
session_start();  //Campos para validação - > Chaves Primarias, Emails, Id,

include 'conecta.php';

$email = $_POST['username'];
$senha = $_POST['pass'];

$consulta = "SELECT * FROM cliente WHERE email = '$email' AND senha = '$senha'";

$resultado = $conexao->query($consulta);
$registros = $resultado->num_rows; //esperamos 1 linha de registro
$resultado_usuario = mysqli_fetch_assoc($resultado);
//Sessao PHP proxima aula

if ($registros == 1){
	
	$_SESSION['id'] = $resultado_usuario['id']; //por o cammpo da SESSIOM[Mesmo nome que está no banco de dados]
	$_SESSION['nome'] = $resultado_usuario['nome'];
	$_SESSION['email'] = $resultado_usuario['email'];

	header('Location: restrito.php');
} else {
	header('Location: index.html');	

}

?>