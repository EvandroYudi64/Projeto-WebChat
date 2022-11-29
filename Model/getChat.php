<?php
include_once("../conexao.php");
session_start();
$outgoingid = $_SESSION['id'];
$incomingid = mysqli_real_escape_string($conexao, $_POST['incomingid']);

// get message query
$getMsgQuery = "SELECT * FROM `mensagem` LEFT JOIN `usuario` ON mensagem.saida = usuario.usuario_id WHERE saida = '{$outgoingid}' AND entrada = '{$incomingid}' OR saida = '{$incomingid}' AND entrada = '{$outgoingid}'";
$runGetMsgQuery = mysqli_query($conexao, $getMsgQuery);
if(!$runGetMsgQuery){
    echo "Query Failed";
}else{
    if(mysqli_num_rows($runGetMsgQuery) > 0){
        while($row = mysqli_fetch_assoc($runGetMsgQuery)){
            if($row['saida'] == $outgoingid){
                echo '<div class="chat outgoing">
                <div class="details">
                    <p class="messages">'.$row["messagens"].'</p>
                </div>
            </div>';
            }else{
                echo '<div class="chat incoming">
                <p class="details">'.$row["messagens"].'</p>
            </div>';
            }
        }
    }else{
        echo '<div id="errors">Diga olá!</div>';
    }
}
?> 