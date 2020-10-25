<?php
//echo "1";

session_start(); // inicia a sessão

if(!empty($_SESSION["nick"])){
    echo "<META http-equiv='refresh' content='0;URL=/tela_1.php'>";
    exit();
}
if(empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['nick'])){
    echo "<META http-equiv='refresh' content='0;URL=/tela_registro.php?fb=falta_parametro'>";
    exit();
}


$connect = new mysqli('localhost','root','', 'hackathon_db'); // conectar db
$email =  mysqli_real_escape_string($connect, $_POST['email']);
$nick =  mysqli_real_escape_string($connect, $_POST['nick']); 
$senha = sha1($_POST['senha']);

if(filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_STRING  ) == false){
    echo "<META http-equiv='refresh' content='0;URL=/tela_registro.php?fb=email_invalido'>";
    exit();
}

$select = $connect->query("INSERT INTO users (email, nick, senha) VALUES('$email', '$nick' ,'$senha')");
if($select){
    echo "Usuário criado com sucesso!"; // also, criar sessão e logar automaticamente
    $_SESSION["email"] = $email;
    $_SESSION["nick"] = $nick;
    $_SESSION["pwd"] = $senha;
    echo "<META http-equiv='refresh' content='0;URL=/tela_1.php'>";
}else{
    echo "<META http-equiv='refresh' content='0;URL=/tela_registro.php?fb=ja_usado'>";
    echo "Email ou nickname já utilizado!";
}
?>