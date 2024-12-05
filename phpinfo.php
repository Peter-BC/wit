<?php
$conn_str = getenv('MYSQLCONNSTR_localdb');
parse_str(str_replace(';', '&', $conn_str), $db_params);

$servername = $db_params['Server'];
$dbname = $db_params['Database'];
$username = $db_params['User'];
$password = $db_params['Password'];


var_dump($servername, $username, $password, $dbname);