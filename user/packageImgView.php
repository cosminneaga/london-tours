<?php
/*in order to retrieve photos data type blob we need to use an external file to convert them back to image 
this file is accessed by taking the id of the image(row) and pass it to this file where the select query take place and converting the image
back to its original state*/
/*connection to database is needed*/
    require ("../connection/dbConnection.php");
if (isset($_GET['id'])) 
{
	/*select the image form mysql where id is given by the page whixh wants to display the image*/
	$query = "SELECT `imageType`, `imageData` FROM `packages` WHERE `id` = '".$_GET['id']."' ";
	$result = mysqli_query($connection,$query) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($connection));
	$row = mysqli_fetch_assoc($result);
	/*header does the conversion based on the image type*/
	header("Content-type: " . $row["imageType"]);
	/*printing out the image*/
	echo $row['imageData'];
}
?>