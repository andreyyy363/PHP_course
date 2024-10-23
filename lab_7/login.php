<?php
// Підключення до бази даних
$conn = pg_connect("host=postgres dbname=testDatabase user=laravel-getting-started-user password=laravel-getting-started-password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Отримання даних з форми
$email = $_POST['email'];
$password = $_POST['password'];

// Формування запиту до бази даних
$sql = "SELECT * FROM users WHERE email=$1";
$result = pg_query_params($conn, $sql, array($email));

// Перевірка, чи існує користувач з такою електронною поштою
if (pg_num_rows($result) > 0) {
    $user = pg_fetch_assoc($result);
    // Перевірка пароля
    if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['username'] = $user['username'];
        echo "success";
    } else {
        echo "Невірний пароль";
    }
} else {
    echo "Користувач не знайдений";
}

pg_close($conn);
?>