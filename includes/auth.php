<?php

use JetBrains\PhpStorm\NoReturn;

session_start();

function requireLogin(): void {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['redirect_after_login'] = basename($_SERVER['REQUEST_URI']);
        header("Location: login.php");
        exit();
    }
}
#[NoReturn]
function logout(): void
{
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}