<?php
session_start();
require_once 'connect.php';

$user_id = $_SESSION['userid'];

if (!isset($_GET['aktion']) && !isset($_GET['eventid']) && !empty($_GET['aktion']) && !empty($_GET['eventid'])) {
    header('Location: home.php');
}

$aktion = $_GET['aktion'];
$event_id = $_GET['eventid'];

if ($aktion == 'interessieren') {
    $sql = 'INSERT INTO interessen (eventid, userid) VALUES(?,?);';
}

if ($aktion == 'nichtinteressieren') {
    $sql = 'DELETE FROM interessen WHERE eventid = ? AND userid = ?;';
}

if ($aktion == 'teilnehmen') {
    $sql = 'INSERT INTO teilnahmen (eventid,userid) VALUES(?,?);';
}

if ($aktion == 'nichtteilnehmen') {
    $sql = 'DELETE FROM teilnahmen WHERE eventid = ? AND userid = ?;';
}

$stmt = $connection->prepare($sql);
$stmt->bind_param('ii', $event_id, $user_id);
$success = $stmt->execute();

if ($success) {
    header('Location: detailView.php?id=' . $event_id);
} else {
    header('Location: detailView.php?error=true');
}
