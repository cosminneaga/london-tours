<?php
require("../connection/dbConnection.php");
include("authentication.php");
//select all from users where username = to session username
$query = "SELECT * FROM users WHERE username = '".$_SESSION["username"]."' ";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
    $ID = $row['id'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $tel = $row['tel'];
    $gender = $row['gender'];
    $age = $row['age'];
    $house = $row['houseno'];
    $street = $row['street'];
    $city = $row['city'];
    $postcode = $row['postcode'];
    $username = $row['username'];
    $email = $row['email'];
    $bio = $row['bio'];
  
?>
<!DOCTYPE html>
<html>
<head>		<!--USER PROFILE PAGE-->
	<title>User Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="stylesheet" href="../styles/style.css">
	<link rel="icon" type="image/jpg" href="imageView.php?image_id=<?php echo $row["id"]; ?>">
</head>
<body>
	<?php include("sidenav.php"); ?>
	<div class="profile_bloc">
		<div class="header-section">
			<h1>Welcome User : <b style="color:  #00e600;"><?php echo $_SESSION["username"]; ?></b></h1>
		</div>
			<div class="col-1">
				<div class="profile_image_bloc">
					<img src="imageView.php?image_id=<?php echo $row["id"]; ?>">
				</div>
				<p class="user-name-style"><?php echo $fname?> <?php echo $lname?></p>
			</div>
			<div class="col-2">
				<p class="about-text-style">Personal Information: </p>
				<p class="user-data-style">
					<p><strong>Name:</strong> <?php echo $fname ?> <?php echo $lname ?></p>
					<p><strong>Age:</strong><i> <?php echo $age ?></i></p>
					<p><strong>Gender:</strong> <i><?php echo $gender ?></i></p>
					<p><strong>Telephone:</strong> <i><?php echo $tel ?></i></p>
					<p><strong>E-mail:</strong> <i><?php echo $email ?></i></p>
					<p><strong>Address:</strong> <i><?php echo $house ?> <?php echo $street ?> <?php echo $city ?> <?php echo $postcode ?></i></p>
				</p>
			</div>
			<div class="col-3">
				<p class="about-text-style">
				Bio:
				</p>
				<p class="user-data-style"><?php echo $bio ?></p>
			</div>
	</div>
	<div class="clearFix"></div>
	<div class="below_profile_bloc">
		<div class="bloc-2">
			<iframe src="packages.php" id="iframe"></iframe>
		</div>
	</div>
</body>
</html>