<?php
//echo "1";

session_start(); // inicia a sessão
date_default_timezone_set('America/Sao_Paulo');
if(!empty($_SESSION["nick"])){
    echo "<META http-equiv='refresh' content='0;URL=/tela_1.php'>";
    exit();
}
if(empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['nick'])){
    echo "<META http-equiv='refresh' content='0;URL=/tela_registro.php?fb=falta_parametro'>";
    exit();
}

/* abre json e pega 4 cartas aleatorias, então transforma em array json */ // kkkk n sabia do json_encode até entao
$my_str = file_get_contents('metadados.json');
$my_json = json_decode($my_str, true);
$final_json = "[";
for ($i=0; $i<4; $i++){
     $final_json .= "\"" .$my_json[rand(0, 49)]["nome"] . "\"" . ",";
}
$final_json = substr_replace($final_json, ']', strlen($final_json)-1); // array final


/*Conecta com a DB e faz query segura */

$connect = new mysqli('localhost','root','', 'hackathon_db'); // conectar db
$email =  mysqli_real_escape_string($connect, $_POST['email']);
$nick =  mysqli_real_escape_string($connect, $_POST['nick']); 
$senha = sha1($_POST['senha']);

if(filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_STRING  ) == false){
    echo "<META http-equiv='refresh' content='0;URL=/tela_registro.php?fb=email_invalido'>";
    exit();
}

$time = time();
// tbm tem que incluir as cartas aleatorias em json
// n dá bonus em 24 hrs dps do login :)
$select = $connect->query("INSERT INTO users (email, nick, senha, cards, last_login_bonus) VALUES('$email', '$nick' ,'$senha', '$final_json', '$time')");
if($select){
    $select = $connect->query("SELECT * FROM users WHERE email = '$email' AND nick = '$nick'"); // pra pegar o id '-'
    $row = $select->fetch_assoc();

    echo "Usuário criado com sucesso!"; // also, criar sessão e logar automaticamente
    $_SESSION["email"] = $email;
    $_SESSION["nick"] = $nick;
    $_SESSION["id"] = $row["ID"];
    echo "<META http-equiv='refresh' content='0;URL=/tela_1.php'>";
}else{
    echo "<META http-equiv='refresh' content='0;URL=/tela_registro.php?fb=ja_usado'>";
    echo "Email ou nickname já utilizado!";
}
?>