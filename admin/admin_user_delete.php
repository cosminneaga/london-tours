<?php
require('../connection/dbConnection.php');
if(isset($_GET['DeleteUserID']))
{
	$UserID = $_GET['DeleteUserID'];
	$query = "delete from users where id = '".$UserID."' ";
	$result = mysqli_query($connection,$query);
	if ($result)
	{
		header("location: users_table.php");
	}
	else
	{
		echo "Row not deleted";
	}
}
else
{
	header("location: users_table.php");
}
?>
