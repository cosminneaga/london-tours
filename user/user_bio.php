<?php
require("../connection/dbConnection.php");
include("authentication.php");
$query = "SELECT `bio` FROM `users` WHERE `username` = '".$_SESSION["username"]."' ";
$result = mysqli_query($connection,$query);
$row = mysqli_fetch_assoc($result);
$bio = $row['bio'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>User Bio</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="stylesheet" href="../styles/style.css">
</head>
<body>
	<?php include("sidenav.php"); ?>
	<div class="form-centered">
		<div class="form">
				<div class="form-title">
					Upload your profile picture
				</div>
			<form action="user_bio_update.php" method="post">
				<div class="label">
					Change/Create your Bio
				</div>
				<div class="inner">
					<textarea name="bioArea"><?php echo $bio ?></textarea>
				</div>
				<div class="button">
					<input type="submit" name="updateBio" value="Upload Bio">
				</div>
			</form>
		</div>
	</div>
	<!--page used to update or create a user biography-->
</body>
</html>