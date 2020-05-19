<!--this file is used to display the package's details from mysql-->
<?php
require("../connection/dbConnection.php");
$query = "SELECT * FROM `packages`";
$result = mysqli_query($connection,$query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Packages</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Always force latest IE rendering engine & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body class="packages-body" style="background-color: #fff;" id="scrollNone">
	<p class="about-text-style">Packages Available:</p>
		<?php
			while ($row = mysqli_fetch_assoc($result)) //populating hte row with data from table
			{	
				$id = $row["id"];
				$name = $row["name"];
				$location = $row["location"];
				$details = $row["details"];
				$price = $row["price"];
			?>
			<div class="row-container">
				<div class="col-11">
					<img src="packageImgView.php?id=<?php echo $id ?>">
				</div>
				<div class="col-22">
					<h3><b class="aladin-font">Package Name:</b> <i><?php echo $name ?></i></h3>
					<h3><b class="aladin-font">Package Location:</b> <i><?php echo $location ?></i></h3>
					<h3><b class="almendra-font">Package Details:</b></h3> <?php echo $details ?>
				</div>
				<div class="col-33">
					<a href="bookingView.php?id=<?php echo $id ?>">Book Now</a>
				</div>
				<div class="col-44">
					<span class="price-text">
						<p>Price <?php echo $price?> GBP</p>
					</span>
				</div>
			</div>
			<div class="clearFix"></div>
			<?php }	?>
</body>
</html>