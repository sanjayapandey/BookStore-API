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
					<h2>My Cart</h2>
				</div>
				<form action="proceed.php" method="POST">
				<table class="table table-bordered">
					<tbody>
						<thead>
						<tr>
							<th>Book Title</th>
							<th>Price per unit</th>
							<th>Number of Items</th>
							<th>Total </th>
						</tr>
						</thead>
						<?php 
							$total = 0;
							$quniqueItem = array_count_values($_SESSION['cart']);
							foreach ($quniqueItem as $key => $value)
							{
								if($value <= 0){
									continue;
								}
								$query = 'SELECT ISBN, title, price FROM books where ISBN ="'.$key.'"';
								$result = mysql_query($query);
								while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
								$total = $total + ($row['price']*$value);
						?>
							<tr>
							<td>
							<a href="book.php?ISBN=<?php echo $row['ISBN']?>"> <?php echo $row['title']?>
							</td>
							<td>
							<?php echo $row['price']?>
							</td>
							<td>
									<input type = "hidden" name="bookISBN[]" value="<?php echo $row['ISBN']?>"/>
									<input type="number" name="bookQuantity[]" value="<?php echo $value?>"/>
							</td>
							<td>
							<?php echo $row['price']*$value ?>
							</td>
							</tr>
						<?php 
							}
							}
						?>
					</tbody>
				</table>
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default">
							<h3>Purchase Summary</h3>
						    <div class="panel-body">
						    	Total Amount: <?php echo $total ?>
						    </div>
						  </div>
						<input type="submit" class="btn btn-primary btn-sm pull-right" name="checkout" value="Click to Purchase Books">
					</div>
				</div>
				</form>
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
			  					<input type="hidden" name="fileName" value="cart.php">
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