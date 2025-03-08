<?php
// Стартуем сессии
session_start();

// Удаляем сессию (очищаем все данные)
session_unset();
session_destroy();

// Перенаправляем пользователя на index.php
header('Location: task11.php');
exit;
