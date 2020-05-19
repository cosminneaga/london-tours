<?php
require("../connection/dbConnection.php");
if (isset($_GET['id'])) 
{
	$id = $_GET['id'];
	$query = "DELETE FROM `booking` WHERE `bookingsId` = '".$id."'";
	$result = mysqli_query($connection,$query);
	if ($result) 
	{
		header("location: manage_bookings.php");
	}
	else
	{
		echo "Package not deleted";
	}
}
else
{
	echo "STOP!";
}

?>