<html>
    
    
<head>
<title> Cadastro de Usuário </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/index.css"> 
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
    <input type="submit" value="logout" id="logout" name="logout">');}?>

</form>
</body>
</html>

<?php if(!empty($_SESSION)){echo ('');}?>