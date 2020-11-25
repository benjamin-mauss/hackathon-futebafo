<?php
include 'cors.php';
session_start(); // inicia a sessão
/*INICIO VERIFICAÇÕES DE SEGURANÇA */
if(empty($_SESSION["nick"]) || empty($_SESSION["email"]) || empty($_SESSION["id"])){
    session_destroy();
    echo '{"success":false, "error":"sessão invalida"}'; exit();
}

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

$connect = new mysqli('localhost','root','', 'hackathon_db'); // conectar db
$select = $connect->query("SELECT cards FROM users WHERE ID = '" . $_SESSION['id'] . "' LIMIT 1");
$row = $select->fetch_assoc();

$cards = json_decode($row["cards"], true);
sort($cards); // crescente, pra ficar mais bonitin

$array_response = json_decode('{"success":true,"resultado_cards":[]}', true);

$array_filenames = [];
for ($i=0; $i<sizeof($cards); $i++){

    $array_filenames[$i] = retorna_filename_pelo_numero_inicial($cards[$i]);

    $array_response["resultado_cards"][$i] = array( // adiciona à response
        'numero'   => $cards[$i],
        'addrr_img'     => $array_filenames[$i]
    );
    $array_response["cards"] = $cards;
}

   
echo json_encode($array_response);

?>