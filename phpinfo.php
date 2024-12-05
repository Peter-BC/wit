<?php
$servername = getenv('DB_HOST') ?: '127.0.0.1';
$username = getenv('DB_USERNAME') ?: 'myuser';
$password = getenv('DB_PASSWORD') ?: 'mypassword';
$dbname = getenv('DB_NAME') ?: 'mydatabase';

var_dump($servername, $username, $password, $dbname);