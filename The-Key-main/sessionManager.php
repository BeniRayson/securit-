<?php
session_start();

function check_session() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function login_user($user_id, $username) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
}

function logout_user() {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
?>