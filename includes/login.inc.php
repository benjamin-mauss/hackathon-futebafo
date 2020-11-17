<?php
session_start(); // inicia a sessão
if(!empty($_SESSION["nick"])){
    echo "<META http-equiv='refresh' content='0;URL=/tela_1.php?fb=ja_logado'>";
    exit();
}
if((empty($_POST['email']) || empty($_POST['senha']))){
    echo "<META http-equiv='refresh' content='0;URL=/tela_login.php?fb=falta_parametro'>";
    exit();
}

$connect = new mysqli('localhost','root','', 'hackathon_db'); // conectar db
$email =  mysqli_real_escape_string($connect, $_POST['email']);
$senha = sha1($_POST['senha']);
$select = $connect->query("SELECT * FROM users WHERE email = '$email' AND senha = '$senha' LIMIT 1");
if($select->num_rows){
    $row = $select->fetch_assoc(); //  criar sessão e logar automaticamente
    $login_times = (int)$row["login_times"] + 1;
    $select = $connect->query("UPDATE users SET login_times=" . $login_times ." WHERE ID=" . $row['ID']); // AUMENTA QUANTAS VEZES FEZ LOGIN
    // echo("Usuário encontrado!<br> Olá, ". $row['nick']);
    $_SESSION["email"] = $email;
    $_SESSION["nick"] =  $row['nick'];
    $_SESSION["id"] =  $row['ID'];
    
    echo "<META http-equiv='refresh' content='0;URL=/tela_login.php?fb=success' />";
}else{
    echo "Usuário ou senha incorretos!";
   echo "<META http-equiv='refresh' content='0;URL=/tela_login.php?fb=usuario_ou_senha_errados' />";
}
//echo var_dump($select)
?>