<?php
session_start();
require_once('config.php');
require_once('functions.php');

if (isset($_POST['submit']) && isset($_POST['login']) && isset($_POST['password']) && isset($_GET['adm'])) {

    $login = strtolower($_POST['login']);
    $senha = $_POST['password'];
    $setor = $_POST['setor'];
    $adm = $_GET['adm'];
    if(isset($_POST['criarmetas'])){$criarmetas = "s";}else{$criarmetas = "n";}
    if(isset($_POST['criartarefas'])){$criartarefas = "s";}else{$criartarefas = "n";}
    if(isset($_POST['criarusuarios'])){$criarusuarios = "s";}else{$criarusuarios = "n";}
    if(isset($_POST['editartarefas'])){$editartarefas = "s";}else{$editartarefas = "n";}
    switch($setor){
        case '1':
            $setor = 'T.I';
            break;
        case '2':
            $setor = 'Compras';
            break;
        case '3':
            $setor = 'Vendas Externas';
            break;
        case '4':
            $setor = 'Vendedores';
            break;
        case '5':
            $setor = 'Administrativo';
            break;
        case '6':
            $setor = 'Frente de Loja';
            break;
        case '7':
            $setor = 'Açougue';
            break;
        case '8':
            $setor = 'Bazar';
            break;
        case '9':
            $setor = 'Deposito';
            break;
        case '10':
            $setor = 'Restaurante';
            break;
        case '11':
            $setor = 'Padaria';
            break;
        
    }

    $sqlbusca = "SELECT * FROM usuarios WHERE nome = '$login'";
    $resultbusca = executar_sql($sqlbusca);
    if (mysqli_num_rows($resultbusca) == 0) {
        $sql = "INSERT INTO `usuarios` (`nome`, `senha`, `setor`, `criarmetas`, `criarusuarios`, `criartarefas`, `editartarefas` , `metasconcluidas`, `tarefasconcluidas`, `criadopor`) VALUES ('$login', '$senha', '$setor', '$criarmetas', '$criarusuarios', '$criartarefas', '$editartarefas', 0, 0, '$adm')";
        $result = executar_sql($sql);

        adicionar_evento("criou o usuario $login", $adm);

        header('Location: usuarios.php');
    } else {
        header('Location: cadastrar.php');
    }
} else {
    header('Location: cadastrar.php');
}
