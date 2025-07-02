<?php
require_once "includes/auth.php";
require_once "includes/db.php";
requireLogin();

/** @var mysqli $conn */
$userId = $_SESSION['user_id'];
$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["send"])) {
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);
    $radio = $_POST["radio_option"] ?? '';
    $checkboxes = isset($_POST["checkbox_options"]) ? implode(", ", $_POST["checkbox_options"]) : '';
    $dropdown = $_POST["dropdown_option"] ?? '';

    if ($subject && $message && $radio && $dropdown) {
        $stmt = $conn->prepare("INSERT INTO feedback (user_id, subject, message, radio_option, checkbox_options, dropdown_option) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $userId, $subject, $message, $radio, $checkboxes, $dropdown);

        if ($stmt->execute()) {
            $successMessage = "Сообщение успешно отправлено!";
        } else {
            $errorMessage = "Ошибка при отправке сообщения: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $errorMessage = "Пожалуйста, заполните все поля.";
    }

    $conn->close();
}
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

<?php if ($successMessage) : ?>
    <div class="alert alert-success"><?= htmlspecialchars($successMessage) ?></div>
<?php elseif ($errorMessage) : ?>
    <div class="alert alert-danger"><?= htmlspecialchars($errorMessage) ?></div>
<?php endif; ?>

<form method="POST" action="">
    <div class="mb-3">
        <label class="form-label" for="subject">Тема</label>
        <input type="text" class="form-control" id="subject" name="subject" required
               value="<?= htmlspecialchars($subject ?? '') ?>">
    </div>

    <div class="mb-3">
        <label class="form-label" for="message">Сообщение</label>
        <textarea class="form-control" name="message" id="message" rows="4" required><?= htmlspecialchars($message ?? '') ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Было ли Вам удобно пользоваться нашим сайтом?</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="radio_option" id="radio1" value="Да"
                   <?= (isset($radio) && $radio === "Да") ? "checked" : "" ?> required>
            <label class="form-check-label" for="radio1">Да</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="radio_option" id="radio2" value="Нет"
           <?= (isset($radio) && $radio === "Нет") ? "checked" : "" ?>>
            <label class="form-check-label" for="radio2">Нет</label>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Какие глобальные моменты, на Ваш взгляд, требуют улучшений?</label><br>
        <?php
        $checkboxValues = explode(', ', $checkboxes ?? '');
        ?>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="checkbox_options[]" id="cb1" value="Визуальное восприятие"
                <?= in_array("Визуальное восприятие", $checkboxValues) ? "checked" : "" ?>>
            <label class="form-check-label" for="cb1">Визуальное восприятие</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="checkbox_options[]" id="cb2" value="Больше функций"
                <?= in_array("Больше функций", $checkboxValues) ? "checked" : "" ?>>
            <label class="form-check-label" for="cb2">Больше функций</label>
        </div>
    </div>

    <div class="mb-3">
        <label for="dropdown_option" class="form-label">Тип обращения</label>
        <select class="form-select" id="dropdown_option" name="dropdown_option" required>
            <option value="">Выберите...</option>
            <option value="Вопрос" <?= (isset($dropdown) && $dropdown === "Вопрос") ? "selected" : "" ?>>Вопрос</option>
            <option value="Ошибка" <?= (isset($dropdown) && $dropdown === "Ошибка") ? "selected" : "" ?>>Ошибка</option>
            <option value="Предложение" <?= (isset($dropdown) && $dropdown === "Предложение") ? "selected" : ""?>>Предложение</option>
        </select>
    </div>

    <button type="submit" name="send" class="btn btn-primary">Отправить</button>
    <button type="reset" class="btn btn-secondary">Сбросить</button>
</form>
</body>
</html>