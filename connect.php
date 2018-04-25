<?php
//Rvm@i[9)0?~=
$connection = mysqli_connect('localhost', 'root', '');
if (!$connection) {
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'mrnevents');
if (!$select_db) {
    die("Database Selection Failed" . mysqli_error($connection));
}
mysqli_set_charset($connection,"utf8");
?>
