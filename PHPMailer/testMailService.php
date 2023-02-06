<?php

include_once ("MailService.php");

$subject = "Your one-time code";
$receiver = "lamwaikit0305@gmail.com";
$otp = random_int(100000, 999999);
sendOTP($receiver,$otp);
