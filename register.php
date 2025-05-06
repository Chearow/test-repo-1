<?php
require_once "includes/db.php";
/** @var mysqli $conn */

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $user =$conn->real_escape_string($_POST['username']);
    $email =$conn->real_escape_string($_POST['email']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$pass')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class = 'alert alert-success'>Регистрация прошла успешно! </div>";
    } else {
        echo "<div class = 'alert alert-danger'>Ошибка: " . $conn->error . "</div>";
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2>Регистрация</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">Имя пользователя</label>
            <label>
                <input type="text" class="form-control" name="username" value="<?=htmlspecialchars($_POST['username'] ??'') ?>" required>
            </label>
        </div>

        <div class="mb-3">
            <label class="form-label">Электронная почта</label>
            <label>
                <input type="email" class="form-control" name="email" value="<?=htmlspecialchars($_POST['email'] ?? '') ?>" required>
            </label>
        </div>

        <div class="mb-3">
            <label class="form-label">Пароль</label>
            <label>
                <input type="password" class="form-control" name="password" required>
            </label>
        </div>

        <button type="submit" name="register" class="btn btn-primary">Зарегистрироваться</button>
    </form>

</body>
</html>
