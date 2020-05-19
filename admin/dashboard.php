<?php
	require("../connection/dbConnection.php");
	include("admin_auth.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Always force latest IE rendering engine & Chrome Frame -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" href="../styles/style.css">
</head>
<body class="dashboard-background">
	<div class="sidenav">
	    <a href="dashboard.php">Dashboard</a>
	    <a href="users_table.php">Users List</a>
	    <a href="admin_user_insert.php">Add User</a>
	    <a href="complains.php">Complaints</a>
	    <a href="manage_package.php">View\Manage Packages</a>
	    <a href="manage_bookings.php">Manage Bookings</a>
	    <a href="../logout.php">Log Out</a>
 	</div>
	<div class="dashboard-content">
		<div class="dashboard-title">
			Dashboard
		</div>
		<div class="downloadable-sourcecode">
			<a href="../webfile/lt.rar" download="lt">Download the source file here</a>
		</div>
		<div class="dashboard-box">
			<?php
				$users = "SELECT * FROM `users`";
				$result_users = mysqli_query($connection,$users);
				$usersNo = mysqli_num_rows($result_users);
			?>
			<div class="users-box">
				 <a href="users_table.php">Users: <?php echo $usersNo ?></a>
			</div>
			<?php
				$complains = "SELECT * FROM `complain` WHERE `submitted_by` NOT LIKE 'admin%'";
				$result_complains = mysqli_query($connection,$complains);
				$complainsNo = mysqli_num_rows($result_complains);
			?>
			<div class="compliant-box">
				<a href="complains.php">Complains: <?php echo $complainsNo ?></a> 
			</div>
			<?php
				$packages = "SELECT * FROM `packages`";
				$result_packages = mysqli_query($connection,$packages);
				$packagesNo = mysqli_num_rows($result_packages);
			?>
			<div class="package-box">
				<a href="manage_package.php">Packages Available: <?php echo $packagesNo ?></a>
			</div>
			<?php
				$bookings = "SELECT * FROM `booking` WHERE `status` = 'confirmed'";
				$result_bookings = mysqli_query($connection,$bookings);
				$bookingsNo = mysqli_num_rows($result_bookings);
			?>
			<div class="booking-box">
				<a href="manage_bookings.php#bookingsMade">Bookings Made: <?php echo $bookingsNo ?></a>
			</div>
			<?php
				$bookings = "SELECT * FROM `booking` WHERE `status` = 'cancelled'";
				$result_bookings = mysqli_query($connection,$bookings);
				$bookingsNo = mysqli_num_rows($result_bookings);
			?>
			<div class="booking-box">
				<a href="manage_bookings.php#bookingsCancelled">Bookings Cancelled: <?php echo $bookingsNo ?></a>
			</div>
		</div>
	</div>
</body>
</html>