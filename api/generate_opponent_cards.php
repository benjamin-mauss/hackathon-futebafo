<?php
session_start(); 
if(empty($_SESSION["nick"]) || empty($_SESSION["email"]) || empty($_SESSION["id"])){
    session_destroy();
    http_response_code(401);
    echo '{"success":false, "error":"sessão invalida"}'; exit();
}


$quantity = $_GET["quantity"]; //json?


// abre metadados
$my_str = file_get_contents('metadados.json');
$metadados = json_decode($my_str, true);
$enemy_cards = [];


for ($i=0; $i<$quantity; $i++){
    $enemy_cards[$i] = $metadados[rand(0, 49)]["nome"];
}

// saída temporária. se tiver ideia melhor, chama no commit
$_SESSION['opponent_cards'] = $enemy_cards;
$response['opponent_cards'] = $enemy_cards;

echo json_encode($response);
?>