<?php
						include("config.php");

						//collect data
						$ISBN=$_POST['ISBN'];
						$customer_id=$_POST['customer_id'];
						$quantity=$_POST['quantity'];
						
						if($ISBN != '' && $customer_id != ''){
					  // Compose the query.
					  $query  = "INSERT INTO cart (ISBN, customer_id,quantity) 							VALUES('$ISBN','$customer_id','$quantity')";
					
					 if (mysql_query($query)) {
							echo "success";
						} else {
						    echo "error";
						}
						
						// Close the database.
						mysql_close( );
						}else{
						echo "ISBN or customer id is empty. Try again! ";
						}
						?>
