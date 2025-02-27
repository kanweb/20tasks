<?php
$comment = $_POST['comment'];

$servername = "MySQL-8.0"; // Имя сервера базы данных
$username = "root"; // Имя пользователя базы данных
$password = ""; // Пароль пользователя базы данных
$dbname = "database_name"; // Имя базы данных

$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$query = "INSERT INTO comments (comment) VALUES (:comment)";
$statement = $db->prepare($query);
$results = $statement->execute(['comment' => $comment]);


