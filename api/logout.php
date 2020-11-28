<?php

session_start();
session_destroy();

$response['status'] = 'logged_out';

header('Content-Type: application/json');
echo(json_encode($response));
exit();

?>