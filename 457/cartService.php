<?php
include("config.php");
						$customer_id = $_POST['customer_id'];
						//query to get all books
						if (isset($_POST['customer_id'])){
							$query = 'SELECT b.ISBN,b.title,b.price,c.quantity FROM cart c LEFT JOIN books b ON c.ISBN = b.ISBN WHERE c.quantity>0 AND c.customer_id='.$customer_id;
						
						
						$result = mysql_query($query);
						$finalResult = array();
						while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
							array_push($finalResult,array('ISBN'=>$row['ISBN'], 'title'=>$row['title'],'price'=>$row['price'],'quantity'=>$row['quantity']));

						}
}
echo json_encode(array("result"=>$finalResult));
?>
