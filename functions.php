<?php


function adicionar_evento($evento, $user){
    require_once('config.php');

    //valor evento id = 1 para $evento1
    $sql1 = "SELECT * FROM eventos WHERE id = 1 ";
    $result1 = executar_sql($sql1);
    $tabela1 = mysqli_fetch_assoc($result1);
    $evento1 = $tabela1['evento'];

    //valor evento id = 2 para $evento2
    $sql2 = "SELECT * FROM eventos WHERE id = 2 ";
    $result2 = executar_sql($sql2);
    $tabela2 = mysqli_fetch_assoc($result2);
    $evento2 = $tabela2['evento'];

    //valor evento id = 3 para $evento3
    $sql3 = "SELECT * FROM eventos WHERE id = 3 ";
    $result3 = executar_sql($sql3);
    $tabela3 = mysqli_fetch_assoc($result3);
    $evento3 = $tabela3['evento'];

    //valor evento id = 4 para $evento4
    $sql4 = "SELECT * FROM eventos WHERE id = 4 ";
    $result4 = executar_sql($sql4);
    $tabela4 = mysqli_fetch_assoc($result4);
    $evento4 = $tabela4['evento'];

    //valor evento id = 5 para $evento5
    $sql5 = "SELECT * FROM eventos WHERE id = 5 ";
    $result5 = executar_sql($sql5);
    $tabela5 = mysqli_fetch_assoc($result5);
    $evento5 = $tabela5['evento'];

    //valor evento id = 6 para $evento6
    $sql6 = "SELECT * FROM eventos WHERE id = 6 ";
    $result6 = executar_sql($sql6);
    $tabela6 = mysqli_fetch_assoc($result6);
    $evento6 = $tabela6['evento'];

    //valor evento id = 7 para $evento7
    $sql7 = "SELECT * FROM eventos WHERE id = 7 ";
    $result7 = executar_sql($sql7);
    $tabela7 = mysqli_fetch_assoc($result7);
    $evento7 = $tabela7['evento'];

    //valor evento id = 8 para $evento8
    $sql8 = "SELECT * FROM eventos WHERE id = 8 ";
    $result8 = executar_sql($sql8);
    $tabela8 = mysqli_fetch_assoc($result8);
    $evento8 = $tabela8['evento'];

    //valor evento id = 9 para $evento9
    $sql9 = "SELECT * FROM eventos WHERE id = 9 ";
    $result9 = executar_sql($sql9);
    $tabela9 = mysqli_fetch_assoc($result9);
    $evento9 = $tabela9['evento'];

    //troca o valor dos eventos no database
    if (!empty($evento1)) {
        $sqlupdate2 = "UPDATE eventos SET evento = '$evento1' WHERE (id = '2')";
        executar_sql($sqlupdate2);
    }

    if (!empty($evento2)) {
        $sqlupdate3 = "UPDATE eventos SET evento = '$evento2' WHERE (id = '3')";
        executar_sql($sqlupdate3);
    }

    if (!empty($evento3)) {
        $sqlupdate4 = "UPDATE eventos SET evento = '$evento3' WHERE (id = '4')";
        executar_sql($sqlupdate4);
    }

    if (!empty($evento4)) {
        $sqlupdate5 = "UPDATE eventos SET evento = '$evento4' WHERE (id = '5')";
        executar_sql($sqlupdate5);
    }

    if (!empty($evento5)) {
        $sqlupdate6 = "UPDATE eventos SET evento = '$evento5' WHERE (id = '6')";
        executar_sql($sqlupdate6);
    }

    if (!empty($evento6)) {
        $sqlupdate7 = "UPDATE eventos SET evento = '$evento6' WHERE (id = '7')";
        executar_sql($sqlupdate7);
    }

    if (!empty($evento7)) {
        $sqlupdate8 = "UPDATE eventos SET evento = '$evento7' WHERE (id = '8')";
        executar_sql($sqlupdate8);
    }

    if (!empty($evento8)) {
        $sqlupdate9 = "UPDATE eventos SET evento = '$evento8' WHERE (id = '9')";
        executar_sql($sqlupdate9);
    }

    if (!empty($evento9)) {
        $sqlupdate10 = "UPDATE eventos SET evento = '$evento9' WHERE (id = '10')";
        executar_sql($sqlupdate10);
    }

    //monta o evento e insere no database
    date_default_timezone_set('America/Sao_Paulo');
    $hora = date("H:i");
    $dia = date("d/m/Y");
    $eventoprincipal = $user . " " . $evento . " " . $hora . " de " . $dia;
    $sqlupdate1 = "UPDATE eventos SET evento = '$eventoprincipal' WHERE (id = '1')";
    executar_sql($sqlupdate1);
}


function executar_sql($comando_sql){
    require('config.php');
    return $conexao->query($comando_sql);
}
