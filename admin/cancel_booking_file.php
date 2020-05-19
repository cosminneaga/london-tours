<?php
require('../connection/dbConnection.php');
if(isset($_GET['ID']))
{
	$ID = $_GET['ID'];
	$query = "UPDATE `booking` SET `status` = 'cancelled' WHERE `bookingsId` = '".$ID."' ";
	$result = mysqli_query($connection,$query);
	if ($result) 
	{
		header("location: manage_bookings.php");
	}
	else
		{
			echo "Row not deleted";
		}
}else
{
	header("location: manage_bookings.php");
}
?>