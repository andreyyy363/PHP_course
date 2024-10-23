<?php
session_start();

// Перевірка, чи користувач автентифікований
if (!isset($_SESSION['username'])) {
    echo "Ви не авторизовані.";
    exit();
}

// Підключення до бази даних
$conn = pg_connect("host=postgres dbname=testDatabase user=laravel-getting-started-user password=laravel-getting-started-password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Отримання даних з форми
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Отримання поточного імені користувача з сесії
$current_username = $_SESSION['username'];

// Оновлення даних користувача
$sql = "UPDATE users SET username = $1, password = $2 WHERE username = $3";
$result = pg_query_params($conn, $sql, array($username, $password, $current_username));

// Перевірка, чи дані користувача успішно оновлені
if ($result) {
    $_SESSION['username'] = $username;
    echo "success";
} else {
    echo "Помилка під час оновлення профілю";
}

pg_close($conn);
?>