<?php

require_once('model/user_model.php');
function index()
{
    $scripts = ["login.js"];
    require('view/autres_pages/header.php');
    require('view/auth_view.php');
    require('view/autres_pages/footer.php');
}

function register()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if ($_POST['password'] !== $_POST['confirm_password']) {
            $_SESSION['error_message'] = "Les mots de passe ne correspondent pas.";
            return header("Location: /auth");
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_message'] = "L'adresse e-mail n'est pas valide.";
            return header("Location: /auth");
        }

        if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['birth_date']) || empty($_POST['phone'])) {
            $_SESSION['error_message'] = "Tous les champs sont obligatoires.";
            return header("Location: /auth");
        }

        $data = [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'birth_date' => $_POST['birth_date'],
            'phone' => $_POST['phone']
        ];

        if (registerUser($data)) {
            $_SESSION['success_message'] = "Inscription réussie. Veuillez vous connecter.";
            header("Location: /auth");
            exit;
        } else {
            $_SESSION['error_message'] = "Erreur lors de l'inscription. Veuillez réessayer.";
        }
    }
}

function login()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = loginUser($email, $password);

        if ($user) {
            session_regenerate_id(true);
            $_SESSION['user'] = $user;
            $_SESSION['success_message'] = "Connexion réussie.";

            if (!empty($_POST['remember-me'])) {
                $token = bin2hex(random_bytes(32));
                $expires = time() + (30 * 24 * 60 * 60);

                setRememberToken($user['id'], $token);

                setcookie(
                    'remember_token',
                    $token,
                    [
                        'expires' => $expires,
                        'path' => '/',
                        'secure' => isset($_SERVER['HTTPS']),
                        'httponly' => true,
                        'samesite' => 'Lax'
                    ]
                );
            }

            header("Location: /");
            exit;
        } else {
            session_start();
            $_SESSION['error_message'] = "Email ou mot de passe incorrect.";
            header("Location: /auth");
            exit;
        }
    }
}

function logout()
{
    session_start();
    if (!empty($_SESSION['user'])) {
        $userId = $_SESSION['user']['id'];
        setRememberToken($userId, null);
    }

    $_SESSION = [];
    session_destroy();

    setcookie('remember_token', '', time() - 3600, '/', '', false, true);
    session_regenerate_id(true);
    header('Location: /auth');
    exit;
}