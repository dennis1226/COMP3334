<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Google API -->
    <meta name="google-signin-client_id"
          content="896534143716-lus5hqmhmt0si28d18g70mu8j3dusk3n.apps.googleusercontent.com">
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <link rel="stylesheet" href="css/register.css">
    <script src="js/normalRegister.js"></script>

</head>
<body>
<?php include_once 'header.php'; ?>
<div class="disable" id="loading-block">
    <div class="load">
        <div class="load-one"></div>
        <div class="load-two"></div>
        <div class="load-three"></div>
    </div>
</div>
<div class="main">
    <div class="register-container">
        <div class="register-container-div">
            <div class="heading">User Name</div>
            <div class="field"><input type="text" id="userName"></div>
            <div class="wrong-msg" id="userNameMsg"></div>
        </div>

        <div class="register-container-div">
            <div class="heading">Email</div>
            <div class="field"><input type="email" id="email"></div>
            <div class="wrong-msg" id="emailMsg"></div>
        </div>

        <div class="register-container-div">
            <div class="heading">Password</div>
            <div class="field"><input type="password" id="password"></div>
            <div class="wrong-msg" id="passwordMsg"></div>
        </div>
        <div class="register-container-div">
            <div class="heading">Confirm Password</div>
            <div class="field"><input type="password" id="confirmPassword"></div>
            <div class="wrong-msg" id="confirmPasswordMsg"></div>
        </div>

        <div class="register-container-div">
            <div class="g-recaptcha" data-callback="recaptchaCallback"
                 data-sitekey="6LeVgEsfAAAAAMnoQBssnZovTbFjEIzfthacvKeP"></div>
        </div>
        <div class="register-container-div">
            <button id="submit">Submit</button>
        </div>
        <div class="register-container-div">
            <div class="g-signin2"
                 data-width="280vh" data-height="40"
                 class="google-login" data-onsuccess="onSignIn"></div>
        </div>

    </div>
</div>


</body>

<script>
    //Normal Register
    document.getElementById("submit").addEventListener("click", verifyRobot);

</script>

</html>