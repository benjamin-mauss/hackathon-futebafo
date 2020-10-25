<?php
session_start();
if(empty($_SESSION['nick'])){
    echo "<META http-equiv='refresh' content='0;URL=/tela_login.php' />";
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
                <h1 id="vc">Você sabia?</h1>
                <p id ="proibidas">Por quase 40 anos (!!!), entre 1941 e 1979, as mulheres foram proibidas de jogar bola no Brasil!</h3>
                <h4 id="tag">#futebolfeminino #donasdabola #futebafo #museudofutebol</h4>
                <p id = "fonte">Fonte: Folha de S.P., 2019. Disponível em: <a href="https://www1.folha.uol.com.br/esporte/2019/06/proibido-no-brasil-futebol-feminino-ja-foi-ate-atracao-de-circo.shtml">www1.folha.uol.com.br/esporte/2019/06/proibido-no-brasil-futebol-feminino-ja-foi-ate-atracao-de-circo.shtml</a></p>
            </div>
            <div>
            <a href="#">
            <img src="imagens\imagens_jogo\icon_socialmedia.png" id="compartilhar"  alt="redes sociais">
            </a>
            </div>
            <p id="textinho">
                Essa foi só uma das dificuldades que nossas guerreiras enfrentaram para que o futebol feminino brasileiro chegasse aos títulos.<br>
                Por isso, essa edição do jogo é dedicado a elas! 
                Complete seu álbum com as figurinhas fotos históricas do acervo de algumas jogadoras que passaram pela nossa seleção. 
                Vem com a gente!
            </p>
            
            <img src="imagens\imagens_jogo\logo_Museu_Futebol_Contorno_Branco.png" id="logo_museu" class="logos" alt="museu do futebol">
            
        </section>
        
    </body>
</html>