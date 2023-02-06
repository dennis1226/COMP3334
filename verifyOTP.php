<?php
if(!isset($_SESSION))
{
    session_start();
}
$email = $_SESSION['email']??NULL;
$otpService = $_SESSION["otpService"]??NULL;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="module" src="/js/js.cookie.mjs"></script>
    <script nomodule defer src="/js/js.cookie.js"></script>

    <link rel="stylesheet" href="css/verifyOTP.css">
    <script src="js/verifyOTP.js"></script>

</head>
<body>

<?php
echo "<input type=\"text\" style='display: none' id=\"email\" value=\"$email\">";
echo "<input type=\"text\" style='display: none'  id=\"otpService\" value=\"$otpService\">";
?>
<div class="disable" id="loading-block">
    <div class="load">
        <div class="load-one"></div>
        <div class="load-two"></div>
        <div class="load-three"></div>
    </div>
</div>
<div class="container">
    <div class="main">
        <div class="img-container"><img src="src/otp-email.jpg" alt=""></div>
        <div class="main-header">
            <div>The One-Time Pad has sent to your email</div>
            <div class="header">Please Enter Your One-Time Pad</div>
        </div>
        <div class="input-container">
            <div><input type="text" id="otp-0"></div>
            <div><input type="text" id="otp-1"></div>
            <div><input type="text" id="otp-2"></div>
            <div><input type="text" id="otp-3"></div>
            <div><input type="text" id="otp-4"></div>
            <div><input type="text" id="otp-5"></div>
        </div>
        <div class="input-container">
            <div id="msg"></div>
        </div>
        <div class="button-container">
            <button id="submit">Submit</button>
        </div>
    </div>
</div>
</body>

</html>