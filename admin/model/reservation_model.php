<?php
require('conf/conf.inc.php');
function getAllReservations()
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
        $req = $db->prepare('
            SELECT r.*, CONCAT(u.first_name, " ", u.last_name) AS user_name
            FROM reservations r
            JOIN users u ON r.user_id = u.id
            ORDER BY r.event_date DESC
        ');
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

function getReservationById($id)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
        $req = $db->prepare('SELECT * FROM reservations WHERE id = ?');
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

function createReservation($user_id, $event_date, $nb_places = 1)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
        $req = $db->prepare('
            INSERT INTO reservations (user_id, event_date, nb_places)
            VALUES (?, ?, ?)
        ');
        return $req->execute([$user_id, $event_date, $nb_places]);

    } catch (PDOException $e) {
        die("Erreur lors de l'ajout : " . $e->getMessage());
    }
}

function updateReservation($id, $user_id, $event_date, $nb_places)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
        $req = $db->prepare('
            UPDATE reservations
            SET user_id = ?, event_date = ?, nb_places = ?
            WHERE id = ?
        ');
        return $req->execute([$user_id, $event_date, $nb_places, $id]);

    } catch (PDOException $e) {
        die("Erreur lors de la mise à jour : " . $e->getMessage());
    }
}

function deleteReservation($id)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
        $req = $db->prepare('DELETE FROM reservations WHERE id = ?');
        return $req->execute([$id]);

    } catch (PDOException $e) {
        die("Erreur lors de la suppression : " . $e->getMessage());
    }
}

function getReservationByUserAndDate($user_id, $event_date)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
        $req = $db->prepare('
            SELECT * FROM reservations
            WHERE user_id = ? AND event_date = ?
        ');
        $req->execute([$user_id, $event_date]);
        return $req->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

function getRecentReservations($limit = 10)
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
        $req = $db->prepare('
            SELECT r.*, CONCAT(u.first_name, " ", u.last_name) AS user_name
            FROM reservations r
            JOIN users u ON r.user_id = u.id
            ORDER BY r.created_at DESC
            LIMIT ?
        ');
        $req->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Erreur lors de la récupération des réservations récentes : " . $e->getMessage());
    }
}

function countUpcomingReservations()
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);
        $req = $db->prepare('
            SELECT COUNT(*) AS total
            FROM reservations
            WHERE event_date >= CURDATE()
        ');
        $req->execute();
        return (int) $req->fetch(PDO::FETCH_ASSOC)['total'];

    } catch (PDOException $e) {
        die("Erreur lors du comptage des réservations à venir : " . $e->getMessage());
    }
}

function compareWeeklyReservationsGrowth()
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASSWORD);

        // Cette semaine
        $req1 = $db->prepare("
            SELECT COUNT(*) AS total FROM reservations
            WHERE YEARWEEK(event_date, 1) = YEARWEEK(CURDATE(), 1)
        ");
        $req1->execute();
        $thisWeek = (int) $req1->fetch(PDO::FETCH_ASSOC)['total'];

        // Semaine précédente
        $req2 = $db->prepare("
            SELECT COUNT(*) AS total FROM reservations
            WHERE YEARWEEK(event_date, 1) = YEARWEEK(CURDATE() - INTERVAL 1 WEEK, 1)
        ");
        $req2->execute();
        $lastWeek = (int) $req2->fetch(PDO::FETCH_ASSOC)['total'];

        if ($lastWeek === 0) return $thisWeek > 0 ? 100 : 0;

        return round((($thisWeek - $lastWeek) / $lastWeek) * 100);

    } catch (PDOException $e) {
        die("Erreur calcul croissance hebdomadaire : " . $e->getMessage());
    }
}