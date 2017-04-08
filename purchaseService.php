<?php
include("config.php");
						$customer_id = $_POST['customer_id'];
						$status = 0;
						//query to get all books
						if (isset($_POST['customer_id'])){
$query = 'SELECT b.ISBN,c.quantity FROM cart c LEFT JOIN books b ON c.ISBN = b.ISBN WHERE c.quantity>0 AND c.customer_id='.$customer_id;
												
						$result = mysql_query($query);
						while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
						$ISBN = $row['ISBN'];
						$quantity = $row['quantity'];
						//find if that book is already exists on database or not
					$query1 = "SELECT ISBN, customer_id, quantity FROM purchase where ISBN='$ISBN' AND customer_id = '$customer_id'";
					$result1 = mysql_query($query1);
					$count = mysql_num_rows($result1);
					if($count>0){
						//update the data
						while ($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)) {
							$count = $row1['quantity'];
						}
						//updated count
						$count = $count + $quantity;
						$query2 = "UPDATE purchase SET quantity = '$count' where ISBN='$ISBN' AND customer_id = '$customer_id'";
					}else{
						$query2 = "INSERT INTO purchase (ISBN, customer_id, quantity) VALUES ('$ISBN', '$customer_id','$quantity')";
					}
					if(mysql_query($query2)) {
						$query3 = "DELETE FROM cart WHERE ISBN= '$ISBN' AND customer_id='$customer_id'";
						if(mysql_query($query3)){					
						}
					} else {
						echo 'error';
					}

}
}
echo "success";						
?>
