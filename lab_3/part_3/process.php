<?php
// Перевірка метод запиту
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: redirect.html");
    exit();
}

$client_ip = $_SERVER['REMOTE_ADDR']; 
echo "IP-адреса клієнта:<br>$client_ip<br>";

$user_agent = $_SERVER['HTTP_USER_AGENT']; 
echo "Інформація про браузер:<br>$user_agent<br>";

$script_name = $_SERVER['PHP_SELF'];
echo "Назва скрипта:<br>$script_name<br>";

$request_method = $_SERVER['REQUEST_METHOD'];
echo "Метод запиту (GET або POST):<br>$request_method<br>";

$file_path = $_SERVER['SCRIPT_FILENAME'];
echo "Шлях до файлу на сервері:<br>$file_path<br>";
?>