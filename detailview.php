<?php
/**
 * Detaillierte Event-Informationen anzeigen
 */

require_once('connect.php');

session_start();
// Benutzer eingeloggt
if (!isset($_SESSION['username'])) {
    //header('Location: login.php');
}

if (!isset($_GET['id']) && empty($_GET['id'])) {
    header('Location: home.php');
}

$event_id = $_GET['id'];

// Teilnehmerzahl auslesen
$sql = 'SELECT count(*) FROM teilnahmen WHERE eventid = ?;';
$stmt = $connection->prepare($sql);
$stmt->bind_param('i', $event_id);
$stmt->execute();
$result = $stmt->get_result();
$teilnehmerzahl = $result->fetch_array();
$teilnehmerzahl = $teilnehmerzahl[0];

// Interessentenzahl auslesen
$sql = 'SELECT count(*) FROM interessen WHERE eventid = ?;';
$stmt = $connection->prepare($sql);
$stmt->bind_param('i', $event_id);
$stmt->execute();
$result = $stmt->get_result();
$interessentenzahl = $result->fetch_array();
$interessentenzahl = $interessentenzahl[0];

// Ist Benutzer Teilnehmer?
$sql = 'SELECT count(*) FROM teilnahmen WHERE eventid = ? AND userid = ?;';
$stmt = $connection->prepare($sql);
$stmt->bind_param('ii', $event_id, $_SESSION['userid']);
$stmt->execute();
$result = $stmt->get_result();
$teilnahme = $result->fetch_array();
$teilnahme = $teilnahme[0];
if ($teilnahme == 0) {
    $teilnahme = false;
} else {
    $teilnahme = true;
}

// Ist Benutzer interessiert?
$sql = 'SELECT count(*) FROM interessen WHERE eventid = ? AND userid = ?;';
$stmt = $connection->prepare($sql);
$stmt->bind_param('ii', $event_id, $_SESSION['userid']);
$stmt->execute();
$result = $stmt->get_result();
$interesse = $result->fetch_array();
$interesse = $interesse[0];
if ($interesse == 0) {
    $interesse = false;
} else {
    $interesse = true;
}

// Event Details aus Datenbank laden
$sql = 'SELECT * FROM events_test WHERE id = ? LIMIT 1';
$stmt = $connection->prepare($sql);
$stmt->bind_param('s', $event_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo 'Error';
    //header('Location: home.php');
}

$event = $result->fetch_array(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="all" href="style.css"/>
    <link href="carousel.css" rel="stylesheet">
    <link href="offcanvas.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }

        h1 {
            margin-bottom: 0px;
        }
    </style>

</head>
<body>

<header>
    <?php include 'navbar.php'; ?>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img src="uploads/<?php echo $event['bild']; ?>" class="img-fluid"/>
        </div>
        <div class="col-md-8">
            <h1><?php echo $event['titel']; ?></h1>
            <span class="badge badge-secondary"><?php echo $event['kategorie']; ?></span>
            <p><?php echo $event['text']; ?></p>
            <p>Am <b><?php echo date('d.m.Y', strtotime($event['datum'])); ?></b> um
                <b><?php echo date('H:i', strtotime($event['datum'])); ?></b> Uhr</p>
            <p>Teilnehmer: <?php echo $teilnehmerzahl; ?>, Interessenten: <?php echo $interessentenzahl; ?></p>
            <?php
            if ($_SESSION['moderator'] == 1) {
                $btnfreigeben = 'outline-';
                $btnnichtfreigeben = 'outline-';
                if ($event['public'] == 1) {
                    $btnfreigeben = '';
                } else if ($event['public'] == 2) {
                    $btnnichtfreigeben = '';
                }
                ?>
                <div class="btn-group">
                    <a href="interaktion.php?aktion=freigeben&eventid=<?php echo $event_id; ?>"
                       class="btn btn-md btn-<?php echo $btnfreigeben; ?>success">Freigeben</a>
                    <a href="interaktion.php?aktion=nichtfreigeben&eventid=<?php echo $event_id; ?>"
                       class="btn btn-md btn-<?php echo $btnnichtfreigeben; ?>danger">Ablehnen</a>
                </div>
                <?php
            } else {
            ?>
            <div class="btn-group">
                <?php if ($interesse) { ?>
                    <a href="interaktion.php?aktion=nichtinteressieren&eventid=<?php echo $event_id; ?>"
                       class="btn btn-md btn-outline-secondary">Nicht mehr interessiert</a>
                <?php } else { ?>
                    <a href="interaktion.php?aktion=interessieren&eventid=<?php echo $event_id; ?>"
                       class="btn btn-md btn-outline-primary">Interessieren</a>
                <?php } ?>
                <input type="hidden" id="eventid" value="<?php echo $event_id; ?>"/>
                <?php if ($teilnahme) { ?>
                    <a href="interaktion.php?aktion=nichtteilnehmen&eventid=<?php echo $event_id; ?>"
                       class="btn btn-md btn-outline-danger btn-teilnehmen"
                       id="nichtteilnehmen-button">Nicht
                        teilnehmen</a>
                    <?php
                } else {
                    ?>
                    <a href="interaktion.php?aktion=teilnehmen&eventid=<?php echo $event_id; ?>"
                       class="btn btn-md btn-outline-success btn-teilnehmen"
                       id="teilnehmen-button">Teilnehmen</a>
                    <?php
                }
                } // kein Moderator
                ?>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="container">
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>&copy; 2017-2018 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>
