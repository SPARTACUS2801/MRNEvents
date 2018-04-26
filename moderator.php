<?php
session_start();
if (isset($_SESSION['username'])) {

    header("Location: home.php");
}


require('connect.php');

$query = "SELECT * FROM events_test WHERE public = 0";

$result = mysqli_query($connection, $query) or die(mysqli_error($connection));



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


<main role="main">


    <div class="album py-5 bg-light">
        <div class="container">


            <div class="row" id="meinerow">
                <?php


                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {


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
                    <?php $cache = "<div class='card mb-4 box-shadow' style='width: 100%;height: 100%;'><h2>$row[titel]</h2><img class='card-img-top' src='uploads/$row[bild]' height='200' width='200' alt='Card image cap'><div class='card-body'><p class='card-text'>$string</p><div class='d-flex justify-content-between align-items-center'><div class='btn-group'><a href='moderation.php?id=" . $row["id"] . "' class='btn btn-sm btn-outline-primary'>Anzeigen</a>";

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
