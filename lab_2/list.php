<?php
$directory = 'uploads/';
$files = scandir($directory);

echo "<h2>Список файлів у директорії uploads:</h2>";
echo "<ul>";

foreach ($files as $file) {
    if ($file !== '.' && $file !== '..') {
        echo "<li><a href='$directory$file'>$file</a></li>";
    }
}

echo "</ul>";
?>
