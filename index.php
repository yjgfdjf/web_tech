<?php
require_once 'functions.php';
require_once 'logic.php';

$a = 5;
$b = -3;

$a_switch = 10;

$arg1 = 10;
$arg2 = 5;
$operations = ['add', 'subtract', 'multiply', 'divide'];

$val = 2;
$pow = 3;

$year_file = 'year';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа 17</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-blue-600">Лабораторная работа 17</h1>

        <h2 class="text-2xl font-semibold mt-6 text-gray-800">Задание 1: Условия для $a и $b</h2>
        <p class="mt-2 text-lg text-gray-700">a = <?php echo $a; ?>, b = <?php echo $b; ?></p>
        <p class="mt-2 text-lg text-gray-700"><?php echo processNumbers($a, $b); ?></p>

        <h2 class="text-2xl font-semibold mt-6 text-gray-800">Задание 2: Числа от $a до 15</h2>
        <p class="mt-2 text-lg text-gray-700">a = <?php echo $a_switch; ?></p>
        <p class="mt-2 text-lg text-gray-700">Числа: <?php echo printNumbersFromA($a_switch); ?></p>

        <h2 class="text-2xl font-semibold mt-6 text-gray-800">Задание 3 и 4: Арифметические операции</h2>
        <p class="mt-2 text-lg text-gray-700">Аргументы: <?php echo $arg1; ?>, <?php echo $arg2; ?></p>
        <?php foreach ($operations as $op): ?>
            <p class="mt-2 text-lg text-gray-700">
                <?php
                $opName = match($op) {
                    'add' => 'Сложение',
                    'subtract' => 'Вычитание',
                    'multiply' => 'Умножение',
                    'divide' => 'Деление',
                };
                echo "$opName: " . mathOperation($arg1, $arg2, $op);
                ?>
            </p>
        <?php endforeach; ?>

        <h2 class="text-2xl font-semibold mt-6 text-gray-800">Задание 5: Текущий год</h2>
        <p class="mt-2 text-lg text-gray-700">Способ 1 (include):</p>
        <p class="mt-2 text-lg text-blue-600"><?php include($year_file . ".php"); ?></p>
        <p class="mt-2 text-lg text-gray-700">Способ 2 (file_get_contents):</p>
        <p class="mt-2 text-lg text-blue-600"><?php echo htmlspecialchars(getFileOutput($year_file)); ?></p>
        <p class="mt-2 text-lg text-gray-700">Способ 3 (renderTemplate):</p>
        <p class="mt-2 text-lg text-blue-600"><?php echo htmlspecialchars(renderTemplate($year_file)); ?></p>

        <h2 class="text-2xl font-semibold mt-6 text-gray-800">Задание 6: Рекурсивное возведение в степень</h2>
        <p class="mt-2 text-lg text-gray-700"><?php echo "$val в степени $pow = " . power($val, $pow); ?></p>
    </div>
</body>
</html>