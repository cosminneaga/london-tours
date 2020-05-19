<?php
/*this file is used when user wants to delete any selected rows from table complain including answers from administrators*/
require('../connection/dbConnection.php');
if(isset($_GET['ID']))
{
	$ComplainID = $_GET['ID'];
	$query = "DELETE FROM `complain` WHERE `id` = '".$ComplainID."' ";
	$result = mysqli_query($connection,$query);
	if ($result) 
	{
		header("location: complain.php");
	}
	else
		{
			echo "Row not deleted";
		}
}
else
{
	echo "STOP";
}
?>