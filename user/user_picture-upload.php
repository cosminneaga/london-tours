<?php
//this page is used to upload picture for user profile page
include("authentication.php");
require("../connection/dbConnection.php");

//condition below checks if user has been inserted any file and then by adding temporary name to image data and properties we are able to manipulate them
if (count($_FILES) > 0) 
{
	if (is_uploaded_file($_FILES['userImg']['tmp_name'])) 
	{
		$imgData = addslashes(file_get_contents($_FILES['userImg']['tmp_name']));
		$imageProperties = getimageSize($_FILES['userImg']['tmp_name']);
		$query = "UPDATE users SET imageType = '".$imageProperties['mime']."', imageData = '".$imgData."'
		WHERE username = '".$_SESSION["username"]."' ";
		$result = mysqli_query($connection, $query) or die ("<b>Error: </b> Problem on Image Insert<br>" .mysqli_error($connection));
		if ($result) 
		{
			header("location: user_profile.php");//if result is done return to profile page
		}
	}
}
//query for showing the picture again after page refresh
$image_query = "SELECT `id` FROM `users` WHERE `username` = '".$_SESSION["username"]."' ";
$image_result = mysqli_query($connection, $image_query);	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Picture Uploading</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="stylesheet" href="../styles/style.css">
</head>
<body>
	<?php include("sidenav.php"); ?>
		<div class="form-centered">
			<div class="form">
				<div class="form-title">
				Upload your profile picture <!--uploading picture form-->
				</div>
				<form action="" method="post" enctype="multipart/form-data">
				<div class="content">
					<div class="label">
						Your profile picture
					</div>
					<div class="inner">
						<div class="profile_image_bloc">
							<?php
							while($row = mysqli_fetch_array($image_result)) {		//displaying picture when user first accessing the page
								?>
								<img id="output" src="imageView.php?image_id=<?php echo $row["id"]; ?>">

								<?php		
							}
							mysqli_close($connection);
							?> 
						</div>
					</div>
					<div class="label">
						Change/Upload profile picture
					</div>
					<div class="inner">
						<input type="file" name="userImg" id="userImg" accept="image/*" onchange="loadFile(event)">
						<script>
							var loadFile = function(event)
									{
										var output = document.getElementById('output');
										output.src = URL.createObjectURL(event.target.files[0]);
									};
						</script>
					</div>
					<div class="button">
						<input type="submit" name="submit" value="Upload Image">
					</div>
				</div>
				</form>
			</div>
		</div>
</body>
</html>