<?php
require('conf/conf.inc.php');

function saveMessage($userId, $email, $motif, $message)
{

    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);
        $req = $db->prepare("INSERT INTO messages (user_id, email, motif, message)
              VALUES (:user_id, :email, :motif, :message)");

        $req->execute([
            ':user_id' => $userId,
            ':email' => $email,
            ':motif' => $motif,
            ':message' => $message
        ]);
        $user = $req->fetch(PDO::FETCH_ASSOC);

        return $user;

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}