<?php
session_start();
require_once('config.php');
require_once('functions.php');
if (isset($_GET['id']) && isset($_GET['adm'])) {

    $id = $_GET['id'];
    $adm = $_GET['adm'];
    $sqlmeta = "SELECT * FROM metas WHERE idmetas = '$id'";
    $resultmeta = executar_sql($sqlmeta);
    $metas = mysqli_fetch_assoc($resultmeta);
    $user = $metas['user'];
    $sqlbusca = "SELECT * FROM usuarios WHERE nome = '$user'";
    $resultbusca = executar_sql($sqlbusca);
    $tabela = mysqli_fetch_assoc($resultbusca);
    if (mysqli_num_rows($resultmeta) != 0) {
        $sql = "DELETE FROM metas WHERE (idmetas = '$id');";
        $result = executar_sql($sql);

        adicionar_evento("excluiu uma meta de $user", $adm);

        header('Location: usuario.php?id='.$tabela['id']);
    } else {
        header('Location: usuario.php?id='.$tabela['id']);
    }
} else {
    header('Location: usuarios.php');
}
