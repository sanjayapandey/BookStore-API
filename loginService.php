<?php

   if($_SERVER["REQUEST_METHOD"] == "POST") {
	  /************************************************************
	Database Configuration

	  *************************************************************/
	/*
	  $dbUser = "spandey";
	  $dbPassword = "und123!!";
	  $database = "spandey";
	  $host     = "mysqldev.aero.und.edu";
	*/
	  $dbUser = "root";
	  $dbPassword= "root";
	  $database = "spandey";
	  $host     = "localhost";
	  // Connect to the database.
	  $conn     = mysql_connect( $host, $dbUser, $dbPassword);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	  // Select a database.
 	 mysql_select_db( $database, $conn );
      // username and password sent from form 
      $username = $_POST['username'];
      $password = $_POST['password']; 
      
      $sql = "SELECT customer_id FROM customer WHERE user_name = '$username' and password = '$password'";
      $result = mysql_query($sql);
      $count = 0;
      while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
      	$count = $count+1;
      }
      $count = mysql_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
      if($count == 1) {
         echo "success";
      }else{
	echo "incorrect";
}
   }else{
	echo "error";
   }
?>
