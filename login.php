<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Login | PolyChain</title>

    <!-- Bootstrap core CSS and JS -->
    <link href="css/home.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ceae024db6.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Google API -->
    <meta name="google-signin-client_id"
          content="896534143716-umtk7t15u3abclh3ntbng01d625qnpmh.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .container{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-content: center;
        }

        #google-singin{
            width: 100%;
            display: flex;
            justify-content: center;
            align-content: center;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="login.css" rel="stylesheet">
</head>
<script>



    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        var $json = {
            "userName": profile.getName(),
            "email": profile.getEmail()
        };
        //alert(profile.getEmail());
        $.ajax({
            type: 'POST',
            url: '../phpFunctions/oauth2Register.php',
            //dataType: "json",
            data: $json,
            success: function (response) {
                var obj = JSON.parse(response);
            }
        });
    };


</script>
<body class="text-center">
<div class="container">
    <div id="login_form" class="form-signin">
        <img class="mb-4" src="src/logo.png" alt="" width="232.5" height="187">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required
               autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="Pass" id="inputPassword" class="form-control" placeholder="Password" required>
        <input type="hidden" name="Login" value="LOGIN">
        <?php
        if (isset($_SESSION["fail_login"])) {
            echo "<span id='Erro_msg' style=' color: red;width: 100%;display: inline-block;text-align: left;padding-left: 2%;margin: 5px 0px'>" . "Invalid Email or Password" . "</span>";

        } elseif (isset($_SESSION['AC_disable'])) {
            echo "<span id='Erro_msg' style=' color: red;width: 100%;display: inline-block;text-align: left;padding-left: 2%;margin: 5px 0px'>" . "Account Disabled" . "</span>";
        }
        ?>
        <div id="msg">
            hello
        </div>
        <button class="btn btn-lg btn-primary btn-block" id='btnSub'>Sign in</button>


    </div>
    <div class="g-signin2" id="google-singin"
         class="google-login" data-onsuccess="onSignIn"></div>
    <p class="mt-5 mb-3 text-muted">&copy; 2022-2023</p>
</div>
</body>
</html>
