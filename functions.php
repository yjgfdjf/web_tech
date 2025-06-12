<?php

function add($a, $b): float {
    return $a + $b;
}

function subtract($a, $b): float {
    return $a - $b;
}

function multiply($a, $b): float {
    return $a * $b;
}

function divide($a, $b): float {
    if ($b == 0) {
        throw new Exception("Деление на ноль невозможно");
    }
    return $a / $b;
}

function mathOperation($arg1, $arg2, $operation): float {
    switch ($operation) {
        case 'add':
            return add($arg1, $arg2);
        case 'subtract':
            return subtract($arg1, $arg2);
        case 'multiply':
            return multiply($arg1, $arg2);
        case 'divide':
            return divide($arg1, $arg2);
        default:
            throw new Exception("Неизвестная операция: $operation");
    }
}

function power($val, $pow): float {
    if ($pow === 0) {
        return 1;
    }
    if ($pow < 0) {
        return 1 / power($val, -$pow);
    }
    if ($pow === 1) {
        return $val;
    }
    return $val * power($val, $pow - 1);
}

function renderTemplate($page): string {
    ob_start();
    include $page . ".php";
    return ob_get_clean();
}

function getFileOutput($page): string {
    ob_start();
    include $page . ".php";
    return ob_get_clean();
}
?>