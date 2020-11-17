<?php
session_start(); // inicia a sessão


/*INICIO VERIFICAÇÕES DE SEGURANÇA */
if(empty($_SESSION["nick"]) || empty($_SESSION["email"]) || empty($_SESSION["id"])){
    session_destroy();
    echo '{"success":false, "error":"sessão invalida"}'; exit();
}
if(empty($_POST['json'])){
    echo '{"success":false, "error":"falta parametro"}'; exit();
}

$_json = json_decode($_POST['json'], true);
if(json_last_error() != JSON_ERROR_NONE){
    echo '{"success":false, "error":"não é json}"}'; exit();
}
if(empty($_json["aposta"])){
    echo '{"success":false, "error":"não tem aposta}"}'; exit();
}
if(sizeof($_json["aposta"]) < 3){
    echo '{"success":false, "error":"aposta com menor que 3 cartas"}'; exit();
}
for($i = 0; $i < sizeof($_json["aposta"]); $i++){ // verifica se todas são numeros
    if(!is_numeric($_json["aposta"][$i])){
        echo '{"success":false, "error":"nem todos as aposta são numeros"}'; exit();
    }
}

// CONECTA DB
$connect = new mysqli('localhost','root','', 'hackathon_db'); // conectar db
$select = $connect->query("SELECT * FROM users WHERE ID = '" . $_SESSION['id'] . "' LIMIT 1");
$row = $select->fetch_assoc();
if($select->num_rows){
    $cards = json_decode($row['cards'], true);
    if (sizeof($cards) >= sizeof($_json["aposta"])){ // verifica se tem o numero minimo de cartas para apostar

        for($i=0;$i<sizeof($_json["aposta"]); $i++){ // verificar se o usuario tem todas as cartas selecionadas
            if(in_array($_json["aposta"][$i], $cards)){
                continue;
            }
            else{
                echo '{"success":false, "error":"você não tem alguma carta que selecionou"}'; exit(); // 
            }
        }
        // verifica se o usuario tem a quantidade necessaria para efetuar a troca
        $num_time_aposta = array_count_values($_json["aposta"]); 
        $num_time_db     = array_count_values($cards);

        for($i=0;$i<sizeof($_json["aposta"]); $i++){ // pra cada item da aposta            
            if($num_time_db[$_json["aposta"][$i]] < $num_time_aposta[$_json["aposta"][$i]]){
                echo '{"success":false, "error":"carta foi repitida mais vezes que no exite baralho"}'; exit(); 
            }
        }        
    }else{
        echo '{"success":false, "error":"estás apostando mais cartas do que tens"}'; exit(); // 
    }
}else{
    echo '{"success":false, "error":"erro genérico (8)"}'; exit(); // erro genérico
}
/*FIM VERIFICAÇÕES DE SEGURANÇA */


// abre metadados
$my_str = file_get_contents('../includes/metadados.json');
$metadados = json_decode($my_str, true);

// gera array de cartas oponente
$enemy_cards = [];
for ($i=0; $i<sizeof($_json['aposta']); $i++){
     $enemy_cards[$i] = $metadados[rand(0, 49)]["nome"];
}

//print("\nMy cards    = " . json_encode($cards, true));
//print("\nMy apost    = " . json_encode($_json["aposta"], true));

// gera, aleatoriamente, um array de cartas que perdermos
$cartas_perdidas = []; // ate agora
for ($i=0; $i < sizeof($_json["aposta"]); $i++){
    if((rand() % 100) > 30){ // 70% de taxa de vitória para minhas proprias cartas
        // ganhou, mantem elas
    }else{
        // perdeu, add no array de cartas perdidas
        array_push($cartas_perdidas, $_json["aposta"][$i]);
    }
}
//print("\nEnemy cards = " . json_encode($enemy_cards, true));

// gera, aleatoriamente, um array de cartas que ganhamos do inimigo
$cartas_ganhas_do_inimigo = [];
for ($i=0; $i < sizeof($enemy_cards); $i++){
    if((rand() % 100) > 50){ // 50% de taxa de vitória para cartas do inimigo
        array_push($cartas_ganhas_do_inimigo, $enemy_cards[$i]);
    }else{
        // deixou de ganhar        
    }
}
//echo "\n PERDIDAS   = " . json_encode($cartas_perdidas);
//echo "\n GANHAS     = " . json_encode($cartas_ganhas_do_inimigo);
$cards_db = json_decode($row['cards'], true);

/* funçoes auxiliares */ 
function retorna_primeira_posicao_encontrado_array($my_array = [], $valor_procurado){

    for ($k=0; $k < sizeof($my_array); $k++){ 
        if($my_array[$k] == $valor_procurado){
            return $k;
        }
    }
    return false;
}

function pop_posicao_especifica_array($my_array = [], $posicao){
    $novo_array = [];
    for ($k=0; $k < sizeof($my_array); $k++){ 
        if($k != $posicao){
            array_push($novo_array, $my_array[$k]);
        }
    }
    return $novo_array;
}

// REMOVER AS CARTAS PERDIDAS DO ARRAY TOTAL
$array_final = $cards_db;
for ($k=0; $k < sizeof($cartas_perdidas); $k++){ // pra cada carta perdida
    $array_final = pop_posicao_especifica_array($array_final, retorna_primeira_posicao_encontrado_array($array_final, $cartas_perdidas[$k]));
}

// REMOVER AS CARTAS PERDIDAS DO ARRAY VIRADAS
$array_viradas = $_json["aposta"];
for ($k=0; $k < sizeof($cartas_perdidas); $k++){ // pra cada carta perdida
    $array_viradas = pop_posicao_especifica_array($array_viradas, retorna_primeira_posicao_encontrado_array($array_viradas, $cartas_perdidas[$k]));
}

 // ADICIONAR AS CARTAS GANHAS
 for ($k=0; $k < sizeof($cartas_ganhas_do_inimigo); $k++){ // pra cada carta perdida
    array_push($array_final, $cartas_ganhas_do_inimigo[$k]); // add pro total
    array_push($array_viradas, $cartas_ganhas_do_inimigo[$k]); // add pro viradas
}

//echo "FINAL      = " . json_encode($array_final);
sort($array_final); // crescente, pra ficar mais bonitin
$db_array_final = json_encode($array_final);



$select = $connect->query("UPDATE users SET cards='$db_array_final' WHERE ID = '" . $_SESSION['id'] . "' LIMIT 1;");


function retorna_filename_pelo_numero_inicial($numero_inicial){
    $diretorio = dir("../imagens/figurinhas/");
    
    for($cont = -2; $file_name = $diretorio -> read(); $cont++){ // -2 pq tem o dir . e ..
         if(strpos($file_name, "_") === false){ // evita erros,  . e ..
              continue;
         }
         $file_name = explode('_', $file_name, 2);
         if(($file_name[0] == $numero_inicial)){
             return $file_name[0] . "_" . $file_name[1];
         }
    }
    
    $diretorio -> close();
}



sort($array_viradas); // crescente, pra ficar mais bonitin

$array_response = json_decode('{"success":true,"resultado_aposta":[]}', true);

$array_filenames = [];
for ($i=0; $i<sizeof($array_viradas); $i++){

    $array_filenames[$i] = retorna_filename_pelo_numero_inicial($array_viradas[$i]);

    $array_response["resultado_aposta"][$i] = array( // adiciona à response
        'numero'   => $array_viradas[$i],
        'addrr_img'     => $array_filenames[$i]
    );
}

   

print(json_encode($array_response)); // responde com o json das cartas viradas


?>