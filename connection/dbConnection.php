<?php
//setting the date-time to britain global time
date_default_timezone_set("GMT");
//establishing the connection with the database
$connection = mysqli_connect("localhost", "root", "", "ltdb");
//if connection is not being made throw an error message
if (!$connection) {
	die("Connection Failed: " .mysqli_connect_error());
}
?>
