<?php
require("connection/dbConnection.php");

$generalErrorMessage = $fnameError = $lnameError = $usernameError = $passwordError = $passwordMatch = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$vpassword = $_POST['vpassword'];
	$password = $_POST['password'];

	function clean_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = strip_tags($data);
		return $data;
	}

	if (empty($_POST['fname'])) {
		$fnameError = "First Name is required";
	} elseif (empty($_POST['lname'])) {
		$lnameError = "Last Name is required";
	} elseif (empty($_POST['username'])) {
		$usernameError = "Username is required";
	} elseif (empty($_POST['password']) || empty($_POST['vpassword'])) {
		$passwordError = "Please type in new password";
	} elseif ($vpassword != $password) {
		$passwordMatch = "Your passwords are not matching!";
	} else {
		$fname = clean_input($_POST['fname']);
		$lname = clean_input($_POST['lname']);
		$username = clean_input($_POST['username']);
		$newPassword = clean_input($_POST['password']);

		$queryVerify = "SELECT * FROM `users` WHERE	`fname` = '$fname' AND `lname` = '$lname' AND `username` = '$username'";
		$resultVerify = mysqli_query($connection, $queryVerify) or die(mysqli_error());

		$rows = mysqli_num_rows($resultVerify);
		if ($rows == 1) {
			$queryChangePass = "UPDATE `users` SET `password` = '" . md5($password) . "' WHERE `username` = '$username'";
			$resultChangePass = mysqli_query($connection, $queryChangePass) or die(mysqli_error());

			if ($resultChangePass) {
				header("location: password-confirmation.php");
			} else {
				$generalErrorMessage = "Password hasn't been updated";
			}
		} else {
			$generalErrorMessage = "User details doesn't exist";
		}
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>LT|User Passwording Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="images/flag.png">
	<link href="styles/style.css" rel="stylesheet">
</head>

<body>
	<?php include("navigation.php"); ?>
	<div class="form-centered">
		<div class="form">
			<div class="form-title">
				Hi I'm a form used to change your password
			</div>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<div class="content">
					<div class="label">
						<p>Please bear in mind to fill all fields correctly, otherwise your password cannot be changed.
						</p>
						Fill every field below in order to change your password
					</div>
					<div class="inner">
						<div class="php-msg">
							<?php if ($generalErrorMessage != "")
								echo $generalErrorMessage ?>
							<?php if ($fnameError != "")
								echo $fnameError ?>
							</div>
							<label>First Name: <input type="text" name="fname"
									value="<?php if (isset($_POST['fname']))
								echo $_POST['fname']; ?>"></label>
						<div class="php-msg">
							<?php if ($lnameError != "")
								echo $lnameError ?>
							</div>
							<label>Last Name: <input type="text" name="lname"
									value="<?php if (isset($_POST['lname']))
								echo $_POST['lname']; ?>"></label>
						<div class="php-msg">
							<?php if ($usernameError != "")
								echo $usernameError ?>
							</div>
							<label>Username: <input type="text" name="username"
									value="<?php if (isset($_POST['username']))
								echo $_POST['username']; ?>"></label>
					</div>
					<div class="label">
						Type the new password below
					</div>
					<div class="inner">
						<div class="php-msg">
							<?php if ($passwordError != "")
								echo $passwordError ?>
							<?php if ($passwordMatch != "")
								echo $passwordMatch ?>
							</div>
							<label>New Password: <input type="text" name="password"></label>
							<div class="php-msg">
							<?php if ($passwordError != "")
								echo $passwordError ?>
							<?php if ($passwordMatch != "")
								echo $passwordMatch ?>
							</div>
							<label>Retype Password: <input type="text" name="vpassword"></label>
						</div>
						<div class="button">
							<input type="submit" name="submit" value="Click to change your password">
						</div>
						<div class="label">
							In case you don't remember your details please contact us on <a href="contact.php">Contact
								Us</a> page
						</div>
					</div>
				</form>
			</div>
		</div>

	<?php include("footer.php"); ?>
</body>

</html>