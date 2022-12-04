<?php
include_once("../conexao.php");
session_start();
$saida = $_SESSION['id'];
$entrada = mysqli_real_escape_string($conexao, $_POST['entrada']);
$sql = mysqli_query($conexao, "SELECT * FROM `mensagem` LEFT JOIN `usuario` ON mensagem.saida = usuario.usuario_id WHERE saida = '{$saida}' AND entrada = '{$entrada}' OR saida = '{$entrada}' AND entrada = '{$saida}'");
if(!$sql)
{
    echo "Falhou";
}
else
{
    if(mysqli_num_rows($sql) > 0)
    {
        while($row = mysqli_fetch_assoc($sql))
        {
            if($row['saida'] == $saida)
            {
                /*echo '<div class="chat outgoing">
                <div class="details">
                    <p class="messages">'.$row["messagens"].'</p>
                </div>
            </div>';*/
                echo '<div class="chat saida">
                <div class="dados">
                    <p>'.$row["messagens"].'</p>
                </div>
            </div>';
            }
            else
            {
                /*echo '<div class="chat incoming">
                <p class="details">'.$row["messagens"].'</p>
            </div>';*/
                echo '<div class="chat entrada">
                <p class="dados">'.$row["messagens"].'</p>
            </div>';
            }
        }
    }
    else
    {
        echo '<div style"justify-content:center;">Diga olá!</div>';
    }
}
?> 