<?php
require("../connection/dbConnection.php");
if (isset($_GET['id'])) 
{
	$id = $_GET['id'];
	$query = "DELETE FROM `packages` WHERE `id` = '".$id."'";
	$result = mysqli_query($connection,$query);
	if ($result) 
	{
		header("location: manage_package.php");
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