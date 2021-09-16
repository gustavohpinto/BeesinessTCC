<?php


include 'restrita/conecta.php'; // Incluindo o Banco

include 'verificador.php';
    
    $id = $_GET['id'];
    $cod = $_GET['cod'];
    // echo $ra;


 
    // echo "$email <br>";
    // echo "$nome <br>";
    // echo "$telcel <br>";
    // echo "$telfixo <br> ";
    // echo "$dataNasc <br> ";

    $consulta = $conexao -> prepare("DELETE FROM possuigastos 
     WHERE codUsuario ='$id' and codGasto = '$cod'");
    
    $consulta -> execute();     
    
    header('Location: ../../../dashboard/dash.php');
?>