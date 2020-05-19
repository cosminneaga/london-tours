<?php
/*this file is used to extract the image from table users refered by id and convert it back to image afterall*/
    require ("../connection/dbConnection.php");
    if(isset($_GET['image_id'])) 
    {
        $sql = "SELECT `imageType`, `imageData` FROM `users` WHERE `id` = '".$_GET['image_id']."' ";
		$result = mysqli_query($connection, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($connection));
		$row = mysqli_fetch_array($result);
		header("Content-type: " . $row["imageType"]);
        echo $row["imageData"];
	}
	mysqli_close($connection);
?>