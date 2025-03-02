<?php
$comment = $_POST['comment'];

$servername = "MySQL-8.0"; // Имя сервера базы данных
$username = "root"; // Имя пользователя базы данных
$password = ""; // Пароль пользователя базы данных
$dbname = "database_name"; // Имя базы данных


// Подключение к базе данных
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Проверка соединения
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL-запрос для вставки комментария
$sql = "INSERT INTO comments (comment) VALUES ('$comment')";

// Выполнение запроса
if (mysqli_query($conn, $sql)) {
    echo "Комментарий успешно сохранен!";
} else {
    echo "Ошибка: " . $sql . "" . mysqli_error($conn);
}



/*

$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$query = "INSERT INTO comments (comment) VALUES (:comment)";
$statement = $db->prepare($query);
$results = $statement->execute(['comment' => $comment]);


*/