<?php
// Задание 1: Условия для $a и $b
function processNumbers($a, $b): string {
    if ($a >= 0 && $b >= 0) {
        return "Оба положительные, разность: " . ($a - $b);
    } elseif ($a < 0 && $b < 0) {
        return "Оба отрицательные, произведение: " . ($a * $b);
    } else {
        return "Разные знаки, сумма: " . ($a + $b);
    }
}

// Задание 2: Switch для чисел от $a до 15
function printNumbersFromA($a): string {
    if ($a < 0 || $a > 15) {
        return "Число $a вне диапазона [0..15]";
    }
    $output = "";
    for ($i = $a; $i <= 15; $i++) {
        switch ($i) {
            case $i:
                $output .= "$i ";
                break;
        }
    }
    return $output;
}
?>