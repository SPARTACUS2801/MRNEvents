<?php
$host = 'localhost';
$user = 'root';
$pass = ' ';

$connection = mysqli_connect('localhost', 'root', '');
if (!$connection){
	die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'mrnevents');
if (!$select_db){
	die("Database Selection Failed" . mysqli_error($connection));
}

$upload_image=$_FILES[" img "][ "name" ];

$folder="/xampp/htdocs/images/";

move_uploaded_file($_FILES[" myimage "][" tmp_name "], "$folder".$_FILES[" myimage "][" name "]);

$insert_path="INSERT INTO image_table VALUES('$folder','$upload_image')";

$var=mysql_query($inser_path);
?>
