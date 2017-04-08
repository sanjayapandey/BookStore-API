<?php
include("config.php");
						$user_name = $_POST['user_name'];
						//query to get all books
						if (isset($_POST['user_name'])){
							$query = "SELECT customer_id,first_name,middle_name,last_name FROM customer WHERE user_name = '$user_name'";
						
						
						$result = mysql_query($query);
						$finalResult;
						while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
							$finalResult = array('customerId'=>$row['customer_id'], 'firstName'=>$row['first_name'],'middleName'=>$row['middle_name'],'lastName'=>$row['last_name']);
					}
}
echo json_encode($finalResult);	
?>
