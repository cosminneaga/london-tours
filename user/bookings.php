<?php
require("../connection/dbConnection.php");
include("authentication.php");
/*by including authentication along with mysql connection we can use username variable to extract data from database*/
$selectBooking = "SELECT * FROM `booking` WHERE `submittedBy` = '".$_SESSION['username']."' AND `status` = 'confirmed' ";
$result = mysqli_query($connection,$selectBooking);
?>
<!DOCTYPE html>
<html>
<head>
	<title>User Bookings</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="stylesheet" href="../styles/style.css">
</head>
<body>
	<?php include("sidenav.php"); ?>
		<?php
		/*in the query below i have extract data from booking table to populate the html along with the packages data*/
		while ($row = mysqli_fetch_assoc($result)) 
		{
			/*association between booking table and packages table is taking place in here, i was able to display data from these two table 
			by populating first the row with data from booking table and select the packages by its id given from booking table*/
			$packId = $row['packageId'];
				$selectPackage = "SELECT * FROM `packages` WHERE `id` = '".$packId."' ";
				$resultP = mysqli_query($connection,$selectPackage);
				$rows = mysqli_fetch_assoc($resultP);
				$name = $rows['name'];
				$location = $rows['location'];
				$createDate = $rows['creationDate'];
				$updateDate = $rows['updationDate'];
			$id = $row['bookingsId'];
			$bookDate = $row['bookDate'];
			$submittedBy = $row['submittedBy'];
			$travelDate = $row['travelDate'];
			$status = $row['status'];
		?>
		<div class="booking-big-container">
			<div class="container">
				<!--displaying date info like booking data and travelling date-->
				<b>BOOK DATE:</b> <?php echo date('j F Y / H:i:s' , strtotime($bookDate)) ?><br>
				<b>Travel Date:</b> <?php echo date('j F Y' , strtotime($travelDate)) ?><br>
				<p>Status: <?php echo $status; ?></p><hr>
				<strong>Details about the package:</strong><br><br>
				<div id="imageContainer">
					<img src="packageImgView.php?id=<?php echo $packId ?>">
				</div>
				<b>Name:</b> <?php echo $name ?><br>
				<b>Creation Date:</b> <?php echo date('j F Y' , strtotime($createDate)) ?><br><br><br>
					<a href="cancel_booking_file.php?ID=<?php echo $id ?>">CANCEL BOOKING</a>
			</div>
		</div>
		<?php
		}
		?>
	<div class="clearFix"></div>
</body>
</html>