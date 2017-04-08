<!DOCTYPE html>
<html>
<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: login.php");
}
include("config.php");
?>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Add Book</title>
<meta
	content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
	name="viewport">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bookstore.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/ionicons.min.css">
<link rel="stylesheet" href="css/skins/_all-skins.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="login-logo">
			<b>Book</b>Store
		</div>
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-9">
				<div class="box">
					<div class="box-header">
						<?php
						include("config.php");

						//collect data
						$ISBN=$_POST['ISBN'];
						$title=$_POST['title'];
						$price=$_POST['price'];
						if($ISBN != '' && $title != '' && $price != ''){
					  // Compose the query.
					$query  = "INSERT INTO books (ISBN, title ,price) VALUES('$ISBN','$title','$price')";
					
					 if (mysql_query($query)) {?>
						<h1>Book added successfully!!!</h1><br>
						<?php
						} else {
						    echo "Error: " . $query . "<br>" . mysql_error($conn);
						}
						
						// Close the database.
						mysql_close( );
						}else{
						echo "ISBN, title or price can't be empty. Try again! ";
						?>
								
												<?php
						}
						?>
						<a href="upload.php"
							class="btn btn-primary"> Back to Upload page </a><br>
						<br /> <br />
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
