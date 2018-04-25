<?php
session_start();
require_once 'connect.php';

$user_id = $_SESSION['userid'];

if (!isset($_GET['aktion']) && !isset($_GET['eventid']) && !empty($_GET['aktion']) && !empty($_GET['eventid'])) {
    header('Location: home.php');
}

$aktion = $_GET['aktion'];
$event_id = $_GET['eventid'];
$params = 0;

switch ($aktion) {
    case 'interessieren':
        $sql = 'INSERT INTO interessen (eventid, userid) VALUES(?,?);';
        $params = 2;
        break;
    case 'nichtinteressieren':
        $sql = 'DELETE FROM interessen WHERE eventid = ? AND userid = ?;';
        $params = 2;
        break;
    case 'teilnehmen':
        $sql = 'INSERT INTO teilnahmen (eventid,userid) VALUES(?,?);';
        $params = 2;
        break;
    case 'nichtteilnehmen':
        $sql = 'DELETE FROM teilnahmen WHERE eventid = ? AND userid = ?;';
        $params = 2;
        break;
    case 'freigeben':
        $sql = 'UPDATE events_test SET public = 1 WHERE id = ?';
        $params = 1;
        break;
    case 'nichtfreigeben':
        $sql = 'UPDATE events_test SET public = 2 WHERE id = ?';
        $params = 1;
        break;
    default:
        header('Location: home.php');
}

$stmt = $connection->prepare($sql);
switch ($params) {
    case 1:
        // für Freigabe
        $stmt->bind_param('i', $event_id);
        break;
    case 2:
        // für teilnehmen und interessieren
        $stmt->bind_param('ii', $event_id, $user_id);
        break;
}
$success = $stmt->execute();

if ($success) {
    header('Location: detailView.php?id=' . $event_id);
} else {
    header('Location: detailView.php?error=true');
}
