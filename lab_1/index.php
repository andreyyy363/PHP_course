<?php
// Part 1
echo "Hello, World!"; // Вивід на екран тексту "Hello, World!"
echo "<br>";

// Part 2
// Оголошення змінних різних типів
$stringVar = "Привіт"; // рядок
$intVar = 123; // ціле число
$floatVar = 12.34; // число з плаваючою комою
$boolVar = true; // булеве значення

// Виводимо значення змінних
echo $stringVar, "<br>";
echo $intVar, "<br>";
echo $floatVar, "<br>";
echo $boolVar, "<br>";

// Вивід типу кожної змінної
var_dump($stringVar);
echo "<br>";
var_dump($intVar);
echo "<br>";
var_dump($floatVar);
echo "<br>";
var_dump($boolVar);
echo "<br>";

// Part 3
// Створення двох змінних з рядковими значеннями
$firstName = "Hello";
$lastName = "World!";

// Об'єднання змінних в одну
$fullName = $firstName . " " . $lastName;
// Вивід результату
echo $fullName;
echo "<br>";

// Part 4
// Створення змінної з парним числовим значенням
$number = 10;

// Перевірка, чи є число парним або непарним
if ($number % 2 == 0) {
    echo "$number - парне число.<br>";
} else {
    echo "$number - непарне число.<br>";
}

// Створення змінної з непарним числовим значенням
$number = 3;

// Перевірка, чи є число парним або непарним
if ($number % 2 == 0) {
    echo "$number - парне число.<br>";
} else {
    echo "$number - непарне число.<br>";
}

// Part 5
// Цикл for: числа від 1 до 10
for ($i = 1; $i <= 10; $i++) {
    echo $i . " ";
}
echo "<br>";
// Цикл while: числа від 10 до 1
$j = 10;
while ($j >= 1) {
    echo $j . " ";
    $j--;
}
echo "<br>";

// Part 6
// Створення асоціативниого масиву
$student = [
    "ім'я" => "Андрій",
    "прізвище" => "Штепура",
    "вік" => 19,
    "спеціальність" => "122 - Комп'ютерні науки"
];

// Вивід значення кожного елемента масиву
echo "Ім'я: " . $student['ім\'я'] . "<br>";
echo "Прізвище: " . $student['прізвище'] . "<br>";
echo "Вік: " . $student['вік'] . "<br>";
echo "Спеціальність: " . $student['спеціальність'] . "<br>";

// Додавання нового елементу "середній бал"
$student['середній бал'] = 91.38;

// Вивід оновленного масиву
var_dump($student);
