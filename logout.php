<?php
session_start();

extract($_SESSION);

unset($_SESSION['access_token']);

if ($isGoogle){
    $gClient->revokeToken();
}

session_destroy();

header("Location: index.php");
?>