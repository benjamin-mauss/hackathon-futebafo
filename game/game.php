<?php
session_start();
if(empty($_SESSION['nick'])){
    echo "<META http-equiv='refresh' content='0;URL=/tela_login.php' />";
    exit();
}
//echo 'ola ' . $_SESSION['nick'];
?>
<script>

function muda_pos(){
    
    var figurinhas = document.getElementsByClassName('figurinhas');
    //document.getElementsByClassName('tudo').style.textal
    let figurinha = 0;
    for(let cont = 0; cont < figurinhas.length; cont++){
        figurinha = figurinhas[cont];
        figurinha.style.transition = "all " + (1 + Math.random()*2) + "s"; // bah, random até a velocidade
        var graus = (Math.random()*180);
        figurinha.style.transform = 'rotate(' + graus + 'deg)';
        figurinha.style.width = "110";
        figurinha.style.marginTop = (Math.random())*360;
        figurinha.style.marginLeft = (Math.random())*180 + 10;
    }
    // faz ajax pro servidor
    // pedindo para bater
}

</script>
<html>
    <head>
        <title> Game </title>
        <link rel="shortcut icon" href="/imagens/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/game/game.css"> 
    </head>
    <body>
        
        <section id ="tudo" onclick="muda_pos()">
        <img src="/imagens\imagens_jogo\Figurinha_Vermelha.png" class="figurinhas">
        <img src="/imagens\imagens_jogo\Figurinha_Azul.png" class="figurinhas">
        <img src="/imagens\imagens_jogo\Figurinha_Verde.png" class="figurinhas">
        <img src="/imagens\imagens_jogo\Figurinha_Amarela.png" class="figurinhas">
        
        <img src="/imagens\imagens_jogo\Figurinha_Vermelha.png" class="figurinhas">
        <img src="/imagens\imagens_jogo\Figurinha_Azul.png" class="figurinhas">
        <img src="/imagens\imagens_jogo\Figurinha_Verde.png" class="figurinhas">
        <img src="/imagens\imagens_jogo\Figurinha_Amarela.png" class="figurinhas">
        </section>
        
        <script>
            var figurinhas = document.getElementsByClassName('figurinhas');
            var figurinha = 0;
            for(let cont = 0; cont < figurinhas.length; cont++){
            //alert(figurinha.style);
            figurinha = figurinhas[cont];
            
            figurinha.style.marginLeft = 100 + cont*2;
            
            }
            </script>
    </body>
</html>