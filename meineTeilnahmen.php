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
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" media="all" href="style.css" />
      <link href="carousel.css" rel="stylesheet">
      <link href="offcanvas.css" rel="stylesheet">

    </head>
    <body>

<header>
    <?php  include 'navbar.php'; ?>
</header>

<div class="nav-scroller bg-white box-shadow">
      <nav class="nav nav-underline">
        <a class="nav-link active" href="#">Welche Kategorien interessieren sie? </a>
      <!--  <a class="nav-link" href="#">
          Friends
          <span class="badge badge-pill bg-light align-text-bottom">27</span>
        </a> -->

        <a class="nav-link" href="home.php">Alle Kategorien</a>
        <a class="nav-link" href="?kategorie=Party">Party</a>
        <a class="nav-link" href="?kategorie=Kultur">Kultur</a>
        <a class="nav-link" href="#">Link</a>
        <a class="nav-link" href="#">Link</a>
        <a class="nav-link" href="#">Link</a>
        <a class="nav-link" href="#">Link</a>
      </nav>
    </div>


    <main role="main">

      <div class="album py-5 bg-light">
        <div class="container">


          <div class="row" id="meinerow">
            <?php
              require('connect.php');
              $query =
              "SELECT * FROM events_test a,(SELECT eventid FROM teilnahmen WHERE userid=$_SESSION[userid]) b WHERE a.id = b.eventid";
              $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

              while ($row = $result->fetch_array(MYSQLI_ASSOC))
              {
                if (!isset($_GET['kategorie'])||$row["kategorie"]===$_GET['kategorie']) {


                // strip tags to avoid breaking any html
                $string = $row["text"];
                $string = strip_tags($string);
                if (strlen($string) > 200) {

                  // truncate string
                  $stringCut = substr($string, 0, 200);
                  $endPoint = strrpos($stringCut, ' ');

                  //if the string doesn't contain any space then it will cut without word basis.
                  $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                  $string .= ' ...';
                }

                ?><script>
                var div = document.createElement('div');
                div.className = "col-md-4";
                div.innerHTML = "<div class='card mb-4 box-shadow'><h2><?php echo $row["titel"] ?></h2><img class='card-img-top' src='uploads/<?php echo $row["bild"] ?>' alt='Card image cap'><div class='card-body'><p class='card-text'><?php echo $string ?></p><div class='d-flex justify-content-between align-items-center'><div class='btn-group'><button type='button'class='btn btn-sm btn-outline-primary'>View</button><button type='button' class='btn btn-sm btn-outline-primary'>Teilnehmen</button></div><small class='text-muted'><?php echo $row["datum"] ?></small></div></div></div>";
                document.getElementById("meinerow").appendChild(div);
                </script><?php
              }
              }

             ?>


      <!-- FOOTER -->
			<?php
			require_once 'footer.php';
			?>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>








  </body>
</html>
