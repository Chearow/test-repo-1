<?php
require_once "includes/auth.php";
requireLogin();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Добро пожаловать!</h2>
    <p>Вы успешно авторизованы. Ваш ID пользователя: <strong><?= htmlspecialchars($_SESSION['user_id']) ?></strong></p>

    <a href="logout.php" class="btn btn-danger">Выйти</a>
</body>
</html>