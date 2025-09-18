<?php
require_once __DIR__ . '/../model/comment_model.php';
require_once __DIR__ . '/../model/message_model.php';
require_once __DIR__ . '/../model/reservation_model.php';
require_once __DIR__ . '/../model/user_model.php';

function set_flash(string $type, string $text): void {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    $_SESSION['flash_message'] = ['type' => $type, 'text' => $text];
}

function index()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /gestion/auth');
        exit;
    }
    $totalUsers = getTotalUsers();
    $newUsers = getNewUsersLast7Days();
    $previousWeek = getNewUsersPrevious7Days();
    $userGrowth = $previousWeek > 0 ? round((($newUsers - $previousWeek) / $previousWeek) * 100) : 0;
    $unreadMessages = countUnreadMessages();
    $recentReservations = getRecentReservations();
    $upcomingCount = countUpcomingReservations();
    $growth = compareWeeklyReservationsGrowth();

    require __DIR__ . '/../model/getCommitGithub.php';
    $commits = getRecentCommits('AlexisLaillier', 'sae202', 4, GITHUB_TOKEN);

    require __DIR__ . '/../view/autres_pages/header.php';
    require __DIR__ . '/../view/gestion_view.php';
    require __DIR__ . '/../view/autres_pages/footer.php';
}

function auth()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            set_flash('error', "Veuillez remplir tous les champs.");
            header("Location: /auth");
            exit;
        }

        $user = authenticateUser($email, $password);

        if ($user && $user['role'] === 'admin') {
            session_regenerate_id(true);
            $_SESSION['user'] = $user;

            if (!empty($_POST['remember-me'])) {
                $token = bin2hex(random_bytes(32));
                $expires = time() + (30 * 24 * 60 * 60);
                setRememberToken($user['id'], $token);

                setcookie('remember_token', $token, [
                    'expires' => $expires,
                    'path' => '/',
                    'secure' => isset($_SERVER['HTTPS']),
                    'httponly' => true,
                    'samesite' => 'Lax'
                ]);
            }

            set_flash('success', "Connexion réussie.");
            header('Location: /gestion');
            exit;
        } else {
            set_flash('error', "Identifiants incorrects ou accès refusé.");
            header("Location: /auth");
            exit;
        }
    } else {
        require __DIR__ . '/../view/autres_pages/header.php';
        require __DIR__ . '/../view/auth_view.php';
        require __DIR__ . '/../view/autres_pages/footer.php';
    }
}

function logout()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!empty($_SESSION['user'])) {
        $userId = $_SESSION['user']['id'];
        setRememberToken($userId, null);
    }
    $_SESSION = [];
    session_destroy();
    setcookie('remember_token', '', time() - 3600, '/', '', false, true);
    session_regenerate_id(true);
    header('Location: /');
    exit;
}

function user_list()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /gestion');
        exit;
    }
    $scripts = ['modals_user.js'];
    $unreadMessages = countUnreadMessages();
    $users = getAllUsers();
    require __DIR__ . '/../view/autres_pages/header.php';
    require __DIR__ . '/../view/user_list_view.php';
    require __DIR__ . '/../view/autres_pages/footer.php';
}

function delete_user()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        deleteUser($_GET['id']);
        set_flash('success', "Utilisateur supprimé.");
    } else {
        set_flash('error', "ID d'utilisateur invalide.");
    }
    header('Location: /gestion/user_list');
    exit;
}

function edit_user()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? '';
        $last_name = $_POST['last_name'] ?? '';
        $first_name = $_POST['first_name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $birth_date = $_POST['birth_date'] ?? '';
        $role = $_POST['role'] ?? 'user';

        if (empty($id) || empty($last_name) || empty($first_name) || empty($email) || empty($role)) {
            set_flash('error', "Tous les champs sont requis.");
            header('Location: /gestion/user_list');
            exit;
        }

        updateUser($id, $last_name, $first_name, $email, $phone, $birth_date, $role);
        set_flash('success', "Utilisateur mis à jour.");
        header('Location: /gestion/user_list');
        exit;
    } else {
        set_flash('error', "Une erreur est survenue.");
        header('Location: /gestion/user_list');
        exit;
    }
}

function add_user()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $lastname = $_POST['lastname'] ?? '';
        $firstname = $_POST['firstname'] ?? '';
        $email = $_POST['email'] ?? '';
        $tel = $_POST['tel'] ?? '';
        $birthday = $_POST['birthday'] ?? '';
        $password = $_POST['password'] ?? '';
        $password_confirmation = $_POST['password_confirmation'] ?? '';
        $role = $_POST['role'] ?? 'user';

        if ($password !== $password_confirmation) {
            set_flash('error', "Les mots de passe ne correspondent pas.");
            header('Location: /gestion/user_list');
            exit;
        }

        addUser($lastname, $firstname, $email, $tel, $birthday, $password, $role);
        set_flash('success', "Utilisateur ajouté avec succès !");
        header('Location: /gestion/user_list');
        exit;
    } else {
        set_flash('error', "Erreur lors de l'ajout de l'utilisateur.");
        header('Location: /gestion/user_list');
        exit;
    }
}

function message_list()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /gestion');
        exit;
    }
    $scripts = ['modals_message.js'];
    $unreadMessages = countUnreadMessages();
    $messages = getAllMessages();
    require __DIR__ . '/../view/autres_pages/header.php';
    require __DIR__ . '/../view/message_list_view.php';
    require __DIR__ . '/../view/autres_pages/footer.php';
}

function delete_message()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /gestion');
        exit;
    }

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        deleteMessage($_GET['id']);
        set_flash('success', "Message supprimé.");
    } else {
        set_flash('error', "ID de message invalide.");
    }
    header('Location: /gestion/message_list');
    exit;
}

function update_message()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /gestion');
        exit;
    }

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $message = getMessageById($_GET['id']);
        if ($message) {
            markMessageAsRead($_GET['id']);
            set_flash('success', "Message mis à jour.");
        } else {
            set_flash('error', "Message introuvable.");
        }
    } else {
        set_flash('error', "ID de message invalide.");
    }
    header('Location: /gestion/message_list');
    exit;
}

function comment_list()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /gestion');
        exit;
    }
    $unreadMessages = countUnreadMessages();
    $comments = getComments();
    $scripts = ['modals_comment.js'];
    require __DIR__ . '/../view/autres_pages/header.php';
    require __DIR__ . '/../view/comments_view.php';
    require __DIR__ . '/../view/autres_pages/footer.php';
}

function publish_comment()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /gestion');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $commentId = $_POST['comment_id'];
        $status = $_POST['new_status'];

        if (!$commentId || ($status !== '1' && $status !== '0')) {
            set_flash('error', "Données invalides.");
        } else {
            publishComment($commentId, $status);
            set_flash('success', "Commentaire mis à jour.");
        }
        header("Location: /gestion/comment_list");
        exit;
    }
}

function delete_comment()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /gestion');
        exit;
    }

    if (!isset($_GET['id'])) {
        set_flash('error', "ID manquant.");
    } else {
        deleteComment($_GET['id']);
        set_flash('success', "Commentaire supprimé.");
    }
    header("Location: /gestion/comment_list");
    exit;
}

function reservation_list()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /gestion');
        exit;
    }
    $scripts = ['modals_reservation.js'];
    $unreadMessages = countUnreadMessages();
    $users = getAllUsers();
    $reservations = getAllReservations();
    require __DIR__ . '/../view/autres_pages/header.php';
    require __DIR__ . '/../view/reservation_list_view.php';
    require __DIR__ . '/../view/autres_pages/footer.php';
}

function delete_reservation()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /gestion');
        exit;
    }

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        deleteReservation($_GET['id']);
        set_flash('success', "Réservation supprimée.");
    } else {
        set_flash('error', "ID de réservation invalide.");
    }
    header('Location: /gestion/reservation_list');
    exit;
}

function edit_reservation()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /gestion');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? '';
        $user_id = $_POST['user_id'] ?? '';
        $event_date = $_POST['event_date'] ?? '';
        $nb_places = $_POST['nb_places'] ?? '';

        if (empty($id) || empty($user_id) || empty($event_date) || empty($nb_places)) {
            set_flash('error', "Tous les champs sont requis.");
        } else {
            updateReservation($id, $user_id, $event_date, $nb_places);
            set_flash('success', "Réservation mise à jour.");
        }
        header('Location: /gestion/reservation_list');
        exit;
    }
}

function add_reservation()
{
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /gestion');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_POST['user_id'] ?? '';
        $event_date = $_POST['event_date'] ?? '';
        $nb_places = $_POST['nb_places'] ?? '';

        if (empty($user_id) || empty($event_date) || empty($nb_places)) {
            set_flash('error', "Tous les champs sont requis.");
        } else {
            $existingReservation = getReservationByUserAndDate($user_id, $event_date);
            if ($existingReservation) {
                set_flash('warning', "Une réservation pour cet utilisateur à cette date existe déjà.");
            } else {
                createReservation($user_id, $event_date, $nb_places);
                set_flash('success', "Réservation ajoutée avec succès !");
            }
        }
        header('Location: /gestion/reservation_list');
        exit;
    }
}