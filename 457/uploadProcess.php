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
				<h2>Upload book Progress:</h2>
				<?php
				
				/**
				 * This configuration file includes database connection.
				 */
				include("config.php");
				
				/**
				 * function to upload xml data to database using sql query
				 * @param unknown $filePath
				 */
				function uploadXMLToDatabase($filePath){
					echo "uploading xml to database";
					$xml=simplexml_load_file($filePath) or die("Error: Can't parse the provided xml file.");
					foreach($xml->children() as $books) {
						$query  = "INSERT INTO books (ISBN, title ,price) VALUES('$books->ISBN','$books->title','$books->price')";
						if(mysql_query($query)) {
							echo "saved data!";
						} else {
							echo "Error: " . $query . "<br>" . mysql_error($conn);
						}
					}
				}
				if ( ( $_FILES['file']['type'] == "text/xml") && ( $_FILES['file']['size'] < 50000000 ) ) {
					if ( $_FILES['file']['error'] > 0 ) {
								echo "Error: " . $_FILES['file']['error'];
								print_r( $_FILES['file'] );
							}
							else {
								?>
								<br>
								<strong>
								<?php
								echo "Upload: " . $_FILES['file']['name'];
								echo "Type: " . $_FILES['file']['type'];
								echo "Size: " . ceil( $_FILES['file']['size'] / 1024 ) . " Kb";
								?>
								</strong>
								<?php
							}
							if (false&& file_exists("upload/" . $_FILES['file']['name'] ) ) {
								echo $_FILES['file']['name'] . " already exists.";
								print_r( $_FILES['file'] );
							}
							else {
								move_uploaded_file( $_FILES['file']['tmp_name'],
								"upload/" . $_FILES['file']['name'] );
								?>
								<br>
								<h3> Success!!</h3>
								<?php
								echo "Stored in: " . "upload/" . $_FILES['file']['name'];
								chmod( "upload/".$_FILES['file']['name'], 0755 );
								// Store file data into database
								uploadXMLToDatabase("upload/".$_FILES['file']['name']);
								
							}
				}
				else {
					?>
					<br>
					<h3>Error!!</h3>
					<strong>Invalid file</strong>
					</br>
					<?php
					print_r( $_FILES['file'] );
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
						show_source("uploadProcess.php");
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