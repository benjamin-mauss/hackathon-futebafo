<?php
session_start(); 
$quantity = $_GET["quantity"];

// TODO: verificações de segurança. nick válido, 3 ou mais cards.

// abre metadados
$my_str = file_get_contents('metadados.json');
$metadados = json_decode($my_str, true);
$enemy_cards = [];


for ($i=0; $i<$quantity; $i++){
    $enemy_cards[$i] = $metadados[rand(0, 49)]["nome"];
}

// saída temporária. se tiver ideia melhor, chama no commit
$_SESSION['opponent_cards'] = $enemy_cards;
$response['opponent_cards'] = json_encode($enemy_cards);

?>