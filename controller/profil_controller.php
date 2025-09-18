<?php
require_once('model/user_model.php');
function index()
{

    if (!isset($_SESSION['user'])) {
        header('Location: /auth');
        exit;
    }

    $userId = $_SESSION['user']['id'];
    $user = getUserByIdf($userId);
    require('view/autres_pages/header.php');
    require('view/profil_view.php');
    require('view/autres_pages/footer.php');
}

function update()
{
    $userId = $_SESSION['user']['id'];
    $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],
        'city' => $_POST['city'],
        'country' => $_POST['country'],
        'postal_code' => $_POST['postal_code'],
        'birth_date' => $_POST['birth_date'],
    ];

    updateUserf($userId, $data);

    header('Location: /profil');
}
