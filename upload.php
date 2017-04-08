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
			 	 <div class="upload-book">
				 <form method="post" enctype="multipart/form-data" action="uploadProcess.php">
				 	 <h3>Book Upload :</h3>
					  <label class="btn btn-default btn-file">
					    Browse XML file<input type="file" name="file" id="file" />
					</label>
					 <input type="submit" class="btn btn-primary" name="Upload" value="upload"> 
				 </form>
				 </div>
			</div>
		  </div>
		   <div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
			<h2>Add new Book</h2>
			   <form class="form-horizontal" method="post" action="addBook.php">
			    <div class="form-group">
				    <label for="ISBN">ISBN <strong>*</strong></label>
				    <input type="text" class="form-control" name="ISBN" placeholder="ISBN" required>
			 	 </div>
			 	  <div class="form-group">
				    <label for="title">Title<strong>*</strong></label>
				    <input type="text" class="form-control" name="title" placeholder="Title" required>
			 	 </div>
			 	 <div class="form-group">
				    <label for="price">Price<strong>*</strong></label>
				    <input type="text" class="form-control" name="price" placeholder="Price" required>
			 	 </div>
			 	  
			    <input type="submit" class="btn btn-primary " name="submit" value="Create">
			    <input type="reset" class="btn btn-success " value="Reset"><br/><br />
			 </form> 
			 </div>
		
			 </div>
		  </div>
		 </div>
</body>
</html>
