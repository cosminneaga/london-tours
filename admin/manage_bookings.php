<?php
require("../connection/dbConnection.php");
include("admin_auth.php");
$selectBooking = "SELECT * FROM `booking` WHERE `status` = 'confirmed' ORDER BY `bookDate` DESC ";
$result = mysqli_query($connection,$selectBooking);
$selectBookingCancelled = "SELECT * FROM `booking` WHERE `status` = 'cancelled' ORDER BY `bookDate` DESC ";
$resultCancelled = mysqli_query($connection,$selectBookingCancelled);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Manage Bookings</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Always force latest IE rendering engine & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="stylesheet" href="../styles/style.css">
</head>
<body>
	<div class="sidenav">
	    <a href="dashboard.php">Dashboard</a>
	    <a href="users_table.php">Users List</a>
	    <a href="admin_user_insert.php">Add User</a>
	    <a href="complains.php">Complaints</a>
	    <a href="manage_package.php">View\Manage Packages</a>
	    <a href="manage_bookings.php">Manage Bookings</a>
	    <a href="../logout.php">Log Out</a>
 	</div>
	<div class="manage-book-main" >
			<div class="packlistTitle" id="bookingsMade">Bookings Made</div><hr>
			<?php
			while ($row = mysqli_fetch_assoc($result)) 
			{
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
			<div class="big-bloc">
				<div class="container">
					<b>Booking ID:</b> <strong><?php echo $id; ?></strong><br>
					<b>BOOK DATE:</b> <strong><?php echo date('j F Y ¦ H:i:s' , strtotime($bookDate)) ?></strong><br>
					<b>Booked By:</b> <strong><?php echo $submittedBy; ?></strong><br>
					<b>Travel Date:</b> <strong><?php echo date('j F Y' , strtotime($travelDate)) ?></strong>
					<p>Status: <?php echo $status; ?></p><hr>
					<b>Package ID:</b> <strong><?php echo $packId ?></strong><br>
					<b>Details about the package:</b><br>
					<b>Name:</b> <?php echo $name ?><br><br><br>
						<a href="cancel_booking_file.php?ID=<?php echo $id ?>">Cancel Booking</a>
				</div>

			<?php
			}
			?>
			<div class="clearFix"></div>
			<div class="packlistTitle" id="bookingsCancelled">Bookings Cancelled</div><hr>
			<?php
			while ($row = mysqli_fetch_assoc($resultCancelled)) 
			{
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

				<div class="container">
					<b>Booking ID:</b> <strong><?php echo $id; ?></strong><br>
					<b>BOOK DATE:</b> <strong><?php echo date('j F Y ¦ H:i:s' , strtotime($bookDate)) ?></strong><br>
					<b>Cancelled By:</b> <strong><?php echo $submittedBy; ?></strong><br>
					<b>Travel Date:</b> <strong><?php echo date('j F Y' , strtotime($travelDate)) ?></strong>
					<p>Status: <?php echo $status; ?></p><hr>
					<b>Package ID:</b> <strong><?php echo $packId ?></strong><br>
					<b>Details about the package:</b><br>
					<b>Name:</b> <?php echo $name ?><br>
					<b>Creation Date:</b> <?php echo date('j F Y / H:i:s' , strtotime($createDate)) ?><br>
					<b>Updation Date:</b> <?php echo date('j F Y / H:i:s' , strtotime($updateDate)) ?><br><br>
						<a href="delete_booking.php?id=<?php echo $id ?>" onclick="return confirm('Do you really want to DELETE this Booking?')" >Delete</a>
				</div>
			</div>
			<?php
			}
			?>
	</div>
</body>
</html>