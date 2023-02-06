<?php

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Google API -->
    <meta name="google-signin-client_id"
          content="896534143716-lus5hqmhmt0si28d18g70mu8j3dusk3n.apps.googleusercontent.com">

    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <link rel="stylesheet" href="css/login2.css">
    <script src="js/login2.js"></script>


    <title>Login</title>
</head>

<body>
<div class="disable" id="loading-block">
    <div class="load">
        <div class="load-one"></div>
        <div class="load-two"></div>
        <div class="load-three"></div>
    </div>
</div>
<div class="container">
    <div class="main">
        <div class="img-container"><img src="src/logo.png" alt=""></div>
        <div class="input-container">
            <div>Email</div>
            <div><input type="email" id="email"></div>
        </div>

        <div class="input-container">
            <div>Password</div>
            <div><input type="password" id="password"></div>
        </div>

        <div class="input-container">
            <div class="msg"></div>
        </div>
        <div class="input-container">
            <button id="subBtn">Sing in</button>
        </div>
        <div class="g-signin2"
             data-width="320" data-height="40"
             class="google-login" data-onsuccess="onSignIn"></div>

        <p class="since text-muted">&copy; 2022-2023</p>
    </div>
</div>
</body>

<script>
    document.getElementById("subBtn").addEventListener("click", doSingInVerify);
</script>
</html>


