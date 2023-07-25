<?php
session_start();
//var_dump($_SESSION);
if(empty($_SESSION['id']) || empty($_SESSION['nick']) || empty($_SESSION['email'])){
    session_destroy();
    echo "<META http-equiv='refresh' content='0;URL=/tela_login.php' />";
    exit();
}
//echo 'ola ' . $_SESSION['nick'];
?>




<html>
    <head>
        <title> Login </title>
        <link rel="shortcut icon" href="/imagens/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>window.location.replace(<?php     
        
        $connect = new mysqli('localhost','root','', 'hackathon_db'); // conectar db
        $select = $connect->query("SELECT * FROM users WHERE ID='" . $_SESSION['id'] . "' LIMIT 1");
        $row = $select->fetch_assoc();
        if($select->num_rows){
            if($row['login_times'] == 0){ // first time
                echo "\"/tutorial/tutorial_tela_1.php\"";
            }else{
                echo "\"/game/game.php\"";
            }
        }else{
            echo 'wtf? error 0x891';
            exit(-1);
        }
        
        
        
        ?>);</script>
    </head>
    <body>
        
    </body>
</html>