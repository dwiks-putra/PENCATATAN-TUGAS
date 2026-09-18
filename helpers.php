<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!function_exists('xss_clean')) {
    function xss_clean($data) {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
}


if (!function_exists('cek_login')) {
    function cek_login() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }
    }
}
?>