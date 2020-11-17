<?php 
session_start();
if(!empty($_SESSION['nick'])){
    echo "<META http-equiv='refresh' content='0;URL=/tela_1.php?fb=ja_logado' />";
    exit();
}
if (!empty( $_GET['fb'])){
    $fb = $_GET['fb'];
   if($fb == "success"){
    echo "<META http-equiv='refresh' content='0;URL=/tela_1.php' />";
    exit();
   }
   else if($fb == "falta_parametro"){
    echo "<div id='fb'>Não deixe nenhum dos campos em branco!</div>";
   }
   else if($fb == "usuario_ou_senha_errados"){
    echo "<div id='fb'>Usuário ou senha errados!</div>";
   }
}
?>
<html>
    <head>
        <title> Login </title>
        <link rel="shortcut icon" href="/imagens/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/tela_login.css"> 
    </head>
    <body>

        <div id="logos">
            <img src="imagens\imagens_jogo\LOGO.png" id="logo" class="logos" alt="logo">
            <img src="imagens\imagens_jogo\logo_Museu_Futebol.png" id="logo_museu" class="logos" alt="museu do futebol">
        </div>

        <div id="escrita_1">
            <p>
                <b>Curte figurinhas? Venha bater bafo!</b><br>
                Faça o login, jogue e complete seu álbum.
            </p>
        </div>

        <form method="POST" action="includes/login.inc.php">
            <input type="email" name="email" id="email" placeholder="&nbsp;&nbsp;Digite seu e-mail"><br>
            <input type="password" name="senha" id="senha" placeholder="&nbsp;&nbsp;Digite sua senha">
            <div id="escrita_2">
                <p>
                    <a href="tela_registro.php">Ainda não tem cadastro? Clique aqui e faça já o seu!</a>
                </p>
            </div>
            <input type="submit" value="OK" id="enviar">
        </form>
    </body>
</html>