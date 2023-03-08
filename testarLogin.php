<?php
session_start();
include_once('config.php');
if (isset($_POST['submit']) && isset($_POST['login']) && isset($_POST['password'])) {

    $login = strtolower($_POST['login']);
    $senha = $_POST['password'];
    if ($login == 'adm' && $senha == 'adm') {
        $_SESSION['user'] = 'adm';
        $_SESSION['id'] = '0';
        header('Location: inicio.php');
    } else {

        $sql = "SELECT * FROM usuarios WHERE nome = '$login' and senha = '$senha'";
        $result = $conexao->query($sql);
        $tabela = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) == 0) {
            unset($_SESSION['user']);
            unset($_SESSION['id']);
            header('Location: login.php');
        } else {
            $_SESSION['user'] = $tabela['nome'];
            $_SESSION['id'] = $tabela['id'];
            header('Location: inicio.php');
        }

    }

} else {
    header('Location: login.php');
}
