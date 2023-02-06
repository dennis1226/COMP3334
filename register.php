<?php
$json = "";
$html = <<<HTML
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
             <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
             <meta http-equiv="X-UA-Compatible" content="ie=edge">
             <title>Document</title>
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<script>
    $(document).ready(function() {
        $("#testBtn").click(function () {
           
            $json = {
                "userName":$("#userName").val(),
                "password":"password"
            };
            $.ajax({
                type: 'POST',
                url: 'verifyRegister.php'
                data:$json,
                success: function (response) {
                    alert(response);
                }
            });

        });
    });
</script>
<body>
  <div>
    <input type="text" id="userName">
    <button id="submit">Submit</button>
</div>
</body>

HTML;

$html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);

echo $html;