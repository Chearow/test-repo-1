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

    <div class="mb-3">
        <label class="form-label" for="message">Сообщение</label>
        <textarea class="form-control" name="message" id="message" rows="4" required></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Было ли Вам удобно пользоваться нашим сайтом?</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type=radio name="radio_option" id="radio1" value="Да" required>
            <label class="form-check-label" for="radio1">Да</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="radio_option" id="radio2" value="Нет">
            <label class="form-check-label" for="radio2">Нет</label>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Какие глобальные моменты, на Ваш взгляд, требуют доработки?</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="checkbox_options[]" id="cb1" value="Визуал">
            <label class="form-check-label" for="cb1">Визуал</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="checkbox_options[]" id="cb2" value="Функционал">
            <label class="form-check-label" for="cb2">Функционал</label>
        </div>
    </div>

    <div class="mb-3">
        <label for="dropdown_option" class="form-label">Тип обращения</label>
        <select class="form-select" id="dropdown_option" name="dropdown_option" required>
            <option value="">Выберите...</option>
            <option value="Вопрос">Вопрос</option>
            <option value="Ошибка">Ошибка</option>
            <option value="Предложение">Предложение</option>
        </select>
    </div>

    <button type="submit" name="send" class="btn btn-primary">Отправить</button>
    <button type="reset" class="btn btn-secondary">Сбросить</button>
</form>
</body>
</html>