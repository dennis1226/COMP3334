<?php
include_once ("dbConnection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $userName = $_POST['plaintext'];

    //$arr = array('plaintext' => $plaintext, 'key' => $key, 'encodedText' => $encode, 'decodedText' => $decode,);
    echo $userName;
}else{
    echo "false";
}

?>
