<?php //Start the Session
session_start();
require('connect.php');
//Sollte das Formular ausgefüllt worden sein
if (isset($_POST['email']) and isset($_POST['password'])) {
    //Daten aus Formular in variablen speichern
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash = hash('sha256', $password);
    //Checken ob es die Daten in der DB gibt
    $query = "SELECT * FROM `users` WHERE email='$email' and password='$hash'";

    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
    $benutzer = $result->fetch_array(MYSQLI_ASSOC);
    //Sollte es sie geben, so wird die Session mit dem Nutzernamen gestartet
    if ($count == 1) {
        $_SESSION['email'] = $email;
        $_SESSION['userid'] = $benutzer["userid"];
        $_SESSION['moderator'] = $benutzer['moderator']; // Rolle testen
    } else {
        //Fehlermeldung sollte es sie nicht geben
        $fmsg = "Invalid Login Credentials.";
    }
}
//Wenn der user nun eingeloggt ist: zu home.php weiterleiten
if (isset($_SESSION['email'])) {

    header('Location: home.php');
} else {

    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../../../favicon.ico">

        <title>Signin MRN Events</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
              integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M"
              crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" media="all" href="style.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Custom styles for this template -->
        <link href="signin.css" rel="stylesheet">
    </head>

    <body class="text-center">
    <form class="form-signin" method="POST" action="login.php">
        <?php if (isset($fmsg)) { ?>
            <div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
        <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required
               autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
    </body>
    </html>
<?php } ?>
