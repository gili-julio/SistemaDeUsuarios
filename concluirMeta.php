<?php
session_start();
include_once('config.php');
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $sqlmeta = "SELECT * FROM metas WHERE idmetas = '$id'";
    $resultmeta = $conexao->query($sqlmeta);
    $metas = mysqli_fetch_assoc($resultmeta);
    $user = $metas['user'];
    $sqlbusca = "SELECT * FROM usuarios WHERE nome = '$user'";
    $resultbusca = $conexao->query($sqlbusca);
    $tabela = mysqli_fetch_assoc($resultbusca);
    if ($metas['feito'] == 'n') {
        $sql = "UPDATE `metas`.`metas` SET `feito` = 's' WHERE (`idmetas` = '$id');";
        $result = $conexao->query($sql);
        header('Location: metas.php?id='.$tabela['id']);
    } else {
        $sql = "UPDATE `metas`.`metas` SET `feito` = 'n' WHERE (`idmetas` = '$id');";
        $result = $conexao->query($sql);
        header('Location: metas.php?id='.$tabela['id']);
    }
} else {
    header('Location: usuarios.php');
}
