<?php
session_start();
include 'index.html';
$conn = mysqli_connect("MySQL-8.2", "root", "", "users");

if (!$conn) {
    die("Connection to DB failed." . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Реєстрація
    if (isset($_POST['register'])) {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $hashed_password = md5($password);

        $query = mysqli_prepare($conn, "INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($query, "sss", $username, $email, $hashed_password);
        mysqli_stmt_execute($query);

        if (mysqli_stmt_affected_rows($query) > 0) {
            echo "Реєстрація успішна! Ви можете авторизуватись.";
        } else {
            echo "Помилка: " . mysqli_stmt_error($query);
        }
    }

    // Авторизація
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = mysqli_prepare($conn, "SELECT username, password FROM users WHERE username = ?");
        mysqli_stmt_bind_param($query, "s", $username);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $username_db = $row['username'];
            $hashed_password = $row['password'];

            if (md5($password) === $hashed_password) {
                $_SESSION['username'] = $username_db;
                header("Location: process.php");
                exit();
            } else {
                echo "Неправильний пароль.";
            }
        } else {
            echo "Користувача з таким іменем не знайдено.";
        }
    }

    // Вихід
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: process.php");
        exit();
    }

    mysqli_close($conn);
}
?>