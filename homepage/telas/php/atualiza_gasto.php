<?php
include 'restrita/conecta.php';
include 'verificador.php';


$usuario = $_SESSION['id'];
$id = $_GET['id'];
$ganho = $_POST['gasto'];
$diaD = "SELECT * FROM dia";
$mesM = "SELECT * FROM mes";
$anoA = "SELECT * FROM ano";
$dia = $_POST['dia'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];

foreach ($conexao -> query($diaD) as $linhaD){
	if ($linhaD['dia'] == $dia) {
		$diaConex = $linhaD['codDia'];
	}
}
foreach ($conexao -> query($mesM) as $linhaM){
	if ($linhaM['Mes'] == $mes) {
		$MesConex = $linhaM['codMes'];
	}
}
foreach ($conexao -> query($anoA) as $linhaA){
	if ($linhaA['ano'] == $ano) {
		$AnoConex = $linhaA['codAno'];
	}
}

$consulta = $conexao -> prepare("UPDATE possuigastos SET codDia ='$diaConex', codMes='$MesConex', codAno='$AnoConex' WHERE codUsuario = '$usuario' AND codGasto = '$id'");
$consulta -> execute();


$con = $conexao -> prepare("UPDATE gastos SET gasto='$ganho' WHERE codGasto = '$id'");
$con -> execute();


header('Location: ../../../dashboard/dash.php');

?>