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

        $text = $_POST['text'];

        $tmpname = $_FILES['img']['tmp_name'];

        $type = $_FILES['img']['type'];

        $hndFile = fopen($tmpname, "r");

        $data = addslashes(fread($hndFile, filesize($tmpname)));

        $strQuery = "INSERT INTO `images` (imgdata,imgtype) VALUES('$data','$type')";

      //  if (!mysql_query($strQuery)) die(mysql_error());

        $bild = 1;

        $query = "INSERT INTO `events_test` (titel,text,bild) VALUES ('$titel', '$text', '$bild')";

        $result = mysqli_query($connection, $query);

        if($result){
            $smsg = "User Created Successfully.";
        }else{
            $fmsg ="User Registration Failed";
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
            <li class="nav-item active">
              <a class="nav-link" href="../MRNEvents/home.php">Start <span class="sr-only">(current)</span></a>

            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Deutsch</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../jsptest/mathe.jsp">Mathe</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../jsptest/englisch.jsp">Englisch</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Musik</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Biologie</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="uhrzeitausblenden">Uhr ausblenden</a>
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
        <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Beantragen Sie ihr eigenes Event!</h1>
        <label for="inputTitel" class="sr-only">Titeil</label>
        <input type="text" name="titel" id="inputTitel" class="form-control" placeholder="Titel" required autofocus>
        <label for="inputText" class="sr-only">Text</label>
        <input type="text" name="text" id="inputText" class="form-control" placeholder="Text" required autofocus>
        <label class="custom-file">
          <input type="file" name="fileToUpload" id="fileToUpload" class="custom-file-input" >
         <span class="custom-file-control"></span>
       </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Registrieren</button>


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
