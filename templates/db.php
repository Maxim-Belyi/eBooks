<?php
session_start();

$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USERNAME');
$db_pass = getenv('DB_PASSWORD');
$db_name = getenv('DB_DATABASE');

if (!$db_host) {
    die("Ошибка с именем хоста");
}

if (!$db_user) {
    die("Ошибка с именем пользователя");
}
if (!$db_pass) {
    die("Ошибка пароля!");
}
if (!$db_name) {
    die("Ошибка в названии базы данных");
}



$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

$conn->connect_error ? die("Ошибка подключения к бд: " . $conn->connect_error) : " ";

$conn->set_charset("utf8mb4");
