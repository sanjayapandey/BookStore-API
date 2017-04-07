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
  <title>Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="css/bootstrap.min.css">  
  <link rel="stylesheet" href="css/bookstore.css">
  <link rel="stylesheet" href="css/my-css.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/ionicons.min.css">
  <link rel="stylesheet" href="css/skins/_all-skins.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrapper">
 <!-- Sidebar -->
        
</div>
<div class="container">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-7">
				<div class="login-logo">
					<b>Book </b>Store
				</div>
			</div>
			<div class="col-sm-3">
				<a href="cart.php" style="font-size: 25px;">
		          <span class="glyphicon glyphicon-shopping-cart">Cart</span>
		        </a>
		        <div class="pull-right">
			  	<a href = "profile.php"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp; <strong><?php echo $_SESSION['username']?></strong></a>&nbsp;&nbsp;&nbsp;
			  	 <a href="logout.php" class="btn btn-danger btn-flat"> Logout </a>
			  	</div>
			  </div>
		</div>
		<!-- Small boxes (Stat box) -->
		  <div class="row">
			<div class="col-sm-2">
				<div id="sidebar-wrapper">
					<ul class="sidebar-nav">
						<li><a href="dashboard.php">Dashboard</a>
						</li>
						 <?php if($_SESSION['username'] == 'admin'){?>
						<li><a href="upload.php">Upload</a>
						</li>
						<li><a href="books.php">Books</a>
						</li>
						<li><a href="customers.php">Customer</a>
						</li>
						<?php }?>
					</ul>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="row">
				<?php 
				//save the order and clean the cart.
				$ISBN = $_GET['ISBN'];
				$query1 = "SELECT ISBN, title , price FROM books where ISBN='$ISBN'";
				$result1 = mysql_query($query1);
				while($row = mysql_fetch_array($result1, MYSQL_ASSOC)){
				?>
					<div class="panel panel-default">
						<h3><strong>Title:</strong> <?php echo $row['title']?></h3>
						<div class="panel-body">
							ISBN = <?php echo $row['ISBN']?> </br>
							Price = <?php echo $row['price']?> </br>
						</div>
					</div>
					<?php 
				}
				$query2 = "SELECT c.customer_id, first_name, last_name , quantity FROM customer  as c, purchase as p 
							 WHERE c.customer_id = p.customer_id AND p.ISBN = '$ISBN'";
				$result2 = mysql_query($query2);
				?>
				 <?php if($_SESSION['username'] == 'admin'){?>
				<h3>Purchase  Information</h3>
					<table class="table table-bordered">
					<thead>
						<tr>
							<th>Customer ID</th>
							<th>Full Name</th>
							<th>Total Quantity </th>
						</tr>
					</thead>
					<tbody>
				<?php
				echo strstr("a hello world","a");
				while ($row = mysql_fetch_array($result2, MYSQL_ASSOC)) {
					?>
						<tr>
							<td><?php echo $row['customer_id']?></td>
							<td><?php echo $row['first_name'].' '.$row['last_name']?></td>
							<td><?php echo $row['quantity']?></td>
						</tr>
					<?php
				}?>
					</tbody>
					</table>
				<?php }?>
				</div>
				
			</div>
		  </div>
		  <?php if($_SESSION['username'] == 'admin'){?>
		   <div class="row">
		  	<div class="col-sm-2"></div>
		  	<div class="col-sm-8">
		  	<div class="panel panel-default">
						<div class="panel-body">
							<a href="reset.php" class="btn btn-primary btn-flat pull-left"> Clear System </a>
			  				<form action="#" method="POST">
			  					<input type="hidden" name="fileName" value="book.php">
			  					<input type="submit" class="btn btn-primary btn-flat pull-right" name="source" value="source">
			  				</form>
						</div>
				</div>
				<div class="panel panel-default">
						<h3>Page Source Code</h3>
					<div class="panel-body">
						<?php 
							if(isset($_POST['source']) && $_POST['source'] != ''){
								
								$file = fopen( $_POST['fileName'], "r" ) or	exit( "Unable to open file!" );
								while ( !feof( $file ) )
									highlight_string(fgets( $file ));
								fclose( $file );
							}
						?>
					</div>
				</div>
			</div>
			<div class="col-sm-2"></div>
		  </div>
		  <?php }?>
		 </div>
</body>
</html>