<?php
	include 'restrita/conecta.php'; 
    include 'verificador.php';
    


	$id = $_SESSION['id'];
	$valor = $_POST['valor'] + 0;
	$data = $_POST['data'];
	$datas = explode('-', $data);
	$cont = 0;
	$ganhos = "SELECT * FROM ganhos";
	$dia = "SELECT * FROM dia";
	$mes = "SELECT * FROM mes";
	$ano = "SELECT * FROM ano";
	foreach ($conexao -> query($ganhos) as $linhaAtual) {
		if ($linhaAtual['Ganho'] == $valor) {
			$cont += 1;
			$codigo = $linhaAtual['codGanho'];
		}
	}

	foreach ($conexao -> query($dia) as $linhaAtual) {
		if ($linhaAtual['dia'] == ($datas[2] + 0)) {
			$diaConex = $linhaAtual['codDia'];
		}
	}
    foreach ($conexao -> query($mes) as $linhaAtual) {
        if ($linhaAtual['Mes'] == ($datas[1] + 0)) {
       		$mesConex = $linhaAtual['codMes'];
        }
    }
    foreach ($conexao -> query($ano) as $linhaAtual) {
        if ($linhaAtual['ano'] == ($datas[0] + 0)) {
            $anoConex = $linhaAtual['codAno'];
        }
    }


	
	$consulta = $conexao -> prepare("INSERT INTO ganhos(Ganho) VALUES ('$valor')");
	$consulta -> execute();

	$ganhosaa = $conexao -> query("SELECT MAX(codGanho) FROM `ganhos`");
	$gan = $ganhosaa->fetch_array()[0];


	$consultaGa = $conexao -> query("INSERT INTO possuiganhos VALUES ('$gan', '$id', '$diaConex', '$mesConex', '$anoConex')");
	


	header('location: ../../../dashboard/dash.php');
?>