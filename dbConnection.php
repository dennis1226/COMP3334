<?php
function getConnection(){
    $host = 'azure3334.mysql.database.azure.com';
    $username = 'comp3334root@azure3334';
    $password = 'password!23';
    $db_name = 'comp3334';

    $conn = mysqli_init();

    mysqli_ssl_set($conn, NULL, NULL, "/var/www/html/Dig.crt.pem", NULL, NULL);
    mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306, MYSQLI_CLIENT_SSL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);

    if (mysqli_connect_errno()) {
        die('Failed to connect to MySQL: '.mysqli_connect_error());
    }else{
        return $conn;
    }
}
