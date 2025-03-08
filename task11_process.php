<?php
session_start();

if (!isset($_POST["try"])) {
    $_SESSION['error'] = 'Введите число';
    header('Location: task11.php');
    exit;
}

if ($_POST["try"] < 0 || $_POST["try"] > 20) {
    $_SESSION['error'] = 'Ошибка ввода, неверный диапазон';
    header('Location: task11.php');
    exit;
}

//Проверяем меньше /больше / равно
if ($_POST["try"] > $_SESSION['hidden']) {
    $_SESSION["attempts"]--;
    $_SESSION['error'] = 'Загаданное число меньше.';
} elseif ($_POST["try"] < $_SESSION['hidden']) {
    $_SESSION["attempts"]--;
    $_SESSION['error'] = 'Загаданное число больше.' ;
} elseif ($_POST["try"] == $_SESSION['hidden']) {
    $_SESSION['success'] = 'Вы угадали! Загаданное число '.$_SESSION['hidden'].'. Сыграем еще разок!';
}

//проверяем количество попыток
if ($_SESSION['attempts'] == 0 && isset($_SESSION['error'])) {
    $_SESSION['error'] = 'Попытки закончились. Загаданное число ' . $_SESSION['hidden'] . '.';
}


header('Location: task11.php');
exit; // Завершаем скрипт


?>
