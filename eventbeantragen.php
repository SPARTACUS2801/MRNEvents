<?php
//session_start();
//if (isset($_SESSION['username'])){

	//header("Location: home.php");}

  require('connect.php');
  //Wenn Formular gepostet wird, dann Daten in DB speichern
  //  if (isset($_POST['titel']) && isset($_POST['text'])){
  //    if ($_POST['submit']) {
if (array_key_exists('img',$_FILES)) {
        $titel = $_POST['titel'];

        $text = $_POST['beschreibung'];
		
		$kategorie = $_POST['category'];
		
		$datum = $_POST['datumv'];

        $tmpname = $_FILES['img']['tmp_name'];

        $type = $_FILES['img']['type'];

        $hndFile = fopen($tmpname, "r");

        $data = addslashes(fread($hndFile, filesize($tmpname)));

       // $strQuery = "INSERT INTO `images` (imgdata,imgtype) VALUES('$data','$type')";

      //  if (!mysql_query($strQuery)) die(mysql_error());

        //$bild = 1;
		

		

        $query = "INSERT INTO `events_test` (titel,text,bild, datum, kategorie, public) VALUES ('$titel', '$text', '$bild', '$datum', '$kategorie', 0)";

        $result = mysqli_query($connection, $query);

        if($result){
            $smsg = "Event beantragt";
        }else{
            $fmsg ="Event beantragen fehlgeschlagen";
        }
    }
	



?>
	<!DOCTYPE html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" media="all" href="style.css" />
      <link href="carousel.css" rel="stylesheet">

    </head>
    <body>

<header>
      <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-primary"> <!-- Hier beginnt die navbar, die sich auf allen Seiten finden lässt-->
        <a class="navbar-brand" href="../MRNEvents/home.php">MRNEvents</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation"> <!-- Für bspw. mobiles Endgerät-->
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="home.php">Start <span class="sr-only"></span></a>

            </li>
           

          </ul>
          <div class="btn-toolbar form-inline my-2 my-lg-0" id="sidebar">
            <div class="list-group">
              <a href="../MRNEvents/logout.php" class="btn btn-outline-danger my-2 my-sm-0">Logout</a>

            </div>
          </div>
        </div>
      </nav>
</header>

<br> <br>
<main role="main">
  <div class="container">

      <form class="form-signin" method="POST" action="upload.php" enctype="multipart/form-data">

      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>	<!--erfolreiche Meldung-->
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>		<!--Meldung bei Misserfolg-->
        <h1 class="h3 mb-3 font-weight-normal">Beantragen Sie Ihr eigenes Event!</h1>
        <label for="inputTitel" class="sr-only">Titel</label>
        <input type="text" name="titel" id="inputTitel" style="width:500px;" class="form-control" placeholder="Titel" required autofocus><br>
		
		<label for="beschreibung" class="sr-only">Beschreibung</label>
		<textarea name="beschreibung" id="beschreibung" cols="100" rows="5" maxlength="500" required placeholder="Beschreibung"></textarea><br><br>
		
        <select required id="category" name="category">
		<option selected disabled hidden value="">Kategorie auswählen</option>
		<option value="Party">Party</option>
		<option value="Kultur">Kultur</option>
		<option value="Sport">Sport</option>
		</select><br><br>
		
		<label for="datum"> Von</label>
        <input required type="datetime-local" name="datumv" id="datumv"> bis <input type="datetime-local" name="datumb" id="datumb"><br>

		
        <label for="fileToUpload"> Hochzuladenden Bilder für die Veranstaltung auswählen</label>
        <input required type="file" accept="image/*" name="fileToUpload" id="fileToUpload" multiple > <br> <br>
		
		<input type="submit" value="Event beantragen">


      </form>

</div>






<!-- FOOTER -->
<footer class="container">
  <p class="float-right"><a href="#">Back to top</a></p>
  <p>&copy; 2017-2018 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
</footer>
</main>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>








</body>
</html>
