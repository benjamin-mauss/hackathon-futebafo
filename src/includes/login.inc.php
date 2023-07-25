<?php

session_start(); // inicia a sessão
date_default_timezone_set('America/Sao_Paulo'); // n afeta o time, mas anyway, sem problemas
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
    
    if((time() - $row["last_login_bonus"]) > 24*60*60){ // a cada 24 horas
        
        // abre arquivo
        $my_str = file_get_contents('metadados.json');
        $metadados = json_decode($my_str, true);
        // gera carta aleatoria, pegando so numero do nome
        $bonus_card = explode('_', $metadados[rand(0, 49)]["nome"], 2)[0] ;
        //echo "bonus = $bonus_card \n";
        // agora tem q dar uma carta pra ele
        
        $cards = json_decode($row["cards"], true);
        
        array_push($cards, $bonus_card);
       // var_dump($cards);
        $cards = json_encode($cards, true);
        $select = $connect->query("UPDATE users SET last_login_bonus=" . time() .", cards='$cards' WHERE ID=" . $row['ID']); 
    }
    $select = $connect->query("UPDATE users SET login_times=" . $login_times ." WHERE ID=" . $row['ID']); // AUMENTA QUANTAS VEZES FEZ LOGIN
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