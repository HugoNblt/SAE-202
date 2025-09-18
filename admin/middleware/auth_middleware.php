<?php
require_once 'model/user_model.php';

function authMiddleware()
{
    session_start();

    if (!isset($_SESSION['user']) && isset($_COOKIE['remember_token'])) {

        $user = findByRememberToken($_COOKIE['remember_token']);

        if ($user) {
            session_regenerate_id(true);
            $_SESSION['user'] = $user;
        } else {
            setcookie('remember_token', '', time() - 3600, '/');
        }
    }
}