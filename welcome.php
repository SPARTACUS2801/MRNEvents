<?php
session_start();
if (isset($_SESSION['username'])){

	header("Location: home.php");} ?>
	<!DOCTYPE html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" media="all" href="style.css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>


      <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark"> <!-- Hier beginnt die navbar, die sich auf allen Seiten finden lässt-->
        <a class="navbar-brand" href="../EasyLearn24/home.php">EasyLearn</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation"> <!-- Für bspw. mobiles Endgerät-->
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="../EasyLearn24/home.php">Start <span class="sr-only">(current)</span></a>

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


              <a class="btn btn-outline-success my-2 my-sm-0" href="register.php">Registrieren</a>
              &nbsp
              <a href="login.php" class="btn btn-outline-success my-2 my-sm-0">Login</a>

          </div>
        </div>
      </nav>


        <br>
        <br>
        <br>



				            <hr>

				            <footer>
				              <p>&copy; MRN Events GmbH</p>
				            </footer>

				          </div><!--/.container-->

  </body>
</html>
