<?php
session_start();
require_once('config.php');
require_once('functions.php');
if (isset($_GET['id']) && isset($_GET['adm'])) {

    $id = $_GET['id'];
    $adm = $_GET['adm'];
    $sqlbusca = "SELECT * FROM usuarios WHERE id = '$id'";
    $resultbusca = executar_sql($sqlbusca);
    $tabela = mysqli_fetch_assoc($resultbusca);
    $user = $tabela['nome'];
    if (mysqli_num_rows($resultbusca) != 0) {
        $sql = "DELETE FROM usuarios WHERE (id = '$id');";
        $result = executar_sql($sql);
        $sql2 = "DELETE FROM metas WHERE (user = '$user');";
        $result2 = executar_sql($sql2);

        adicionar_evento("excluiu o usuario $user", $adm);

        header('Location: usuarios.php');
    } else {
        header('Location: usuarios.php');
    }
} else {
    header('Location: usuarios.php');
}
