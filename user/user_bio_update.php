<?php
require("../connection/dbConnection.php");
include("authentication.php");

if (isset($_POST['updateBio'])) 
{
	$bio = $_POST['bioArea'];

	$query = "UPDATE `users` SET `bio` = '".$bio."' WHERE `username` = '".$_SESSION["username"]."' ";

	$result = mysqli_query($connection,$query);
	if ($result) 
	{
		header("location: user_profile.php");//if result is done return to profile page
	}
	else
	{
		echo "Bio Not Updated!!!";
	}
}
else
{
	echo "Update POST wasnt send through pages!!!";
}
//file used to update user's biography 
?>