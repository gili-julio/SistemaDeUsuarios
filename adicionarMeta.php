<?php
session_start();
include_once('config.php');
require_once('functions.php');

if (isset($_POST['submit']) && isset($_POST['meta']) && isset($_GET['user']) && isset($_GET['adm'])) {
    
    $meta = $_POST['meta'];
    $user = $_GET['user'];
    $adm = $_GET['adm'];
    $sqlbusca = "SELECT * FROM usuarios WHERE nome = '$user'";
    $resultbusca = executar_sql($sqlbusca);
    $tabela = mysqli_fetch_assoc($resultbusca);
    if (mysqli_num_rows($resultbusca) != 0) {
        if(isset($_POST['aprovacao'])){$requeraprovacao = 's';}else{$requeraprovacao = 'n';}
        if(isset($_POST['semdata'])){$dataconcluir = 'sem';}else{
            if(!empty($_POST['data'])){
                $dataconcluir = $_POST['data'];
                $partedia = substr($dataconcluir, 8, 2);
                $partemes = substr($dataconcluir, 5, 2);
                $parteano = substr($dataconcluir, 0, 4);
                $dataconcluir = $partedia."/".$partemes."/".$parteano;
            }else{$dataconcluir = 'sem';};
        }
        date_default_timezone_set('America/Sao_Paulo');
        $dia = date("d/m/Y");
        $sql = "INSERT INTO metas 
        ( `meta`, `user`, `feito`, `dataconcluir`, `datacriado`, `aprovacao`, `requeraprovacao`, `pedidoaprovacao`) 
        VALUES ( '$meta', '$user', 'n', '$dataconcluir', '$dia', 'n', '$requeraprovacao', 'n')"; 
        executar_sql($sql);

        adicionar_evento("criou uma meta para $user", $adm);

        header('Location: usuario.php?id='.$tabela['id']);
    } else {
        header('Location: usuarios.php');
    }
} else {
    header('Location: usuarios.php');
} 
