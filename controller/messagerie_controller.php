<?php
require('model/messagerie_model.php');
function index()
{
    require('view/autres_pages/header.php');
    require('view/messagerie/messagerie_view.php');
    require('view/autres_pages/footer.php');
}

function validateForm()
{
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_SESSION['user'])) {
            echo "Vous devez être connecté pour envoyer un message.";
            return;
        }

        $userId = $_SESSION['user']['id'];
        $email = $_POST['email'];
        $motif = $_POST['motif'];
        $message = $_POST['message'];

        if (saveMessage($userId, $email, $motif, $message)) {
            $_SESSION['message_success'] = "Message envoyé avec succès !";
            header("Location: /messagerie");
        } else {
            $_SESSION['message_error'] = "Erreur lors de l'envoi du message.";
            header("Location: /messagerie");
        }
    }
}
?>