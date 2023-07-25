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
   else if($fb == "email_invalido"){
    echo "<div id='fb'>Email inválido!</div>";
   }
   else if($fb == "ja_usado"){
    echo "<div id='fb'>Email ou nickname já utilizado!</div>";
   }
}
?>
<html>
    <head>
        <title> Registro </title>
        <link rel="shortcut icon" href="/imagens/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/tela_registro.css"> 
    </head>
    <body>

        <div id="logos">
            <img src="/imagens\imagens_jogo\LOGO.png" id="logo" class="logos" alt="logo">
            <img src="/imagens\imagens_jogo\logo_Museu_Futebol.png" id="logo_museu" class="logos" alt="museu do futebol">
        </div>

        <div id="escrita_1">
            <p>
                Crie seu perfil!
            </p>
        </div>

        <form method="POST" action="includes/cadastro.inc.php">
        <input type="text" name="nick" id="email" placeholder="&nbsp;&nbsp;Insira um nome de usuário"><br>
            <input type="email" name="email" id="email" placeholder="&nbsp;&nbsp;Insira seu e-mail"><br>
            <input type="password" name="senha" id="senha" placeholder="&nbsp;&nbsp;Crie uma senha">
            <div id="escrita_2">
                <p>
                    <a href="tela_login.php">Já tem cadastro? Clique aqui para fazer login!</a>
                </p>
            </div>
            <input type="submit" value="OK" id="enviar">
        </form>
    </body>
</html>