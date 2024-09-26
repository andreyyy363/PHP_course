<?php
$target_dir = "uploads/";
$file = $_FILES["fileToUpload"];
$target_file = $target_dir . basename($file["name"]);
$uploadOk = true;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Перевіряємо, чи файл завантажено
if (!is_uploaded_file($file["tmp_name"])) {
    echo "Файл не був завантажений.<br>";
    $uploadOk = false;
}

// Перевіряємо тип файлу
$allowedTypes = ['jpg', 'jpeg', 'png'];
if (!in_array($fileType, $allowedTypes)) {
    echo "Дозволено завантажувати лише файли типу JPG, JPEG або PNG.<br>";
    $uploadOk = false;
}

// Перевіряємо розміру файлу (не більше 2MB)
if ($file["size"] > 2 * 1024 * 1024) {
    echo "Розмір файлу перевищує 2MB.<br>";
    $uploadOk = false;
}

// Перевіряємо, чи існує файл з таким же ім'ям
if (file_exists($target_file)) {
    // Додаємо унікальний суфікс
    $target_file = $target_dir . time() . "_" . basename($file["name"]);
}

// Якщо всі перевірки пройдено, завантажуємо файл
if ($uploadOk) {
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        echo "Файл успішно завантажений.<br>";
        echo "Ім'я файлу: " . basename($file["name"]) . "<br>";
        echo "Тип файлу: " . $fileType . "<br>";
        echo "Розмір файлу: " . round($file["size"] / 1024, 2) . " KB<br>";
        echo "<a href='$target_file'>Завантажити файл</a>";
    } else {
        echo "Виникла помилка при завантаженні файлу.";
    }
}
?>
