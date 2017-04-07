<?php
						include("config.php");

						//collect data
						$firstName=$_POST['firstName'];
						$middleName=$_POST['middleName'];
						$lastName=$_POST['lastName'];
						$userName=$_POST['userName'];
						$password=$_POST['password'];
						$phoneNumber=$_POST['phoneNumber'];
						if($firstName != '' && $lastName != '' && $userName != '' && $password != ''){
					  // Compose the query.
					  $query  = "INSERT INTO customer (first_name, middle_name,last_name, user_name, password,phone_number) 						VALUES('$firstName','$middleName','$lastName','$userName','$password','$phoneNumber')";
					
					 if (mysql_query($query)) {
							echo "success";
						} else {
						    echo "error";
						}
						
						// Close the database.
						mysql_close( );
						}else{
						echo "Name or username or password can't be empty. Try again! ";
						}
						?>
