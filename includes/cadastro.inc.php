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

/* abre json e pega 4 cartas aleatorias, então transforma em array json */
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

// tbm tem que incluir as cartas aleatorias em json
$select = $connect->query("INSERT INTO users (email, nick, senha, cards) VALUES('$email', '$nick' ,'$senha', '$final_json')");
if($select){
    $select = $connect->query("SELECT * FROM users WHERE email = '$email' AND nick = '$nick'");
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