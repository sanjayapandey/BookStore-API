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
						<li><a href="upload.php">Upload</a>
						</li>
						<li><a href="books.php">Books</a>
						</li>
						<li><a href="customers.php">Customer</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="row">
				<?php 
				//reset table data
				$query1 = "SET FOREIGN_KEY_CHECKS = 0;";
				$query2 = "TRUNCATE TABLE books;";
				$query3= "TRUNCATE TABLE purchase;";
				$query4 = "DELETE FROM customer WHERE NOT user_name = 'admin';";
				$query5 = "SET FOREIGN_KEY_CHECKS = 1;";
				$result1 = mysql_query($query1);
				$result2 = mysql_query($query2);
				$result3 = mysql_query($query3);
				$result4 = mysql_query($query4);
				$result5 = mysql_query($query5);
				if($result1 && $result2 && $result3 && $result4){
				?>
					<div class="panel panel-default">
						<h3>System Reset success</h3>
					</div>
				<?php 
				}else{
				?>
				<div class="panel panel-default">
						<h3>Error while deleting data.</h3>
					</div>
				</div>
				<?php 
				}
				?>
			</div>
		  </div>
		  <?php if($_SESSION['username'] == 'admin'){?>
		  <div class="row">
		  	<div class="col-sm-2"></div>
		  	<div class="col-sm-8">
		  	<div class="panel panel-default">
						<div class="panel-body">
							<a href="reset.php" class="btn btn-primary btn-flat pull-left"> Clear System </a>
			  				<a href="#source" class="btn btn-primary btn-flat pull-right" data-toggle="collapse">Show page source code </a>
						</div>
				</div>
				<div id="source" class="panel panel-default collapse">
						<h3>Page Source Code</h3>
					<div class="panel-body">
						<?php
						show_source("reset.php");
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