<?php

$request_body = file_get_contents('php://input');
$request_data = json_decode($request_body, true);
header('Access-Control-Allow-Origin: *');

session_start(); // inicia a sessão
if(!empty($_SESSION["nick"])){
  
    $response['status'] = "logged_in";
    $response["nick"] = $_SESSION['nick'];

    echo (json_encode($response));

    exit();
}
if((empty($request_data['email']) || empty($request_data['senha']))){
    http_response_code(400);
    echo '{"success": false, "error": "missing_parameter"}';
    exit();
}

$connect = new mysqli('localhost','root','', 'hackathon_db'); // conectar db
$email =  mysqli_real_escape_string($connect, $request_data['email']);
$senha = sha1($request_data['senha']);
$select = $connect->query("SELECT * FROM users WHERE email = '$email' AND senha = '$senha' LIMIT 1");
if($select->num_rows){
    $row = $select->fetch_assoc();
    $response["success"] = true;
    $response["nick"] = $row['nick'];
    $response["email"] = $row['email'];
    
    $response["bonus_card"] = "";

    $login_times = (int)$row["login_times"] + 1;
    if((time() - $row["last_login_bonus"]) > 24*60*60){ // a cada 24 horas
        $my_str = file_get_contents('metadados.json');
        $metadados = json_decode($my_str, true);
        $bonus_card = explode('_', $metadados[rand(0, 49)]["nome"], 2)[0] ;
        $response["bonus_card"] = $bonus_card;
        $cards = json_decode($row["cards"], true);
        array_push($cards, $bonus_card);
        $cards = json_encode($cards, true);
        $select = $connect->query("UPDATE users SET last_login_bonus=" . time() .", cards='$cards' WHERE ID=" . $row['ID']); 
        
    }
    $select = $connect->query("UPDATE users SET login_times=" . $login_times ." WHERE ID=" . $row['ID']); // AUMENTA QUANTAS VEZES FEZ LOGIN
    $_SESSION["email"] = $email;
    $_SESSION["nick"] =  $row['nick'];
    $_SESSION["id"] =  $row['ID'];
    echo(json_encode($response));
}else{
    $response["success"] = false;
    $response["error"] = "incorrect_login";
    http_response_code(401);
    echo(json_encode($response));
}
//echo var_dump($select)
?>




