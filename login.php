<?php

session_start();
require_once "includes/db.php";
/** @var mysqli $conn */

if (!isset($conn) || $conn->connect_error) {
    die("Ошибка подключения к базе данных.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = trim($_POST['email']);
    $pass = $_POST["password"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $loginError = "Неверный формат email.";
    } else {
        $stmt = $conn->prepare("SELECT id, password_hash FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($pass, $user["password_hash"])) {
                $_SESSION['user_id'] = $user['id'];

                if (!empty($_SESSION['redirect_after_login'])) {
                    $redirectUrl = $_SESSION['redirect_after_login'];
                    unset($_SESSION['redirect_after_login']);
                }else {
                    $redirectUrl = 'dashboard.php';
                }

                $conn->close();
                header('Location: ' . $redirectUrl);
                exit();
            } else {
                $loginError = "Неправильный пароль.";
            }
        } else {
            $loginError = "Пользователь не найден.";
        }

        $stmt->close();
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Авторизация</h2>

    <?php
    if(!empty($loginError)):
    ?>
        <div class="alert alert-danger"><?=htmlspecialchars(($loginError)) ?></div>
    <?php
    endif;
    ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label" for="email">Электронная почта</label>
            <input id="email" type="email" class="form-control" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label" for="password">Пароль</label>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>

        <button type="submit" name="login" class="btn btn-primary">Войти</button>
    </form>
</body>
</html>