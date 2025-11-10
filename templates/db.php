<?php
session_start();

define('DB_HOST', 'mysql');
define('DB_USER', 'user');
define('DB_PASS', '1111');
define('DB_NAME', 'book_php');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$conn->connect_error ? die("Ошибка подключения к бд: " . $conn->connect_error) : " ";

$conn->set_charset("utf8");


