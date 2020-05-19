<?php
//this page is used to edit users details, user will be able to edit their own details
require("../connection/dbConnection.php");
include("authentication.php");
//select data row from table users so user will be able to see what info was inserted before he/she edits them
$query = "SELECT * FROM `users` WHERE `username` = '".$_SESSION["username"]."' ";
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($result))
{
	$ID = $row['id'];//assigning variables to certain rows from table
	$fname = $row['fname'];
	$lname = $row['lname'];
	$tel = $row['tel'];
	$houseno = $row['houseno'];
	$street = $row['street'];
	$city = $row['city'];
	$postcode = $row['postcode'];
	$username = $row['username'];
	$email = $row['email'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>User Details Update</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="stylesheet" href="../styles/style.css">
</head>
<body>	
	<?php include("sidenav.php"); ?>
	<div class="form-centered">
		<div class="form">
	        <div class="form-title">
	            Update Your Details
	        </div>  
	    	<form method="POST" action="user_update_file.php?ID=<?php echo $ID ?>">
	                    <div class="label">
	                        <h3 style="text-align: center;">Username<p style="color: red; font-size: 20px;"><?php echo $username ?></p></h3>
	                    </div>
	            <div class="inner">
	                    <label>First Name:<input type="text" name="fname" value="<?php echo $fname ?>"></label>
	                    <label>Last Name:<input type="text" name="lname" value="<?php echo $lname ?>"></label>
	                    <label>Telephone Number:<input type="text" name="telephone" value="<?php echo $tel ?>"></label>
	                    <label>House Number:<input type="text" name="houseno" value="<?php echo $houseno ?>"></label>
	                    <label>Street Name:<input type="text" name="street" value="<?php echo $street?>"></label>
	                    <label>City Name:<input type="text" name="city" value="<?php echo $city ?>"></label>
	                    <label>Postcode:<input type="text" name="postcode" value="<?php echo $postcode ?>"></label>
	                    <label>E-mail:<input type="text" name="email" value="<?php echo $email ?>"></label>
	                    
	            </div>
		        <div class="button">
		            <input type="submit" name="update_user_details" value="Submit">
		        </div> 
	        </form>
	    </div>
	</div>
</body>
</html>