<?php
require('conf/conf.inc.php');
function countUnreadMessages()
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);
        $req = $db->prepare('SELECT COUNT(*) FROM messages WHERE is_read = 0');
        $req->execute();
        return $req->fetchColumn();
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

function markMessageAsRead($id)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);
        $req = $db->prepare('UPDATE messages SET is_read = 1 WHERE id = :id');
        $req->execute(['id' => $id]);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

function deleteMessage($id)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);
        $req = $db->prepare('DELETE FROM messages WHERE id = :id');
        $req->execute(['id' => $id]);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

function getMessageById($id) {
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);
        $req = $db->prepare('SELECT * FROM messages WHERE id = :id');
        $req->execute(['id' => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

function getAllMessages()
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);

        $req = $db->prepare('
            SELECT 
                messages.id AS message_id,
                messages.message,
                messages.is_read,
                messages.created_at,
                DATE(messages.created_at) AS created_date,
                messages.motif,
                users.first_name,
                users.last_name,
                users.email,
                users.id AS user_id
            FROM messages
            JOIN users ON messages.user_id = users.id
            ORDER BY messages.created_at DESC
        ');

        $req->execute();
        $messages = $req->fetchAll(PDO::FETCH_ASSOC);

        return $messages;

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}