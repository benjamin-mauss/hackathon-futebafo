

<?php 

header('Location: /tela_login.php');
exit();
?>
<html>
    
    
<head>
<!--<META http-equiv='refresh' content='0;URL=/tela_login.php' />-->
<title> foo </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/index.css"> 
    <script>
    function get_cards(){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("cards").innerHTML =
                this.responseText;
        }
        };
        xhttp.open("POST", "game/get_user_cards.php", true);
        xhttp.send();
    }
    </script>
</head>

<body>
<?php
    session_start(); // inicia a sessão
    //phpinfo();
    if(!empty($_SESSION)){
        echo "vc esta logado como " . $_SESSION["nick"];
    }else{
        echo "voce n esta logado!";
    }
    
    ?>

    <h2>registrar</h2>
<form method="POST" action="includes/cadastro.inc.php">
<label>Nick : </label><input type="text" name="nick" id="nick"><br>
<label>Email:</label><input type="text" name="email" id="email"><br>
<label>Senha:</label><input type="password" name="senha" id="senha"><br>
<input type="submit" value="Cadastrar" id="cadastrar" name="cadastrar">
</form>
    <h2>login</h2>
<form method="POST" action="includes/login.inc.php">
    <label>Email:</label><input type="text" name="email" id="email"><br>
    <label>Senha:</label><input type="password" name="senha" id="senha"><br>
    <input type="submit" value="login" id="login" name="login">
</form>
<?php if(!empty($_SESSION)){echo ('<form method="POST" action="includes/logout.inc.php">
    <input type="submit" value="logout" id="logout" name="logout"></form>');}?>
<br>
<form method="POST" action="game/to_hit.php">
    <label>JSON:</label><input type="text" name="json" id="json" value='{"aposta": ["55","43","55","43"]}' style="width:500px;">
    <input type="submit" value="hit" id="hit" name="hit">
</form>
    <button onclick="get_cards()">get cards</button>
    <p id=cards></p>
</form>
</body>
</html>
