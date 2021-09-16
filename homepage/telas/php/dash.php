<?php 
ob_start();
?>
<!DOCTYPE html>

<html lang="pt-br">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Ico -->
    <!-- <link rel="apple-touch-icon" sizes="180x180" href="./img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./img/favicon-32x32.png"> -->

    <!-- Bootstrap e CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">

    <!--Fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">

    <title>Beesiness</title>
</head>

<body>
    <!-- Navbar -->
    <?php 
    session_start();
	

	if (
		(!isset($_SESSION['id'])==true)&&
		(!isset($_SESSION['nome'])==true)&&
		(!isset($_SESSION['email'])==true)) {
		
		unset($_SESSION['id']);
		unset($_SESSION['nome']);
		unset($_SESSION['email']);
        
		header('Location:./index.html');
	}
    ?>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-purple">
      <img src="img/logo.png" alt="some text" width=5%>
      <a class="navbar-brand" href="#"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-start" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link active" href="./index.html">Beesiness <span class="sr-only">(Página
              atual)</span></a>
          <a class="nav-item nav-link" href="#">Educação Ambiental</a>
          <a class="nav-link cor-home" href="#projetos">Sobre o projeto <span class="sr-only"></span></a>
          <a class="nav-link cor-home" href="#equipe">Equipe <span class="sr-only"></span></a>
        </div>
      </div>
      <div class="navbar-collapse collapse justify-content-end" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link btn btn-success" style="padding: 8px;" href="./logout.php">Sair</a>
          <div style="margin-top: 1.5%;"></div>

        </div>
      </div>
    </nav>

    <br>
    <br>
    
    <br>
    
    <section class="espaco" style="padding-top: 5%; padding-bottom: 7%;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center">
                    <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Ganhos</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Valor</th>
                                            <th>Dia</th>
                                            <th>Mes</th>
                                            <th>Ano</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <!--  LINHA 97 -> Recebe o código do usuário através da section MUDAR
                                              Linha 102 -> consulta usando o código de possui ganhos
                                        -->
									    <?php
									    	include 'restrita/conecta.php';

                                            $usuario = $_SESSION['id'];
                                            $consultaU = "SELECT * FROM possuiganhos";

                                            foreach ($conexao -> query($consultaU) as $lin) {

                                                if ($lin['codUsuario'] == $usuario) {
                                                    $consulta = "SELECT * FROM ganhos WHERE codGanho = " . $lin['codGanho'];
                                                    $dia = "SELECT * FROM dia";
                                                    $mes = "SELECT * FROM mes";
                                                    $ano = "SELECT * FROM ano";
                                                    foreach ($conexao -> query($consulta) as $linha){
                                                        foreach ($conexao -> query($dia) as $linhaAtual) {
                                                            if ($linhaAtual['codDia'] == $lin['codDia']) {
                                                                $diaConex = $linhaAtual['dia'];
                                                            }
                                                        }
                                                        foreach ($conexao -> query($mes) as $linhaAtual) {
                                                            if ($linhaAtual['codMes'] == $lin['codMes']) {
                                                                $mesConex = $linhaAtual['Mes'];
                                                            }
                                                        }
                                                        foreach ($conexao -> query($ano) as $linhaAtual) {
                                                            if ($linhaAtual['codAno'] == $lin['codAno']) {
                                                                $anoConex = $linhaAtual['ano'];
                                                            }
                                                        }
                                                        echo "<tr>";
                                                        echo "<td>". $linha['Ganho'] ."</td>";
                                                        echo "<td>". $diaConex ."</td>";
                                                        echo "<td>". $mesConex ."</td>";
                                                        echo "<td>". $anoConex ."</td>"; 
                                                        ?>
                                                        <td>
                                                            <a href="form_atualiza_ganho.php?id=<?php echo $linha['codGanho']; ?>" class="btn btn-primary">Atualizar</a>
                                                            &nbsp; &nbsp; 
                                                            <a href="delete_ganho.php?cod=<?php echo $linha['codGanho']; ?>&id=<?php echo $lin['codUsuario']; ?>" class="btn btn-danger" onclick="mostraMsgGa()">Deletar</a>
                                                        </td>
                                                        <?php echo "</tr>";
                                                    }
                                                }
                                            }

									      
									    ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-header">
                                <a href="cadastra_ganho.php?id=<?php echo $usuario; ?>" class="btn btn-success">Inserir</a>
                            </div>
                        </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Gastos</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Valor</th>
                                            <th>Dia</th>
                                            <th>Mes</th>
                                            <th>Ano</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									    <?php
									    	include './restrita/conecta.php';
									        $usuario = $_SESSION['id'];
                                            $consultaU = "SELECT * FROM possuigastos";

                                            foreach ($conexao -> query($consultaU) as $lin) {
                                                if ($lin['codUsuario'] == $usuario) {
                                                    $consultaG = "SELECT * FROM gastos WHERE codGasto = " . $lin['codGasto'];
                                                    $dia = "SELECT * FROM dia";
                                                    $mes = "SELECT * FROM mes";
                                                    $ano = "SELECT * FROM ano";
                                                    foreach ($conexao -> query($consultaG) as $linha){
                                                        foreach ($conexao -> query($dia) as $linhaAtual) {
                                                            if ($linhaAtual['codDia'] == $lin['codDia']) {
                                                                $diaConex = $linhaAtual['dia'];
                                                            }
                                                        }
                                                        foreach ($conexao -> query($mes) as $linhaAtual) {
                                                            if ($linhaAtual['codMes'] == $lin['codMes']) {
                                                                $mesConex = $linhaAtual['Mes'];
                                                            }
                                                        }
                                                        foreach ($conexao -> query($ano) as $linhaAtual) {
                                                            if ($linhaAtual['codAno'] == $lin['codAno']) {
                                                                $anoConex = $linhaAtual['ano'];
                                                            }
                                                        }
                                                        echo "<tr>";
                                                        echo "<td>". $linha['gasto'] ."</td>";
                                                        echo "<td>". $diaConex ."</td>";
                                                        echo "<td>". $mesConex ."</td>";
                                                        echo "<td>". $anoConex ."</td>"; 
                                                        ?>
                                                        <td>
                                                            <a href="form_atualiza_gasto.php?id=<?php echo $linha['codGasto']; ?>" class="btn btn-primary">Atualizar</a>
                                                            &nbsp; &nbsp; 
                                                            <a href="delete_gasto.php?cod=<?php echo $linha['codGasto']; ?>&id=<?php echo $lin['codUsuario']; ?>" class="btn btn-danger"  onclick="mostraMsg()">Deletar</a>
                                                        </td>
                                                        <?php echo "</tr>";
                                                    }
                                                }
                                            }
									    ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-header">
                                <a href="cadastra_gasto.php" class="btn btn-success">Inserir</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Home / Educação Financiera -->


    <!-- Aqui vai tá as recomendações :3 -->    
    <?php
    $recomendas = "SELECT * FROM `possuiganhos` WHERE `codUsuario` = ".$usuario;
    $recomendacao = "SELECT * FROM `possuiganhos` WHERE `codUsuario` = ".$usuario." ORDER BY `codMes` DESC LIMIT 1";
    $ganhos = "SELECT * FROM `ganhos`";
    $ganhoTotal = 0;
    foreach ($conexao -> query($recomendacao) as $linha) {
        foreach($conexao -> query($recomendas) as $lin){
            if ($lin['codMes'] == $linha['codMes']){
                foreach($conexao -> query($ganhos) as $li){
                    if($lin['codGanho'] == $li['codGanho']) {
                        $ganhoTotal += $li['Ganho'];
                    }
                }
            }
        }
    }

    $recomendasB = "SELECT * FROM `possuigastos` WHERE `codUsuario` = ".$usuario;
    $recomendacaoB = "SELECT * FROM `possuigastos` WHERE `codUsuario` = ".$usuario." ORDER BY `codMes` DESC LIMIT 1";
    $gastos = "SELECT * FROM `gastos`";
    $gastoTotal = 0;
    foreach ($conexao -> query($recomendacaoB) as $linha) {
        foreach($conexao -> query($recomendasB) as $lin){
            if ($lin['codMes'] == $linha['codMes']){
                foreach($conexao -> query($gastos) as $li){
                    if($lin['codGasto'] == $li['codGasto']) {
                        $gastoTotal += $li['gasto'];
                    }
                }
            }
        }
    }
    $recomendacoes = array();
    $fotos = array();
    $saldo = $ganhoTotal / $gastoTotal;
    if($saldo <= 0.8){
        $come = "SELECT * FROM `telas` where `nivel` BETWEEN 1 and 5";
        foreach ($conexao -> query($come) as $linhazinha2){
            array_push($recomendacoes, $linhazinha2["diretorio"]);
            array_push($fotos, $linhazinha2["icone"]);
        }
    } elseif (($saldo > 0.8) & ($saldo <= 1.3)) {
       
        $escolha1 = range(3, 4);
        $escolha2 = range(7, 8);
        
        srand((float)microtime()*1000000);
        shuffle($escolha1);
        shuffle($escolha2);
        $come2A = "SELECT * FROM `telas` where `nivel` = ".$escolha1[0]." OR `nivel` = ".$escolha1[1];
        $come2B = "SELECT * FROM `telas` where `nivel` BETWEEN 5 and 6";
        $come2C = "SELECT * FROM `telas` where `nivel` = ".$escolha2[0];
        foreach ($conexao -> query($come2A) as $linhazinha2){
            array_push($recomendacoes, $linhazinha2["diretorio"]);
            array_push($fotos, $linhazinha2["icone"]);
        }
        foreach ($conexao -> query($come2B) as $linhazinha2A){
            array_push($recomendacoes, $linhazinha2A["diretorio"]);
            array_push($fotos, $linhazinha2A["icone"]);
        }
        foreach ($conexao -> query($come2C) as $linhazinha2B){
            array_push($recomendacoes, $linhazinha2B["diretorio"]);
            array_push($fotos, $linhazinha2B["icone"]);
        }
        
    } elseif (($saldo > 1.3) & ($saldo < 1.8)) {
       
        $escolha1 = range(6, 9);
        
        srand((float)microtime()*1000000);
        shuffle($escolha1);
        $come3A = "SELECT * FROM `telas` where `nivel` BETWEEN 4 and 5";
        $come3B = "SELECT * FROM `telas` where `nivel` = ".$escolha1[0]." OR `nivel` = ".$escolha1[1]." OR `nivel` = ".$escolha1[2];
        foreach ($conexao -> query($come3A) as $linhazinha2){
            array_push($recomendacoes, $linhazinha2["diretorio"]);
            array_push($fotos, $linhazinha2["icone"]);
        }
        foreach ($conexao -> query($come3B) as $linhazinha2A){
            array_push($recomendacoes, $linhazinha2A["diretorio"]);
            array_push($fotos, $linhazinha2A["icone"]);
        }
        
    } elseif ($saldo > 1.8) {
        $come4 = "SELECT * FROM `telas` where `nivel` BETWEEN 6 and 10";
        foreach ($conexao -> query($come4) as $linhazinha2A){
            array_push($recomendacoes, $linhazinha2A["diretorio"]);
            array_push($fotos, $linhazinha2A["icone"]);
        }
    }
    $ordem = range(0, 4); 
    srand((float)microtime()*1000000);
    shuffle($ordem);
    $um = $ordem[0];
    $dois = $ordem[1];
    $tres = $ordem[2];
    $quatro = $ordem[3];
    $cinco = $ordem[4];
    ?>
    <h1 style="text-align:center">Recomendações</h1>
    <div class="container" style="padding-bottom: 8%;">
        <div class="row passar">
            <div class="col-sm">
                <a href=<?php echo "$recomendacoes[$um]" ?>>
                    <img class="d-block w-100 " src=<?php echo "$fotos[$um]" ?> alt="First slide">
                </a>
            </div>
            <div class="col-sm">
                <a href=<?php echo "$recomendacoes[$dois]" ?>>
                    <img class="d-block w-100 " src=<?php echo "$fotos[$dois]" ?> alt="First slide">
                </a>
            </div>
            <div class="col-sm ">
                <a href=<?php echo "$recomendacoes[$tres]" ?>>
                    <img class="d-block w-100" src=<?php echo "$fotos[$tres]" ?> alt="First slide">
                </a>
            </div>
            <div class="col-sm ">
                <a href=<?php echo "$recomendacoes[$quatro]" ?>>
                    <img class="d-block w-100 " src=<?php echo "$fotos[$quatro]" ?> alt="First slide">
                </a>
            </div>
            <div class="col-sm ">
                <a href=<?php echo "$recomendacoes[$cinco]" ?>>
                    <img class="d-block w-100 " src=<?php echo "$fotos[$cinco]" ?> alt="First slide">
                </a>
            </div>
        </div>
    </div>



    <!-- cabo -->


    <!-- Forms Contato -->

    <!-- Footer -->
    <footer class="py-4 bg-dark text-white-50 p-4">
        <div class="footer-copyright text-center py-3">&copy;2021 - Desenvolvido por Beesiness
        </div>
        <!-- Copyright -->

    </footer>


    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script type="text/javascript" src="./js/jquery.min.js"></script>
    <script type="text/javascript" src="./js/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="./js/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="./js/bootstrap.js"></script>
    <script type="text/javascript" src="./js/counterup.min.js"></script>
    <script type="text/javascript" src="./js/main.js"></script>
    <script type="text/javascript" src="./js/deleteGasto.js"></script>
    <script type="text/javascript" src="./js/deleteGanho.js"></script>

</body>

</html>