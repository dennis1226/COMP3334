<?php


use PHPMailer\PHPMailer\PHPMailer;

function sendOTP($receiver, $otp)
{
    $subject = "Your one-time code";
    $name = "PolyChain";  // Name of your website or yours
    $body = "Hi there, here is your one-time code, your one-time code will be expier after 5 minitues: <br><h2>" . $otp . "</h2><br> Please enter this code into the prompt to confirm your identity.";
    $from = "comp3334.test.mail@gmail.com";  // you mail
    $password = "Password!23";  // your mail password

    // Ignore from here

    require_once "PHPMailer.php";
    require_once "SMTP.php";
    require_once "Exception.php";
    $mail = new PHPMailer();

    //SMTP Settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging
    $mail->Host = "smtp.gmail.com"; // smtp address of your email
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;
    $mail->Port = 587;  // port
    $mail->SMTPSecure = "tls";  // tls or ssl
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($from, $name);
    $mail->addAddress($receiver); // enter email address whom you want to send
    $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()) {

    }
}

?>

