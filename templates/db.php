<?php
session_start();

$db_host = getenv('MYSQLHOST');
$db_user = getenv('MYSQLUSER');      
$db_pass = getenv('MYSQLPASSWORD');
$db_name = getenv('MYSQLDATABASE');   
$db_port = getenv('MYSQLPORT');

if (!$db_host || !$db_user || !$db_pass || !$db_name || !$db_port) {
    die("Что то с переменными, смотри RailWay");
}

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);

$conn->connect_error ? die("Ошибка подключения к бд: " . $conn->connect_error) : " ";

$conn->set_charset("utf8");


