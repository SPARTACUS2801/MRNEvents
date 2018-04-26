<?php
session_start();
if (isset($_SESSION['username'])) {

	header("Location: home.php");
}

if (isset($_GET['teilnehmen'])) {
	require('connect.php');
	$query = "INSERT INTO teilnahmen (eventid,userid) VALUES (" . $_GET['teilnehmen'] . "," . $_SESSION['userid'] . ")";
	mysqli_query($connection, $query);// or die(mysqli_error($connection));
}
if (isset($_GET['nichtteilnehmen'])) {
	require('connect.php');
	$query = "DELETE FROM teilnahmen WHERE eventid='$_GET[nichtteilnehmen]' AND userid='$_SESSION[userid]'";
	mysqli_query($connection, $query);// or die(mysqli_error($connection));
}
if (isset($_GET['interessieren'])) {
	require('connect.php');
	$query = "INSERT INTO interessen (eventid,userid) VALUES (" . $_GET['interessieren'] . "," . $_SESSION['userid'] . ")";
	mysqli_query($connection, $query);// or die(mysqli_error($connection));
}
if (isset($_GET['nichtinteressieren'])) {
	require('connect.php');
	$query = "DELETE FROM interessen WHERE eventid='$_GET[nichtinteressieren]' AND userid='$_SESSION[userid]'";
	mysqli_query($connection, $query);// or die(mysqli_error($connection));
}

if(isset($_GET['interessieren']) && isset($_GET['teilnehmen'])){
	require('connect.php');
	$query = "DELETE FROM interessen (eventid,userid) VALUES (" . $_GET['interessieren'] . "," . $_SESSION['userid'] . ")";
	mysqli_query($connection, $query);// or die(mysqli_error($connection));
	
}



require('connect.php');

$query = "SELECT * FROM events_test LEFT JOIN teilnahmen ON id = eventid";
if (isset($_COOKIE["query"])) {
	$result = mysqli_query($connection, $_COOKIE["query"]) or die(mysqli_error($connection));
} else {
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
}


$clause = " WHERE ";//Initial clause
//$sql="SELECT * FROM `girlsStaff`  ";//Query stub
//	if(isset($_POST['submit'])){
if (isset($_POST['kategorie'])) {
	foreach ($_POST['kategorie'] as $c) {
		if (!empty($c)) {
			$query .= $clause . "`" . "kategorie" . "` LIKE '%{$c}%'";
			$clause = " OR ";//Change  to OR after 1st WHERE
		}
	}
	$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
	setcookie("query", $query, time() + 999999);

}
	
	//Buttons anpassen
	
	
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


 <h2 id="teilnehmen_h2">Deine Teilnahmen</h2> 
<main role="main">
            <?php
              require('connect.php');
              $query = "SELECT * FROM events_test LEFT JOIN teilnahmen ON id = eventid";
              $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

              if (mysqli_num_rows($result) > 0) { 
              	
              {
              	$row = $result->fetch_array(MYSQLI_ASSOC);
                if (!isset($_GET['kategorie'])||$row["kategorie"]===$_GET['kategorie']) {
				//  if ($row['userid'] === $_SESSION['userid'] ){

                // strip tags to avoid breaking any html
                $string = $row["text"];
                $string = strip_tags($string);
                if (strlen($string) > 100) {

                  // truncate string
                  $stringCut = substr($string, 0, 200);
                  $endPoint = strrpos($stringCut, ' ');

                  //if the string doesn't contain any space then it will cut without word basis.
                  $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                  //$string .= ' ...';
                }

                ?>
                <div id="events">
                <!-- Tabelle mit Events-->
                <table class='table'>
                    <thead class='thead-default'>
                    <tr>
                        <th>Event</th>
                        <th></th>
                        <th>Datum</th>
                        <th>Beschreibung</th>
                        <th>Aktionen</th>
                    </tr>
                    </thead>
                    <tbody>
            <?php
                }
              }
            while ($row = mysqli_fetch_assoc($result)) {
            	$cache;
            	$anzeigen;
            	if ($row['userid'] === $_SESSION['userid'] ){
                ?>
                
                    
                    <tr>
                            <td><img src="uploads/<?php echo $row["bild"]; ?>" height="200" width="200"></td>
                            <td><?php echo $row["titel"];?>
                            <td><?php echo $row["datum"]; ?></td>
                            <td><?php echo $string;?></br>
                            <?php $anzeigen="<a id ='detail_button' href='detailview.php?id=2" . $row["eventid"] . "' class='btn btn-sm btn-outline-primary'>Anzeigen</a>";?>
                            <?php echo $anzeigen?></td>
                            <td><?php if($row['userid']===NULL){
                            $cache = "<a href='?teilnehmen=$row[eventid]' class='btn btn-sm btn-outline-success'>Teilnehmen</a>";
								}else {
									$cache = "<a href='?nichtteilnehmen=$row[eventid]' class='btn btn-sm btn-outline-danger'>Nicht Teilnehmen</a>";}
							echo $cache;?>
									
									
                           
                        </tr>
                       <?php }
            }?>
                    </tbody>
                </table>
            </div>
            <?php 
              }else {
                  echo "Aktuell nimmst du an keinen Events teil";}
             ?>
             <!-- Teilnahme Ende -->
             <!-- Interessen anfang -->
             
            <h2 id="interessiert_h2">Deine Interessen</h2>
            <?php
              require('connect.php');
              $query = "SELECT * FROM events_test LEFT JOIN interessen ON id = eventid";
              $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

              if (mysqli_num_rows($result) > 0) { 
              	
              {
              	$row = $result->fetch_array(MYSQLI_ASSOC);
                if (!isset($_GET['kategorie'])||$row["kategorie"]===$_GET['kategorie']) {


                // strip tags to avoid breaking any html
                $string = $row["text"];
                $string = strip_tags($string);
                if (strlen($string) > 100) {

                  // truncate string
                  $stringCut = substr($string, 0, 200);
                  $endPoint = strrpos($stringCut, ' ');

                  //if the string doesn't contain any space then it will cut without word basis.
                  $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                  $string .= ' ...';
                }

                ?>
                <div id="events">
                <!-- Tabelle mit Events-->
                <table class='table'>
                    <thead class='thead-default'>
                    <tr>
                        <th>Event</th>
                        <th></th>
                        <th>Datum</th>
                        <th>Beschreibung</th>
                        <th>Aktionen</th>
                    </tr>
                    </thead>
                    <tbody>
            <?php
                }
              }
            while ($row = mysqli_fetch_assoc($result)) {
            	$cache;
            	if ($row['userid'] === $_SESSION['userid'] ){
                ?>
                    
                    <tr>
                            <td><img src="uploads/<?php echo $row["bild"]; ?>" height="200" width="200"></td>
                            <td><?php echo $row["titel"];?>
                            <td><?php echo $row["datum"]; ?></td>
                            <td><?php echo $string;?></br>
                            <?php $anzeigen="<a id='detail_button' href='detailview.php?id=2" . $row["eventid"] . "' class='btn btn-sm btn-outline-primary'>Anzeigen</a>";?>
                            <?php echo $anzeigen?></td>
                            <td><?php if($row['userid']===NULL){
                            $cache = "<a href='?interessieren=$row[id]' class='btn btn-sm btn-outline-success'>Interessieren</a>";
								}else {
									$cache = "<a href='?nichtinteressieren=$row[id]' class='btn btn-sm btn-outline-danger'>Nicht Interessieren</a>";}
							echo $cache;?></br>
							                          
                        </tr>
                        <?php
            	}
                    }
              
                    ?>
                    </tbody>
                </table>
            </div>
            <?php 
              }else {
                  echo "Aktuell interessierst du dich nicht für Events";}
             ?>
               
              


						 <div class="collapse" id="collapseExample">
  					 	<div class="card mb-16 box-shadow" style="width: 100%;">
    						Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
  						</div>
							</div>
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

