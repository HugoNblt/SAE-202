<?php
require('conf/conf.inc.php');
function getComments()
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);

        $req = $db->prepare('SELECT c.*, u.first_name, u.last_name FROM comments c 
            JOIN users u ON c.user_id = u.id 
            ORDER BY c.created_at DESC');

        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}
function publishComment($id, $status)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);

        $req = $db->prepare('UPDATE comments SET is_published = ?, moderated_at = NOW() WHERE id = ?');

        return $req->execute([$status, $id]);

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

function deleteComment($id)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . '', USER, PASSWORD);

        $req = $db->prepare('DELETE FROM comments WHERE id = ?');

        return $req->execute([$id]);

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}