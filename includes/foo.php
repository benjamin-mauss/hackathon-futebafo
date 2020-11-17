<?php
/*
$my_str = file_get_contents('metadados.json');
$my_json = json_decode($my_str, true);
$final_json = "[";
for ($i=0; $i<4; $i++){
     $final_json .= "\"" .$my_json[rand(0, 49)]["nome"] . "\"" . ",";
}
echo $final_json = substr_replace($final_json, ']', strlen($final_json)-1);
*/


$path = "../imagens/figurinhas/";
$diretorio = dir($path);

echo "Lista de Arquivos do diretório '<strong>".$path."</strong>':<br />";
$arr_filesname = [];

for($cont = -2; $file_name = $diretorio -> read(); $cont++){ // -2 pq tem o dir . e ..
     if(strpos($file_name, "_") === false){ // evita erros,  . e ..
          continue;
     }
     $file_name = explode('_', $file_name);
     $file_name = $file_name[0];
     $arr_filesname[$cont] = $file_name;

}

var_dump($arr_filesname);
$diretorio -> close();

;

/* AGORA TEM QUE FAZER O AJAX PRA BATER, A PARTE DO SERVER E DO CLIENT*/
?>

