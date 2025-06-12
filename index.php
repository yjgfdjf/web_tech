<?php
$pageTitle = "Лабораторная работа 16";
$headerText = "PHP Динамическая страница";
$currentYear = date('Y');

function formatTimeWithDeclension(): string {
    $hours = (int)date('H');
    $minutes = (int)date('i');

    $hourWord = match (true) {
        $hours % 10 === 1 && $hours % 100 !== 11 => 'час',
        $hours % 10 >= 2 && $hours % 10 <= 4 && ($hours % 100 < 10 || $hours % 100 >= 20) => 'часа',
        default => 'часов',
    };

    $minuteWord = match (true) {
        $minutes % 10 === 1 && $minutes % 100 !== 11 => 'минута',
        $minutes % 10 >= 2 && $minutes % 10 <= 4 && ($minutes % 100 < 10 || $minutes % 100 >= 20) => 'минуты',
        default => 'минут',
    };

    return "$hours $hourWord $minutes $minuteWord";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-blue-600"><?php echo htmlspecialchars($headerText); ?></h1>
        <p class="mt-4 text-lg text-gray-700">Текущий год: <?php echo $currentYear; ?></p>
        <p class="mt-2 text-lg text-gray-700">Текущее время: <?php echo formatTimeWithDeclension(); ?></p>
    </div>
</body>
</html>