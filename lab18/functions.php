<?php
// Задание 1: Вывод чисел с do...while
function printNumbers(): string {
    $i = 0;
    $output = '';
    do {
        if ($i === 0) {
            $output .= "$i – это ноль.<br>";
        } elseif ($i % 2 === 0) {
            $output .= "$i – чётное число.<br>";
        } else {
            $output .= "$i – нечётное число.<br>";
        }
        $i++;
    } while ($i <= 10);
    return $output;
}

// Задание 3: Транслитерация
function transliterate(string $str, array $translitMap): string {
    return strtr($str, $translitMap);
}

// Задание 4 и 5: Генерация меню
function generateMenu(array $items, bool $isSubmenu = false): string {
    $ulClass = $isSubmenu ? 'absolute hidden group-hover:block bg-gray-700 text-white p-2 rounded' : 'flex space-x-4';
    $liClass = $isSubmenu ? 'py-1' : 'relative group';
    $output = "<ul class='$ulClass'>";
    foreach ($items as $item) {
        $output .= "<li class='$liClass'>";
        $output .= "<a href='{$item['url']}' class='text-white hover:text-blue-300'>{$item['title']}</a>";
        if (isset($item['submenu'])) {
            $output .= generateMenu($item['submenu'], true);
        }
        $output .= "</li>";
    }
    $output .= "</ul>";
    return $output;
}

// Задание 6: Города на "К"
function printCitiesStartingWithK(array $regions): string {
    $output = '';
    foreach ($regions as $region => $cities) {
        $kCities = array_filter($cities, fn($city) => substr($city, 0, 2) === 'К');
        if (!empty($kCities)) {
            $output .= "$region:<br>" . implode(', ', $kCities) . ".<br>";
        }
    }
    return $output;
}
?>