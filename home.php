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
// echo $query; }


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

</head>
<body>

<header>
    <?php include 'navbar.php'; ?>
</header>

<div class="nav-scroller bg-white box-shadow">
    <nav class="nav nav-underline">

        <form method="POST">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="kategorie[]" id="party" value="party">
                <label class="form-check-label" for="party" id="partylabel">Party</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="kategorie[]" id="kunstkultur" value="kultur">
                <label class="form-check-label" for="kunstkultur" id="kunstkulturlabel">Kunst & Kultur</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="kategorie[]" id="sport" value="sport">
                <label class="form-check-label" for="sport" id="sportlabel">Sport</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="kategorie[]" id="familie" value="familie">
                <label class="form-check-label" for="familie" id="familielabel">Familie</label>
            </div>
            <Button class="btn btn-sm btn-primary btn-block" name
            "submit" type="submit">Suchen</button>
        </form>


        <!--
<a class="nav-link active" href="#">Welche Kategorien interessieren sie? </a>
<a class="nav-link" href="#">
  Friends
  <span class="badge badge-pill bg-light align-text-bottom">27</span>
</a>

<a class="nav-link" href="home.php">Alle Kategorien</a>
<a class="nav-link" href="?kategorie=Familie">Party</a>
<a class="nav-link" href="?kategorie=Kultur">Kultur</a>
<a class="nav-link" href="#">Link</a>
<a class="nav-link" href="#">Link</a>
<a class="nav-link" href="#">Link</a>
<a class="nav-link" href="#">Link</a> -->
    </nav>
</div>


<main role="main">
    <!--
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="first-slide" src="" alt="First slide">
          <div class="container">
            <div class="carousel-caption text-left">
              <h1>Example headline.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Another example headline.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
          <div class="container">
            <div class="carousel-caption text-right">
              <h1>One more for good measure.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div> -->

    <div class="album py-5 bg-light">
        <div class="container">


            <div class="row" id="meinerow">
                <?php
                /*
$parameter = "hihi";
                if (isset($_POST['submit'])||isset($_POST['party']) || isset($_POST['kunstkultur'])||isset($_POST['sport'])||isset($_POST['familie'])){
                    //header(register.php);
                if (isset($_POST['party'])) $parameter .= "party";
                    if (isset($_POST['kunstkultur'])) $parameter .= "kunstkultur";
                    if (isset($_POST['sport'])) $parameter .= "sport";
                    if (isset($_POST['familie'])) $parameter .= "familie";
echo $parameter; echo $row['kategorie'];
}*/

                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {


                    //if (!isset($_GET['kategorie'])||$row["kategorie"]===$_GET['kategorie']) {
                    //	if($parameter===""||strpos($parameter, $row['kategorie']) != false){


                    // strip tags to avoid breaking any html
                    $string = $row["text"];
                    $string = strip_tags($string);
                    if (strlen($string) > 200) {

                        // truncate string
                        $stringCut = substr($string, 0, 200);
                        $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                        $string .= ' ...';
                    }

                    ?>
                    <script>
                        var div = document.createElement('div');
                        div.className = "col-md-4";
                        <?php $cache = "<div class='card mb-4 box-shadow' style='width: 100%;height: 100%;'><h2>$row[titel]</h2><img class='card-img-top' src='uploads/$row[bild]' alt='Card image cap'><div class='card-body'><p class='card-text'>$string</p><div class='d-flex justify-content-between align-items-center'><div class='btn-group'><a href='detailview.php?id=" . $row["id"] . "' class='btn btn-sm btn-outline-primary'>Anzeigen</a>";

                        $cache .= "</div><small class='text-muted'>$row[datum] </small></div></div>";
                        ?>
                        div.innerHTML = "<?php echo $cache ?>";
                        document.getElementById("meinerow").appendChild(div);


                    </script><?php
                    //  }
                }

                ?>
                <!--
               <script>
               var div = document.createElement('div');
               div.innerHTML = "<div class='col-md-4'><div class='card mb-4 box-shadow'>'<img class='card-img-top' data-src='holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail' alt='Card image cap'><div class='card-body'><p class='card-text'>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p><div class='d-flex justify-content-between align-items-center'><div class='btn-group'><button type='button'class='btn btn-sm btn-outline-secondary'>View</button><button type='button' class='btn btn-sm btn-outline-secondary'>Edit</button></div><small class='text-muted'>9 mins</small></div></div></div></div>";
               document.getElementById("meinerow").appendChild(div);
             </script> -->
                <!--
                            <div class="col-md-4">
                              <div class="card mb-4 box-shadow">"
                                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
                                <div class="card-body">
                                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                    </div>
                                    <small class="text-muted">9 mins</small>
                                  </div>
                                </div>
                              </div>
                            </div> -_>


                          </div>
                        </div>
                      </div>


                      <!-- FOOTER -->
                <footer class="container">
                    <p class="float-right"><a href="#">Back to top</a></p>
                    <p>&copy; 2017-2018 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a>
                    </p>
                </footer>
</main>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>


</body>
</html>
