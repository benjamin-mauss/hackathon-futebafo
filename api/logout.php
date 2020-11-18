<?php
include 'cors.php';
session_start();
session_destroy();
echo "{\"status\": \"logged_out\"}";
exit();

?>