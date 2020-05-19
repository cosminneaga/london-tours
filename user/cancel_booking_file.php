<?php
/*this file is accessed whenever user wants to cancel a certaing booking by passing the id to this file we are able to update column status for a certaing row*/
require('../connection/dbConnection.php');
if(isset($_GET['ID']))
{
	$ID = $_GET['ID'];
	$query = "UPDATE `booking` SET `status` = 'cancelled' WHERE `bookingsId` = '".$ID."' ";
	$result = mysqli_query($connection,$query);
	if ($result) 
	{
		header("location: bookings.php");
	}
	/*if the connection and query execution has been successfull user wil be redirected back to bookings page*/
	else
		{
			echo "Row not deleted";
		}
}else
{
	header("location: bookings.php");
}
?>