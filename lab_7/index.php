<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Головна</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php session_start(); ?>
    <div class="container">
        <?php if (isset($_SESSION['username'])): ?>
            <h1>Вітаємо, <?php echo $_SESSION['username']; ?>!</h1>
            <button id="profileBtn">Редагувати профіль</button>
            <button id="logoutBtn">Вийти</button>
        <?php else: ?>
            <h1>Вітаємо на сайті!</h1>
            <button id="loginBtn">Увійти</button>
            <button id="registerBtn">Зареєструватися</button>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="main.js"></script>
</body>

</html>