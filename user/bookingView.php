<?php
/*this file is accesed by user when the book now link is clicked*/
require("../connection/dbConnection.php");
include("authentication.php");
if (isset($_GET['id'])) 
{
	/*selecting the package from packages table by id given from previous row*/
	$id = $_GET['id'];
	$query = "SELECT * FROM `packages` WHERE `id` = '".$id."' ";
	$result = mysqli_query($connection,$query);
	$row = mysqli_fetch_assoc($result);

	$name = $row['name'];
	$location = $row['location'];
	$price = $row['price'];
	$details = $row['details'];
	$updateDate = $row['updationDate'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Booking Page</title>
		<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link href="../styles/style.css" rel="stylesheet">
</head>
<body id="scrollNone">
	<p class="about-text-style">Book your Tour here</p>
	<div class="packContainer">
		<div class="packImageContainer">
			<img src="packageImgView.php?id=<?php echo $row['id']; ?>">
		</div>
		<div class="date_bookContainer">
			<!--date picker is required so user is able to book tour by specific date-->
			<form method="post" action="">
				<label>Pick Date<br><input type="date" name="datePicker" required="" min="<?php echo date('Y-m-d'); ?>">
				</label><br><br>
				<input type="submit" name="bookSubmit" value="Book Now"><br>
			</form>
		</div>
		<br>
		<!--print data from database using variables assigned to them rows-->
		<strong>Last Update Date:</strong> <i><?php echo $updateDate ?></i>
		<br>
		<strong>Name:</strong> <?php echo $name ?>
		<br>
		<strong>Location:</strong> <?php echo $location ?>
		<br>
		<strong>Price:</strong> <?php echo $price ?>£
		<br>
		<strong>Details:</strong> <?php echo $details ?>
	</div>
	<?php
		if (isset($_POST['bookSubmit'])) 
		{
			/*when date is choosed gets inserted into the table by using the query below along with any other neccessary information*/
        	$date = $_POST['datePicker'];
			$queryBooking = "INSERT INTO `booking` (`packageId`, `submittedBy`, `travelDate`, `status`)
			VALUES ('".$id."', '".$_SESSION['username']."', '$date', 'confirmed') ";
			$resultBooking = mysqli_query($connection,$queryBooking);
			if ($resultBooking) 
			{
				header("location: packages.php");
			}
			/*if the connection and insertion has been completed user will be redirected back to packages page*/
		}
	?>
</body>
</html>