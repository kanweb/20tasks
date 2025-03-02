<?php
session_start(); // Запускаем сессию

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем текст комментария из формы
    $comment = $_POST['comment'];

    // Проверяем, заполнено ли поле комментария
    if (empty($comment)) {
        $_SESSION['error'] = 'Заполните поле комментария!';
        header('Location: task6.php'); // Перенаправляем пользователя обратно к форме
        exit;
    }

    $servername = "MySQL-8.0"; // Имя сервера базы данных
    $username = "root"; // Имя пользователя базы данных
    $password = ""; // Пароль пользователя базы данных
    $dbname = "database_name"; // Имя базы данных

// Подключение к базе данных
    $conn = mysqli_connect($servername, $username, $password, $dbname);


    // Проверка соединения
    if (!$conn) {
        $_SESSION['error'] = "Connection failed: " . mysqli_connect_error();
        header('Location: task6.php'); // Перенаправляем пользователя обратно к форме
        exit;
    }

// SQL-запрос для вставки комментария
    $sql = "INSERT INTO comments (comment) VALUES ('$comment')";

// Выполнение запроса
    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = 'Комментарий успешно сохранен!';
        header('Location: task6.php'); // Перенаправляем пользователя обратно к форме
        exit;
    } else {
        $_SESSION['error'] = "Ошибка: " . $sql . " " . mysqli_error($conn);
        header('Location: task6.php'); // Перенаправляем пользователя обратно к форме
        exit;
    }

}
