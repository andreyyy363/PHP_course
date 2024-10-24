<?php
include 'validation.php';

// Підключення до бази даних
$conn = pg_connect("host=postgres dbname=testDatabase user=laravel-getting-started-user password=laravel-getting-started-password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

// Валідація даних форми
$validationError = validateForm($username, $email, $password, $confirmPassword);
if ($validationError) {
    pg_close($conn);
    exit();
}

$passwordHash = password_hash($password, PASSWORD_BCRYPT);

// Перевірка, чи існує користувач з такою електронною поштою
$sql = "SELECT * FROM users WHERE email = $1";
$result = pg_query_params($conn, $sql, array($email));

// Якщо користувач з такою електронною поштою вже існує
if (pg_num_rows($result) > 0) {
    echo "Користувач з такою електронною поштою вже існує";
} else {
    // Створення нового користувача у базі даних
    $sql = "INSERT INTO users (username, email, password) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $sql, array($username, $email, $passwordHash));

    // Перевірка, чи користувач успішно зареєстрований
    if ($result) {
        echo "success";
    } else {
        echo "Помилка під час реєстрації";
    }
}

pg_close($conn);
