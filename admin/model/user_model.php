<?php
require('conf/conf.inc.php');

function findByRememberToken($token)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);
        $req = $db->prepare('SELECT * FROM users WHERE remember_token = :token');

        $req->execute(['token' => $token]);
        $tk = $req->fetch(PDO::FETCH_ASSOC);

        return $tk;

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

function setRememberToken($userId, $token)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);
        $req = $db->prepare('UPDATE users SET remember_token = :token WHERE id = :id');

        $req->execute([
            'token' => $token,
            'id' => $userId
        ]);

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}
function getAllUsers()
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);
        $req = $db->prepare('SELECT * FROM users');
        $req->execute();
        $users = $req->fetchAll();

        return $users;

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

function deleteUser($id)
{
    try {
        $id = intval($id);
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);
        $req = $db->prepare('SELECT * FROM users where id = :id');
        $req->execute([
            'id' => $id
        ]);
        $user = $req->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $deleteReq = $db->prepare('DELETE FROM users WHERE id = :id');
            $deleteReq->execute([
                'id' => $id
            ]);
            header('Location: /gestion/user_list');
            echo "Utilisateur supprimé avec succès.";
        } else {
            echo "Utilisateur non trouvé.";
        }

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

function getUserById($id)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);
        $req = $db->prepare('SELECT * FROM users WHERE id = :id');
        $req->execute([
            'id' => $id
        ]);
        $user = $req->fetch(PDO::FETCH_ASSOC);

        return $user;

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

function addUser($lastname, $firstname, $email, $tel, $birthday, $password, $role)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);

        $checkEmail = $db->prepare('SELECT * FROM users WHERE email = :email');
        $checkEmail->execute(['email' => $email]);
        if ($checkEmail->rowCount() > 0) {
            echo "L'email est déjà utilisé. Veuillez en choisir un autre.";
            return;
        }

        $req = $db->prepare('INSERT INTO users (last_name, first_name, email, phone, birth_date, password_hash, role) VALUES (:lastname, :firstname, :email, :phone, :birthday, :password, :role)');
        $req->execute([
            'lastname' => $lastname,
            'firstname' => $firstname,
            'email' => $email,
            'phone' => $tel,
            'birthday' => $birthday,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role
        ]);
        header('Location: /gestion/user_list');
        echo "Utilisateur ajouté avec succès.";
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

function updateUser($id, $last_name, $first_name, $email, $phone, $birth_date, $role)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);
        $req = $db->prepare('UPDATE users SET last_name = :last_name, first_name = :first_name, email = :email, phone = :phone, birth_date = :birth_date, role = :role WHERE id = :id');

        $checkEmail = $db->prepare('SELECT * FROM users WHERE email = :email AND id != :id');
        $checkEmail->execute(['email' => $email, 'id' => $id]);
        if ($checkEmail->rowCount() > 0) {
            echo "L'email est déjà utilisé par un autre utilisateur. Veuillez en choisir un autre.";
            return;
        }

        $req->execute([
            'id' => $id,
            'last_name' => $last_name,
            'first_name' => $first_name,
            'email' => $email,
            'phone' => $phone,
            'birth_date' => $birth_date,
            'role' => $role
        ]);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

function getTotalUsers()
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
        $req = $db->query('SELECT COUNT(*) as total FROM users');
        return $req->fetch(PDO::FETCH_ASSOC)['total'];
    } catch (PDOException $e) {
        die("Erreur total utilisateurs: " . $e->getMessage());
    }
}

function getNewUsersLast7Days()
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
        $req = $db->prepare('SELECT COUNT(*) as total FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)');
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC)['total'];
    } catch (PDOException $e) {
        die("Erreur nouveaux utilisateurs: " . $e->getMessage());
    }
}

function getNewUsersPrevious7Days()
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
        $req = $db->prepare("
            SELECT COUNT(*) as total
            FROM users
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 14 DAY)
              AND created_at < DATE_SUB(NOW(), INTERVAL 7 DAY)
        ");
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC)['total'];
    } catch (PDOException $e) {
        die("Erreur anciens utilisateurs: " . $e->getMessage());
    }
}

function authenticateUser($email, $password)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);
        $req = $db->prepare('SELECT * FROM users WHERE email = :email');
        $req->execute(['email' => $email]);
        $user = $req->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        } else {
            return false;
        }

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}