<?php
include_once("../conexao.php");
session_start();
$sql = mysqli_query($conexao, "SELECT * FROM `usuario` WHERE usuario_id != '{$_SESSION["id"]} ORDER BY statusBol ASC'");

if(!$sql)
{
    echo "conexao falhou";
}
else
{
    if(mysqli_num_rows($sql) == 0)
    {
        echo '<div id="errors">Nenhum contato disponivel</div>';
    }
    elseif(mysqli_num_rows($sql) > 0)
    {
        while($campo = mysqli_fetch_assoc($sql))
        {
            $sql2 = mysqli_query($conexao, "SELECT * FROM mensagem WHERE (entrada = {$campo['usuario_id']}
            OR saida = {$campo['usuario_id']}) AND (saida = {$_SESSION["id"]} 
            OR entrada = {$_SESSION["id"]}) ORDER BY id_mensagem DESC LIMIT 1");
            $campo2 = mysqli_fetch_assoc($sql2);
            if(mysqli_num_rows($sql2) > 0)
            {
                $mensagem = $campo2['messagens'];
            }
            else
            {
                $mensagem = "Nenhuma mensagem";
            }

            if(strlen($mensagem)>20)
            {
                $msg = substr($mensagem, 0, 20).'...';
            }
            else
            {
                $msg = $mensagem;
            }


            if(isset($campo2['saida']))
            {
                if($_SESSION["id"] == $campo2['saida'])
                {
                    $enviou = "Você: ";
                }
                else
                {
                    $enviou = "";
                }
            }
            else
            {
                $enviou = "";
            }


            if($campo['status'] == "Offline")
            {
                $off = "offline";
            }
            else
            {
                $off = "";
            }
            $contatosOn="";
            $contatosOn .= '<a href="./mensagem.php?usuario_id='. $campo['usuario_id'] .'">
                        <div class="content">
                        <img src="../img/'. $campo['foto'].'" alt="">
                        <div class="details">
                            <span>'. $campo['nome']. " " . $campo['sobrenome'] .'</span>
                            <p>'. $enviou . $msg .'</p>
                        </div>
                        </div>
                        <div class="status-dot '. $off .'"><i class="fas fa-circle"></i></div>
                    </a><br>';
            echo $contatosOn;
        }
    }
    else
    {
        echo "Erro inesperado";
    }
}
?>