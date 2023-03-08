<?php
session_start();
require_once('config.php');
require_once('functions.php');
if ($_SESSION['user'] == 'adm' && $_SESSION['id'] == '0') {
    $adm = 'ADMIN';
    if(isset($_GET['idmetas'])){
        $id = $_GET['idmetas'];
        $sql = "SELECT * FROM metas WHERE idmetas = '$id'";
        $result = executar_sql($sql);
        $tabela = mysqli_fetch_assoc($result);
    } else {
        header('Location: usuarios.php');
    }
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
    <title>Meta: <?php echo $tabela['meta']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: rgb(0, 128, 0, 0.4);
        }

        .caixa {
            margin-top: 20px;
            background-color: whitesmoke;
            height: 100px;
            border-radius: 10px;
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
    <div class="container">
        <br>
        <div class="text-end">
            <a href="usuario.php?id=<?php
            $usuariobotaovoltar = $tabela['user'];
            $sqlbotaovoltar = "SELECT * FROM usuarios WHERE nome = '$usuariobotaovoltar'";
            $resultadobotaovoltar = executar_sql($sqlbotaovoltar);
            $tabelabotaovoltar = mysqli_fetch_assoc($resultadobotaovoltar);
            echo $tabelabotaovoltar['id'];
            ?>" onclick="aguarde()" class="btn btn-danger" style="transform: scale(1.2);">Voltar</a>
            <br>
            <br>
        </div>
        <div class="text-start">
            <?php

            //verificar se está fora do prazo
            $foradoprazo = '';
            if($tabela['dataconcluir'] == "sem"){$foradoprazo = 'n';}
            else {
                $diaatual = intval(date('d'));
                $mesatual = intval(date('m'));
                $anoatual = intval(date('Y'));
                $diadameta = intval(substr($tabela['dataconcluir'], 0, 2));
                $mesdameta = intval(substr($tabela['dataconcluir'], 3, 2));
                $anodameta = intval(substr($tabela['dataconcluir'], 6, 4));
                if($diaatual == $diadameta && $mesatual == $mesdameta && $anoatual == $anodameta){$foradoprazo = 'n';}
                else {
                    if($anoatual < $anodameta){$foradoprazo = 'n';}
                    else {
                        if($anoatual > $anodameta){$foradoprazo = 's';}
                        else {
                            if($mesatual > $mesdameta){$foradoprazo = 's';}
                            else {
                                if($mesatual < $mesdameta){$foradoprazo = 'n';}
                                else {
                                    if($diaatual > $diadameta){$foradoprazo = 's';}
                                    else {
                                        $foradoprazo = 'n';
                                    }
                                }
                            }
                        }
                    }
                }
            }



            echo '<strong>Meta:</strong> '.$tabela['meta'];
            echo '<br><strong>Id da Meta:</strong> '.$tabela['idmetas'];
            echo '<br><strong>Usuário:</strong> '.$tabela['user'];
            echo '<br><strong>Situação da Meta:</strong> ';
            if($tabela['aprovacao'] == 'n'){

                if($tabela['pedidoaprovacao'] == 'n'){

                    if($tabela['requeraprovacao'] == 'n'){
                        if($tabela['feito'] == 'n'){
                            if($foradoprazo == 'n'){
                                echo '<span style="color: yellow;">Em andamento</span>';
                            }
                            if($foradoprazo == 's'){
                                echo '<span style="color: red;"><strong>Atrasada</strong></span>';
                            }
                        }else{echo '<span style="color: green;">Concluída</span>';}
                    } else {
                        if($foradoprazo == 'n'){
                            echo '<span style="color: yellow;">Em andamento</span>';
                        }
                        if($foradoprazo == 's'){
                            echo '<span style="color: red;"><strong>Atrasada</strong></span>';
                        }
                    }

                } else {
                    echo '<span style="color: yellow;">Aguardando aprovação</span>';
                }

            } else {
                echo '<span style="color: green;">Aprovada</span>';
            }
            echo '<br><strong>Criada em:</strong> '.$tabela['datacriado'];
            if($tabela['dataconcluir'] != "sem"){echo '<br><strong>Data para conclusão:</strong> '.$tabela['dataconcluir'];}else{echo '<br><strong>Sem data para conclusão</strong>';}

            echo '<br><br><a class="btn btn-danger" href="excluirMeta.php?id='.$tabela['idmetas'].'&adm='.$adm.'">EXCLUIR META</a>'
            ?>
        </div>
        <br>
        <h1 id="h1central" class="text-center"><strong>Sem Tópicos</strong></h1>
        <br>
        <form action="meta.php?idmetas=<?php echo $tabela['idmetas'];?>" method="POST">
        <div class="text-start">
            <div id="topicos">

            </div>
            <div id="botaotopico" class="text-center">
                <p id="valortopico" style="display: none;">1</p>
                <button class="btn btn-success" onclick="criar_topico(1)">+ Tópico</button>
                
            </div>
            <br><br>
        </div>
        </form>
    </div>


    <script>
        contadortopicos = parseInt(document.getElementById('valortopico').innerText)
        img_botao_prabaixo = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-down-fill' viewBox='0 0 16 16'><path d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/></svg>"
        img_botao_prolado = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-right-fill' viewBox='0 0 16 16'><path d='m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z'/></svg>"
        img_circulo_subtopico = "<svg xmlns='http://www.w3.org/2000/svg' width='8' height='8' fill='currentColor' class='bi bi-circle' viewBox='0 0 16 16'><path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/></svg>"
        
        function criar_topico(topico){
            document.getElementById('h1central').innerHTML = ""

            quantidade_de_topicos = parseInt(document.getElementById('valortopico').innerHTML)
            html_final = ''
            html_topico = ''

            for(i = 1 ; i <= quantidade_de_topicos; i++){
                if(i != quantidade_de_topicos){

                    html_subtopico = ''
                    value_aparecendo = document.getElementById('aparecendo'+i).innerText
                    value_numerosubtopico = parseInt(document.getElementById('numerosubtopicodotopico'+i).innerText)
                    value_inputtopico = document.getElementById('topico'+i).value
                    html_topico = "<p id='aparecendo"+i+"' style='display: none;'>"+value_aparecendo+"</p><div id='divtopico"+i+"'><p style='display: none;' id='numerosubtopicodotopico"+i+"'>"+value_numerosubtopico+"</p><p style='display: inline;' id='alternarbotaotopico"+i+"'><button onclick='alternar_botao("+i+")' style='background: none; border: none; margin-right: 10px;'>"
                    if(value_aparecendo == "aparecendo"){
                        html_topico += img_botao_prabaixo
                    } else {
                        html_topico += img_botao_prolado
                    }
                    html_topico += "</button></p><p style='display: inline;'><strong>Tópico "+i+":</strong> <input id='topico"+i+"' name='topico"+i+"' value='"+value_inputtopico+"' type='text' placeholder='Tópico "+i+"'></p></div>"
                    html_final += html_topico
                    if(value_numerosubtopico == 1){

                    } else {

                        quantidade_de_subtopicos = value_numerosubtopico-1

                        for(b = 1; b <= quantidade_de_subtopicos ; b++){

                            if(b != quantidade_de_subtopicos || i != quantidade_de_topicos){

                                value_numerosubtopico = document.getElementById('numerosubtopicodotopico'+i).innerText
                                value_inputsubtopico = document.getElementById('subtopico'+i+"."+b).value
                                html_subtopico += "<p id='subtopicos"+i+b+"' style='margin-top: 10px;'>"+img_circulo_subtopico+" subTópico "+i+"."+b+": <input id='subtopico"+i+"."+b+"' name='subtopico"+i+"."+b+"' type='text' value='"+value_inputsubtopico+"' placeholder='subTópico "+i+"."+b+"'></p>"
                                
                            } else {
                                
                                value_numerosubtopico = document.getElementById('numerosubtopicodotopico'+i).innerText
                                html_subtopico += "<p id='subtopicos"+i+b+"' style='margin-top: 10px;'>"+img_circulo_subtopico+" subTópico "+i+"."+b+": <input id='subtopico"+i+"."+b+"' name='subtopico"+i+"."+b+"' type='text' value='' placeholder='subTópico "+i+"."+b+"'></p>"

                            }

                        }
                        html_final += html_subtopico


                    }
                    html_final += "<div id='divdotopico"+i+"'><p id='botaosubtopico"+i+"'><button class='btn btn-success' onclick='criar_subtopico("+i+", "+value_numerosubtopico+")'>+ subTópico</button></p></div>"

                } else {

                    html_topico = "<p id='aparecendo"+i+"' style='display: none;'>aparecendo</p><div id='divtopico"+i+"'><p style='display: none;' id='numerosubtopicodotopico"+i+"'>1</p><p style='display: inline;' id='alternarbotaotopico"+i+"'><button onclick='alternar_botao("+i+")' style='background: none; border: none; margin-right: 10px;'>"
                    html_topico += img_botao_prabaixo
                    html_topico += "</button></p><p style='display: inline;'><strong>Tópico "+i+":</strong> <input id='topico"+i+"' name='topico"+i+"' type='text' placeholder='Tópico "+i+"'></p></div><div id='divdotopico"+i+"'><p id='botaosubtopico"+i+"'><button class='btn btn-success' onclick='criar_subtopico("+i+", 1)'>+ subTópico</button></p></div>"
                    html_final += html_topico

                }
            }
            document.getElementById('topicos').innerHTML = html_final




            /* document.getElementById('topicos').innerHTML += "<p id='aparecendo"+topico+"' style='display: none;'>aparecendo</p><div id='divtopico"+topico+"'><p style='display: none;' id='numerosubtopicodotopico"+topico+"'>1</p><p style='display: inline;' id='alternarbotaotopico"+topico+"'><button onclick='alternar_botao("+topico+")' style='background: none; border: none; margin-right: 10px;'>"
            +"<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-down-fill' viewBox='0 0 16 16'>"
                +"<path d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/>"
            +"</svg>"
            +"</button></p><p style='display: inline;'><strong>Tópico "+topi</strong>co+": <input id='topico"+topico+"' name='topico"+topico+"' type='text' placeholder='Tópico "+topico+"'></p></div><div id='divdotopico"+topico+"'><p id='botaosubtopico"+topico+"'><button class='btn btn-success' onclick='criar_subtopico("+topico+", 1)'>+ subTópico</button></p></div>"
            */
           aumentar_topico()
        }

        function criar_subtopico(topico, numerosubtopico){

            quantidade_de_topicos = parseInt(document.getElementById('valortopico').innerHTML)-1
            html_final = ''
            html_topico = ''
            

            for(i = 1 ; i <= quantidade_de_topicos; i++){

                html_subtopico = ''
                value_aparecendo = document.getElementById('aparecendo'+i).innerText
                value_numerosubtopico = parseInt(document.getElementById('numerosubtopicodotopico'+i).innerText)
                value_inputtopico = document.getElementById('topico'+i).value
                if(i == topico){quantidade_de_subtopicos = value_numerosubtopico}else{quantidade_de_subtopicos = value_numerosubtopico-1}
                html_topico = "<p id='aparecendo"+i+"' style='display: none;'>"+value_aparecendo+"</p><div id='divtopico"+i+"'><p style='display: none;' id='numerosubtopicodotopico"+i+"'>"+value_numerosubtopico+"</p><p style='display: inline;' id='alternarbotaotopico"+i+"'><button onclick='alternar_botao("+i+")' style='background: none; border: none; margin-right: 10px;'>"
                if(value_aparecendo == "aparecendo"){
                    html_topico += img_botao_prabaixo
                } else {
                    html_topico += img_botao_prolado
                }
                html_topico += "</button></p><p style='display: inline;'><strong>Tópico "+i+":</strong> <input id='topico"+i+"' name='topico"+i+"' value='"+value_inputtopico+"' type='text' placeholder='Tópico "+i+"'></p></div>"
                html_final += html_topico
                for(b = 1; b <= quantidade_de_subtopicos ; b++){

                    if(b != quantidade_de_subtopicos || i != topico){

                        value_numerosubtopico = document.getElementById('numerosubtopicodotopico'+i).innerText
                        value_inputsubtopico = document.getElementById('subtopico'+i+"."+b).value
                        html_subtopico += "<p id='subtopicos"+i+b+"' style='margin-top: 10px;'>"+img_circulo_subtopico+" subTópico "+i+"."+b+": <input id='subtopico"+i+"."+b+"' name='subtopico"+i+"."+b+"' type='text' value='"+value_inputsubtopico+"' placeholder='subTópico "+i+"."+b+"'></p>"
                        
                    } else {
                        
                        value_numerosubtopico = document.getElementById('numerosubtopicodotopico'+i).innerText
                        html_subtopico += "<p id='subtopicos"+i+b+"' style='margin-top: 10px;'>"+img_circulo_subtopico+" subTópico "+i+"."+b+": <input id='subtopico"+i+"."+b+"' name='subtopico"+i+"."+b+"' type='text' value='' placeholder='subTópico "+i+"."+b+"'></p>"

                    }

                }
                
                
                html_final += html_subtopico
                html_final += "<div id='divdotopico"+i+"'><p id='botaosubtopico"+i+"'><button class='btn btn-success' onclick='criar_subtopico("+i+", "+value_numerosubtopico+")'>+ subTópico</button></p></div>"

            }
            document.getElementById('topicos').innerHTML = html_final



            /*document.getElementById('divtopico'+topico).innerHTML += "<p id='subtopicos"+topico+numerosubtopico+"' style='margin-top: 10px;'>subTópico "+topico+"."+numerosubtopico+": <input id='subtopico"+topico+"."+numerosubtopico+"' name='subtopico"+topico+"."+numerosubtopico+"' type='text' placeholder='subTópico "+topico+"."+numerosubtopico+"'></p>"
            */
           aumentar_subtopico(topico)
        }

        function aumentar_topico(){
            valor = parseInt(document.getElementById('valortopico').innerText)
            valor++
            document.getElementById('botaotopico').innerHTML = '<p id="valortopico" style="display: none;">'+valor+'</p><button class="btn btn-success" onclick="criar_topico('+valor+')">+ Tópico</button><p style="margin-top: 10px;"><button id="salvar" class="btn btn-primary" type="submit">Salvar Alterações</button></p>'
        }

        function aumentar_subtopico(topico){
            valor = parseInt(document.getElementById('numerosubtopicodotopico'+topico).innerText)
            valor++
            document.getElementById('numerosubtopicodotopico'+topico).innerText = valor
            document.getElementById('divdotopico'+topico).innerHTML = "<p id='botaosubtopico"+topico+"'><button class='btn btn-success' onclick='criar_subtopico("+topico+", "+valor+")'>+ subTópico</button></p>"
            if(document.getElementById('salvar').innerText == ''){
                aparecer_salvar()
            }
        }

        function alternar_botao(topico){
            valor = document.getElementById('aparecendo'+topico).innerText
            numerodesubtopicos = parseInt(document.getElementById('numerosubtopicodotopico'+topico).innerText)
            if(valor == "aparecendo"){
                document.getElementById('alternarbotaotopico'+topico).innerHTML = "<button onclick='alternar_botao("+topico+")' style='background: none; border: none; margin-right: 10px;'>"
            +"<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-right-fill' viewBox='0 0 16 16'><path d='m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z'/></svg>"
            +"</button>"
            document.getElementById('aparecendo'+topico).innerText = "escondido"
            document.getElementById('divtopico'+topico).style.marginBottom = '20px'
            document.getElementById('divdotopico'+topico).style.display = 'none'
            for(let i = 1; i <= numerodesubtopicos; i++){
                document.getElementById('subtopicos'+topico+i).style.display = 'none'
            }
            }
            if(valor == "escondido"){
                document.getElementById('alternarbotaotopico'+topico).innerHTML = "<button onclick='alternar_botao("+topico+")' style='background: none; border: none; margin-right: 10px;'>"
            +"<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-down-fill' viewBox='0 0 16 16'><path d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/></svg>"
            +"</button>"
                document.getElementById('aparecendo'+topico).innerText = "aparecendo"
                document.getElementById('divtopico'+topico).style.marginBottom = ''
                document.getElementById('divdotopico'+topico).style.display = ''
                for(let i = 1; i <= numerodesubtopicos; i++){
                    document.getElementById('subtopicos'+topico+i).style.display = ''
                }
            }
        }

        function aparecer_salvar(){
            document.getElementById('botaotopico').innerHTML += '<p style="margin-top: 10px;"><button id="salvar" class="btn btn-primary" type="submit">Salvar Alterações</button></p>'
        }
        
    </script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>