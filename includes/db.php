<?php
/** @var @var mysqli $conn */

$servername = "127.127.126.32";
$username = "root";
$password = "";
$dbname = "test_project_1";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    throw new RuntimeException("Ошибка подключения: " . $conn->connect_error);
}

echo "Подключение к базе данных прошло успешно.";