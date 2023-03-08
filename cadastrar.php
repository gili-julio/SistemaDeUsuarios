<?php
session_start();
require_once('config.php');
require_once('functions.php');
if ($_SESSION['user'] == 'adm' && $_SESSION['id'] == '0') {
    $adm = 'ADMIN';
} else {
    unset($_SESSION['user']);
    unset($_SESSION['id']);
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: rgb(0, 128, 0, 0.4);
        }

        .caixa {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 15px;
            border-radius: 15px;
            width: 30%;
        }
    </style>
</head>
<div id="carregando" style=" display: none; width: 15rem; height: 15rem; background-color: rgb(0,0,0,0.1); position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 15px; text-align: center; ">
<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
  <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
  <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
  <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
</svg>
</div>
<body id="body">
    <div class="caixa bg-light bg-gradient">
        <form method="POST" action="cadastrandoBD.php?adm=<?php echo $adm;?>">
            <div class="text-end">
                <a onclick="aguarde()" class="btn btn-danger" href="usuarios.php">Cancelar</a>
            </div>
            <div class="text-center">
                <h1>Cadastrar Usuário</h1>
            </div>
            <label for="login" class="form-label">Nome do Usuário</label>
            <input autocomplete="off" class="form-control" id="login" name="login">
            <br>
            <label for="password" class="form-label">Senha do Usuário</label>
            <input autocomplete="off" class="form-control" id="password" name="password">
            <br>
            <label class="form-label">Setor do Usuário</label>
            <select class="form-select" name="setor">
                <option value="1">T.I</option>
                <option value="2">Compras</option>
                <option value="3">Vendas Externas</option>
                <option value="4">Vendedores</option>
                <option value="5">Administrativo</option>
                <option value="6">Frente de Loja</option>
                <option value="7">Açougue</option>
                <option value="8">Bazar</option>
                <option value="9">Deposito</option>
                <option value="10">Restaurante</option>
                <option value="11">Padaria</option>
            </select>
            <br>
            <input class="form-check-input" type="checkbox" value="" id="criarusuarios" name="criarusuarios">
            <label for="criarusuarios" class="form-check-label">Usuário pode criar outros usuários</label>
            <br>
            <input class="form-check-input" type="checkbox" value="" id="criarmetas" name="criarmetas">
            <label for="criarmetas" class="form-check-label">Usuário pode criar metas</label>
            <br>
            <input class="form-check-input" type="checkbox" value="" id="criartarefas" name="criartarefas">
            <label for="criartarefas" class="form-check-label">Usuário pode criar tarefas</label>
            <br>
            <input class="form-check-input" type="checkbox" value="" id="editartarefas" name="editartarefas">
            <label for="editartarefas" class="form-check-label">Usuário pode editar as tarefas</label>
            <br>
            <br>
            <div class="text-center">
                <input onclick="aguarde()" type="submit" class="btn btn-success" id="submit" name="submit" value="Cadastrar">
            </div>
        </form>
    </div>


    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>