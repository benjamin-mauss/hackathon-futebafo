<?php
//echo "1";


$request_body = file_get_contents('php://input');
$request_data = json_decode($request_body, true);

session_start(); // inicia a sessão
date_default_timezone_set('America/Sao_Paulo');
if(!empty($_SESSION["nick"])){
    http_response_code(400);
    echo '{"success":false, "error":"logado"}'; exit();
    exit();
}

if(empty($request_data['email']) || empty($request_data['senha']) || empty($request_data['nick'])){

    http_response_code(400);
    echo '{"success":false, "error":"falta_parametro"}'; exit();
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

$email =  mysqli_real_escape_string($connect, $request_data['email']);
$nick =  mysqli_real_escape_string($connect, $request_data['nick']); 
$senha = sha1($request_data['senha']);


if(filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_STRING  ) == false){
    http_response_code(400);
    echo '{"success":false, "error":"email_invalido"}'; exit();
}

$time = time();
// tbm tem que incluir as cartas aleatorias em json
// n dá bonus em 24 hrs dps do login :)
$select = $connect->query("INSERT INTO users (email, nick, senha, cards, last_login_bonus) VALUES('$email', '$nick' ,'$senha', '$final_json', '$time')");
if($select){
    $select = $connect->query("SELECT * FROM users WHERE email = '$email' AND nick = '$nick'"); // pra pegar o id '-'
    $row = $select->fetch_assoc();

    // echo "Usuário criado com sucesso!"; // also, criar sessão e logar automaticamente

    $_SESSION["email"] = $email;
    $_SESSION["nick"] = $nick;
    $_SESSION["id"] = $row["ID"];
    echo "{\"success\":true, \"nick\":\"$nick\"}";
}else{
    http_response_code(400);
    echo '{"success":false, "error":"email_or_nickname_already_in_use"}'; exit();
}
?>