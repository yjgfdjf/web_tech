<?php
require_once 'data.php';
require_once 'functions.php';
$testString = 'Привет, Тюмень!';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа 18</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include 'menu.php'; ?>
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-blue-600">Лабораторная работа 18</h1>

        <!-- Задание 1 -->
        <h2 class="text-2xl font-semibold mt-6 text-gray-800">Задание 1: Числа от 0 до 10</h2>
        <p class="mt-2 text-lg text-gray-700"><?php echo printNumbers(); ?></p>

        <!-- Задание 2 -->
        <h2 class="text-2xl font-semibold mt-6 text-gray-800">Задание 2: Области и города</h2>
        <p class="mt-2 text-lg text-gray-700">
            <?php
            foreach ($regions as $region => $cities) {
                echo "$region:<br>" . implode(', ', $cities) . ".<br>";
            }
            ?>
        </p>

        <!-- Задание 3 -->
        <h2 class="text-2xl font-semibold mt-6 text-gray-800">Задание 3: Транслитерация</h2>
        <p class="mt-2 text-lg text-gray-700">Исходная строка: <?php echo $testString; ?></p>
        <p class="mt-2 text-lg text-gray-700">Транслит: <?php echo transliterate($testString, $translitMap); ?></p>

        <!-- Задание 4 -->
        <h2 class="text-2xl font-semibold mt-6 text-gray-800">Задание 4: Динамическое меню</h2>
        <p class="mt-2 text-lg text-gray-700">Меню выведено в шапке страницы (с выпадающим подменю).</p>

        <!-- Задание 5 -->
        <h2 class="text-2xl font-semibold mt-6 text-gray-800">Задание 5: Меню на движке</h2>
        <p class="mt-2 text-lg text-gray-700">Меню реализовано в папке engine.</p>

        <!-- Задание 6 -->
        <h2 class="text-2xl font-semibold mt-6 text-gray-800">Задание 6: Города на К</h2>
        <p class="mt-2 text-lg text-gray-700"><?php echo printCitiesStartingWithK($regions); ?></p>
    </div>
</body>
</html>