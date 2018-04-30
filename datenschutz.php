<?php
/*
 * Impressum in der Fußleiste
*/
session_start();
$title = "Startseite";
//$active_menu = "index";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="all" href="style.css" />
    <link href="carousel.css" rel="stylesheet">
    <link href="offcanvas.css" rel="stylesheet">

  </head>
  <body>

<header>
  <?php  include 'navbar.php'; ?>
</header>

    <div class="row text-center">
        <div class="col-sm-12">
            <h1>Datenschutzerkl&auml;rung</h1>
            <h2>Datenschutz</h2>
            <p>Die Betreiber dieser Seiten nehmen
                den Schutz Ihrer pers&ouml;nlichen Daten sehr ernst. Wir behandeln Ihre personenbezogenen Daten
                vertraulich und entsprechend der gesetzlichen Datenschutzvorschriften sowie dieser
                Datenschutzerkl&auml;rung.</p>
            <p>Die Nutzung unserer Webseite ist in der Regel ohne Angabe
                personenbezogener Daten m&ouml;glich. Soweit auf unseren Seiten personenbezogene Daten
                (beispielsweise Name, Anschrift oder E-Mail-Adressen) erhoben werden, erfolgt dies, soweit
                m&ouml;glich, stets auf freiwilliger Basis. Diese Daten werden ohne Ihre ausdr&uuml;ckliche Zustimmung
                nicht an Dritte weitergegeben.</p>
            <p>Wir weisen darauf hin, dass die Daten&uuml;bertragung im Internet
                (z.B. bei der Kommunikation per E-Mail) Sicherheitsl&uuml;cken aufweisen kann. Ein l&uuml;ckenloser
                Schutz der Daten vor dem Zugriff durch Dritte ist nicht m&ouml;glich.</p>
            <p>&nbsp;</p>
            <h2>
                Cookies</h2>
            <p>Die Internetseiten verwenden teilweise so genannte Cookies. Cookies richten auf Ihrem
                Rechner keinen Schaden an und enthalten keine Viren. Cookies dienen dazu, unser Angebot
                nutzerfreundlicher, effektiver und sicherer zu machen. Cookies sind kleine Textdateien, die auf Ihrem
                Rechner abgelegt werden und die Ihr Browser speichert.</p>
            <p>Die meisten der von uns verwendeten
                Cookies sind so genannte „Session-Cookies“. Sie werden nach Ende Ihres Besuchs automatisch
                gel&ouml;scht. Andere Cookies bleiben auf Ihrem Endger&auml;t gespeichert, bis Sie diese l&ouml;schen.
                Diese Cookies erm&ouml;glichen es uns, Ihren Browser beim n&auml;chsten Besuch
                wiederzuerkennen.</p>
            <p>Sie k&ouml;nnen Ihren Browser so einstellen, dass Sie &uuml;ber das Setzen
                von Cookies informiert werden und Cookies nur im Einzelfall erlauben, die Annahme von Cookies f&uuml;r
                bestimmte F&auml;lle oder generell ausschlie&szlig;en sowie das automatische L&ouml;schen der
                Cookies beim Schlie&szlig;en des Browser aktivieren. Bei der Deaktivierung von Cookies kann die
                Funktionalit&auml;t dieser Website eingeschr&auml;nkt sein.</p>
            <p>&nbsp;</p>
            <h2>Recht auf Auskunft,
                L&ouml;schung, Sperrung</h2>
            <p>Sie haben jederzeit das Recht auf unentgeltliche Auskunft &uuml;ber
                Ihre gespeicherten personenbezogenen Daten, deren Herkunft und Empf&auml;nger und den Zweck der
                Datenverarbeitung sowie ein Recht auf Berichtigung, Sperrung oder L&ouml;schung dieser Daten. Hierzu
                sowie zu weiteren Fragen zum Thema personenbezogene Daten k&ouml;nnen Sie sich jederzeit unter der
                im Impressum angegebenen Adresse an uns wenden.</p>
            <p>&nbsp;</p>
            <p>Quelle: <a
                    href="https://www.e-recht24.de">e-recht24.de</a></p>
        </div>
    </div>

<?php
require_once 'footer.php';
?>
