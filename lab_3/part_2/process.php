<?php
session_start();

$valid_username = "test";
$valid_password = "test";

// Перевірка логіна та пароля
if (isset($_POST['login']) && isset($_POST['password'])) {
    $username = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['username'] = $username;
        header("Location: process.php");
        exit();
    } else {
        $error = "Неправильний логін або пароль!";
    }
}

// Завершення сесії
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: process.php");
    exit();
}

// Вивід привітання
if (isset($_SESSION['username'])) {
    $greeting = "Привіт, " . htmlspecialchars($_SESSION['username']) . "!";
} else {
    $greeting = '';
}
include 'index.html';
?>