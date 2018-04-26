<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-primary"> <!-- Hier beginnt die navbar, die sich auf allen Seiten finden lässt-->
  <a class="navbar-brand" href="home.php">MRNEvents</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation"> <!-- Für bspw. mobiles Endgerät-->
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Start <span class="sr-only">(current)</span></a>

      </li>
      <li class="nav-item">
        <a class="nav-link" href="home.php">Event suchen</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="homev2.php">Meine Teilnahmen und Interessen</a>
      </li>
      <?php
      //echo $_SESSION["moderator"];
      if($_SESSION["moderator"]==1){
        echo "<li class='nav-item'>
            <a class='nav-link' href='moderator.php'>Zu Bestätigende Events</a>
        </li>";
      }
      if($_SESSION["veranstalter"]==1){
        echo "<li class='nav-item'>
            <a class='nav-link' href='eventbeantragen.php'>Event Beantragen</a>
        </li>";
      }
       ?>


    </ul>
    <div class="btn-toolbar form-inline my-2 my-lg-0" id="sidebar">
      <div class="list-group">
        <a href="../MRNEvents/logout.php" class="btn btn-outline-danger my-2 my-sm-0">Logout</a>

      </div>
    </div>
  </div>
</nav>
