<?php
  /************************************************************
Database Configuration

  *************************************************************/

  $dbUser = "spandey";
  $dbPassword = "und123!!";
  $database = "spandey";
  $host     = "mysqldev.aero.und.edu";
/*
  $dbUser = "root";
  $dbPassword= "root";
  $database = "spandey";
  $host     = "localhost";
*/
  // Connect to the database.
  $conn     = mysql_connect( $host, $dbUser, $dbPassword);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
  // Select a database.
  mysql_select_db( $database, $conn );
?>
