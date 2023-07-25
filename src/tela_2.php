<?php
session_start();
if(empty($_SESSION['nick'])){
    echo "<META http-equiv='refresh' content='0;URL=/tela_login.php' />";
    exit();
}
//echo 'ola ' . $_SESSION['nick'];
?>




<html>
    <head>
        <title> Login </title>
        <link rel="shortcut icon" href="/imagens/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/tela_2.css"> 
    </head>
    <body>
        <section id ="tudo">
            <img src="imagens\imagens_jogo\LOGO_com_Donas_da_Bola_Roxo.png" id="logo_bola" class="logos" alt="logo">
            <div>
                <p id="textinho">
                    A história do futebol feminino é marcada por mulheres guerreiras que enfrentaram muitos desafios para que o futebol feminino brasileiro chegasse aos títulos.<br>
Por isso, essa edição do jogo é dedicado a elas! <br>
<br>
Complete seu álbum de figurinhas com fotos históricas do acervo de algumas jogadoras que passaram pela nossa seleção. <br>
Vem com a gente!<br>
                </p>
            </div>
            <div>
            </div>
            
        <footer>
            
        <img src="imagens\imagens_jogo\icon_socialmedia.png" id="compartilhar" alt="redes sociais">   
        <img src="imagens\imagens_jogo\logo_Museu_Futebol_Contorno_Branco.png" id="logo_museu" alt="museu do futebol">
            <a href="/tela_3.php">
            <img src="imagens\imagens_jogo\seta_direita.svg" class="setas" alt="avançar">     
        </a>
        </section>
        </footer>
    </body>
</html>