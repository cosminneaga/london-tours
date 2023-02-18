<?php
//setting the date-time to britain global time
date_default_timezone_set("GMT");
//establishing the connection with the database
$connection = mysqli_connect(
	getenv('HOST'),
	getenv('USER'),
	getenv('PASSWORD'),
	getenv('DATABASE')
) or die("Connection Failed: " . mysqli_connect_error());

?>