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
        <link rel="stylesheet" href="css/tela_1.css"> 
    </head>
    <body>
        <div id="logos">
            <img src="imagens\imagens_jogo\LOGO_com_Donas_da_Bola.png" id="logo_bola" class="logos" alt="logo"><br>
            <img src="imagens\imagens_jogo\logo_Museu_Futebol.png" id="logo_museu" class="logos" alt="museu do futebol"><br>
            <img src="imagens\loading.gif" id="loading">
            <script>

                function sleep (time) {
                    return new Promise((resolve) => setTimeout(resolve, time));
                }

                let museu = document.getElementById('logo_museu');

                sleep(1000).then(() => {
                    museu.style.width = '130px';
                    museu.style.height = '130px';
                sleep(1000).then(() => {
                    museu.style.width = '150px';
                    museu.style.height = '150px';
                 sleep(1000).then(() => {
                    location.href="tela_2.php";
                    
                });  
                });
                });
            </script>
        </div>
    </body>
</html>