<?php
session_start();

$timeout = 300;

// Перевірка часу останньої активності
if (isset($_SESSION['last_activity'])) {
    if (time() - $_SESSION['last_activity'] > $timeout) {
        session_unset();
        session_destroy();
        header("Location: process.php");
        exit();
    }
}

// Оновлення часу останньої активності
$_SESSION['last_activity'] = time();

// Ініціалізація сесії для збереження товарів у корзині
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Ініціалізація cookie для збереження попередніх покупок
if (!isset($_COOKIE['previous_cart'])) {
    $previous_cart = [];
} else {
    $previous_cart = unserialize($_COOKIE['previous_cart']);
}

// Додавання товарів до корзини через POST-запит
if (isset($_POST['product'])) {
    $product = htmlspecialchars($_POST['product']);
    $_SESSION['cart'][] = $product;
    $previous_cart[] = $product;
    setcookie('previous_cart', serialize($previous_cart), time() + (86400 * 30));
    header("Location: process.php");
}

// Видалення корзини
if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = [];
}

// Видалення попередніх покупок
if (isset($_POST['clear_previous_cart'])) {
    setcookie('previous_cart', '', time() - 3600);
    $previous_cart = [];
}

include 'index.html';
?>