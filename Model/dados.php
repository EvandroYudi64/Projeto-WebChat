<?php

include_once("../conexao.php");

    while($campo = mysqli_fetch_assoc($query)){
        $sql2 = "SELECT * FROM mensagem WHERE (entrada = {$row['usuario_id']}
                OR saida = {$row['usuario_id']}) AND (saida = {$_SESSION["id"]} 
                OR entrada = {$_SESSION["id"]}) ORDER BY id_mensagem DESC LIMIT 1";
        $query2 = mysqli_query($conexao, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        (mysqli_num_rows($query2) > 0) ? $result = $row2['messagens'] : $result ="Nenhuma mensagem disponivel";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        if(isset($row2['saida'])){
            ($_SESSION["id"] == $row2['saida']) ? $you = "Você: " : $you = "";
        }else{
            $you = "";
        }
        ($row['status'] == "Offline") ? $offline = "offline" : $offline = "";
        $contatosOn="";
        $contatosOn .= '<a href="./mensagem.php?usuario_id='. $row['usuario_id'] .'">
                    <div class="content">
                    <img src="../img/'. $row['foto'].'" alt="">
                    <div class="details">
                        <span>'. $row['nome']. " " . $row['sobrenome'] .'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                </a><br>';
        echo $contatosOn;
    }
?>