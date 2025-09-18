<?php
require('conf/conf.inc.php');

function registerUser($data)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);

        $check = $db->prepare('SELECT id FROM users WHERE email = :email');
        $check->execute(['email' => $data['email']]);
        if ($check->fetch()) {
            return [
                'success' => false,
                'message' => 'Cet email est déjà utilisé.'
            ];
        }

        $req = $db->prepare('INSERT INTO users (first_name, last_name, email, password_hash, birth_date, phone)
              VALUES (:first_name, :last_name, :email, :password_hash, :birth_date, :phone)');

        $req->execute([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'birth_date' => $data['birth_date'],
            'phone' => $data['phone'],
            'password_hash' => password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
        $user = $req->fetch(PDO::FETCH_ASSOC);

        return $user;

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

function loginUser($email, $password)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);
        $req = $db->prepare('SELECT * FROM users WHERE email = :email');

        $req->execute([
            'email' => $email
        ]);
        $user = $req->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        return false;

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

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

function getUserByIdf($id)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);
        $req = $db->prepare('SELECT *, DATE(users.created_at) AS created_date FROM users WHERE id = :id');
        $req->execute([
            'id' => $id
        ]);
        $user = $req->fetch(PDO::FETCH_ASSOC);

        return $user;

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

function updateUserf($id, $data)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);
        $req = $db->prepare("UPDATE users SET
        first_name = :first_name,
        last_name = :last_name,
        username = :username,
        email = :email,
        phone = :phone,
        address = :address,
        city = :city,
        country = :country,
        postal_code = :postal_code,
        birth_date = :birth_date
        WHERE id = :id");
        $data['id'] = $id;
        $req->execute($data);
        $user = $req->fetch(PDO::FETCH_ASSOC);

        return $user;

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}