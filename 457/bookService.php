<?php
include("config.php");
						$ISBN = $_POST['ISBN'];
						//query to get all books
						if (isset($_POST['ISBN'])){
							$query = "SELECT title,ISBN,price FROM books WHERE ISBN = '$ISBN'";
						
						
						$result = mysql_query($query);
						$finalResult;
						while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
							$finalResult = array('title'=>$row['title'], 'ISBN'=>$row['ISBN'],'price'=>$row['price']);
					}
}
echo json_encode($finalResult);	
?>
