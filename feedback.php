<?php
require_once "includes/auth.php";
requireLogin();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Обратная связь</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Форма обратной связи</h2>

<form method="POST" action="">
    <div class="mb-3">
        <label class="form-label" for="subject">Тема</label>
        <input type="text" class=form-control" id="subject" name="subject" required>
    </div>

    <button type="submit" name="send" class="btn btn-primary">Отправить</button>
</form>
</body>
</html>