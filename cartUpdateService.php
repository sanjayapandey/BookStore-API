<?php
include("config.php");
						$customer_id = $_POST['customer_id'];
						$ISBN = $_POST['ISBN'];
						$quantity = $_POST['quantity'];
						//query to get all books
						if (isset($_POST['customer_id'])){
							if($quantity>0){
							$query = "UPDATE cart SET quantity = '$quantity' WHERE ISBN = '$ISBN' AND 								customer_id='$customer_id'";
							}else{
							$query = "DELETE FROM cart WHERE ISBN= '$ISBN' AND customer_id='$customer_id'";						
							}
						
						
						if(mysql_query($query)){
							echo 'success';
						}else {
							echo 'error';						
						}
}
						
?>
