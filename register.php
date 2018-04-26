<?php

	require('connect.php');


	//Wenn Formular gepostet wird, dann Daten in DB speichern
	if (isset($_POST['vorname']) && isset($_POST['password']) && strlen($_POST['password']) <= 6) {
			$fmsg ="Das Passwort muss aus mindestens 7 Zeichen bestehen";
		}

   else if (isset($_POST['vorname']) && isset($_POST['password'])&& strlen($_POST['password']) > 6 ){
  //    if ($_POST['submit']) {

        $vorname = $_POST['vorname'];

        $nachname = $_POST['nachname'];

				$email = $_POST['email'];

        if (isset($_POST['veranstalter'])) $veranstalter = 1;
        else $veranstalter = 0;
      //  $veranstalter = $_POST['veranstalter'];

        $password = $_POST['password'];
        $hash = hash('sha256',$password);

        $query = "INSERT INTO `users` (email, vorname, nachname, password, veranstalter) VALUES ('$email', '$vorname', '$nachname', '$hash', '$veranstalter')";

        $result = mysqli_query($connection, $query);

        if($result){
            $smsg = "User Created Successfully.";
        }else{
            $fmsg ="User Registration Failed";
        }
    }


    ?>

<html>
<head>
	<title>User Registeration Using PHP & MySQL</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" media="all" href="style.css" />
    <link href="signin.css" rel="stylesheet">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body class="text-center">


      <form class="form-signin" method="POST">

      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>	<!--erfolreiche Meldung-->
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>		<!--Meldung bei Misserfolg-->
        <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Bitte registrieren sie sich</h1>
        <label for="inputVorname" class="sr-only">Vorname</label>
        <input type="text" name="vorname" id="inputVorname" class="form-control" placeholder="Vorname" required autofocus>
        <label for="inputNachname" class="sr-only">Nachname</label>
        <input type="text" name="nachname" id="inputNachname" class="form-control" placeholder="Nachname" required autofocus>
        <label for="inputEmail" class="sr-only">Email Adresse</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="E-Mail Adresse" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Passwort" required>
        <label for="inputVeranstalter" class="sr-only"></label>
        <input type="checkbox" name="veranstalter" value="1" id="inputVeranstalter" placeholder="Sind sie ein Veranstalter?">
        <label for="inputVeranstalter">Sind sie ein Veranstalter?</label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Registrieren</button>


      </form>







</body>



</html>
