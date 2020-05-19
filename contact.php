<!DOCTYPE html>
<html>
<head>
	<title>LT|Contact Us</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="images/flag.png">
	<link rel="stylesheet" href="styles/style.css">
</head>
<body>
	<!--gallery of photos-->
	<?php include("gallery.php"); ?>
	<!--navigation bar-->
	<?php include("navigation.php"); ?>
	<!--page content-->
		<div class="about-contact">
			<h1>Contact Us</h1>
			<p>Please enter your details below (all fields marked with * are mandatory).</p>
			<p>The below information will only be used for the purpose of this enquiry.</p>
			<p>For further details please read our Privacy Policy</p>	
			<br><br>
			<!--coontact form-->
				<div class="form">
					<div class="form-title">Contact Us</div>
					<div class="label">Write your message below.</div>
					<form>
						<div class="inner">
							<label>Your Name: *<input type="text" name="Name"></label>
							<label>E-mail: *<input type="email" name="email"></label>
							<label>Phone No: <input type="text" name="telephone"></label>
							<label>Your message: *<textarea></textarea></label>				
						</div>
						<div class="button">
							<input type="submit" name="submit">
						</div>
					</form>
				</div>
		</div>
		<!--footer-->
	<?php include ("footer.php"); ?>
</body>
</html>