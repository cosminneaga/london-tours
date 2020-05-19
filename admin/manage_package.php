<?php
require("../connection/dbConnection.php");
include("admin_auth.php");
$msg = "";
if (isset($_POST['insertPackDetails'])) 
{
	if (count($_FILES) > 0) 
	{
		if (is_uploaded_file($_FILES['packageImageUpload']['tmp_name'])) 
		{
			$imgData = addslashes(file_get_contents($_FILES['packageImageUpload']['tmp_name']));
			$imgProperties =getimageSize($_FILES['packageImageUpload']['tmp_name']);
			$pName = $_POST["packageName"];
			$location = $_POST["packageLocation"];
			$price = $_POST["packagePrice"];
			$details = $_POST["packageDetails"];
			$insertQuery = "INSERT INTO 
			`packages` (`imageType`, `imageData`, `name`, `location`, `price`, `details`)
			VALUES ('".$imgProperties['mime']."', '".$imgData."', '$pName', '$location', '$price', '$details') ";
			$resultInsertion = mysqli_query($connection,$insertQuery) or die("Problem on insertion query!!!" .mysqli_error($connection));
			if (isset($resultInsertion)) 
			{
				$msg = "The package has been successfully added into the database!";
			}
		}
	}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Manage Package Page</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Always force latest IE rendering engine & Chrome Frame -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" href="../styles/style.css">
</head>
</head>
<body style="overflow-x: hidden;">
	<div class="sidenav">
	    <a href="dashboard.php">Dashboard</a>
	    <a href="users_table.php">Users List</a>
	    <a href="admin_user_insert.php">Add User</a>
	    <a href="complains.php">Complaints</a>
	    <a href="manage_package.php">View\Manage Packages</a>
	    <a href="manage_bookings.php">Manage Bookings</a>
	    <a href="../logout.php">Log Out</a>
 	</div>
	<div class="manage_pack-main">
				<div class="packlistTitle">View Packages List\Delete\Edit\Create</div>
						<p class="php-msg"><?php if($msg != "") echo $msg . "<br><br>" ?></p>
			<div class="packlistMaincontainer">
				<?php
					$query = "SELECT * FROM `packages`";
					$result = mysqli_query($connection,$query);
					while ($row = mysqli_fetch_assoc($result)) 
					{
						$id = $row['id'];
						$name = $row['name'];
						$loc = $row['location'];
						$price = $row['price'];
						$details = $row['details'];
						$createdate = $row['creationDate'];
						$updatedate = $row['updationDate'];
						?>
						<div class="packlistSecondarycontainer">
							<div class="packlistImgcontainer">
								<img src="../user/packageImgView.php?id=<?php echo $id ?>" class="image">
							</div>
							<strong>Name:</strong> <?php echo $name ?><hr>
									<strong>Creation Date: </strong><?php echo $createdate ?><hr>
									<strong>Updation Date: </strong><?php echo $updatedate ?><hr> 
									<strong>Location:</strong> <?php echo $loc ?><hr>
									<strong>Price: </strong><?php echo $price ?> <strong>GBP</strong><hr>
									<strong>Details: </strong><?php echo $details ?><br>
							<div class="overlay">
								<div class="text">
									<a href="delete_package.php?id=<?php echo $id ?>" onclick="return confirm('Do you really want to DELETE this PACKAGE?')" >DELETE</a>
								</div>
							</div>
						</div>
				<?php	}
				?>
			</div>
			<div class="managePackageContainer">
				<div class="managePackageForm" id="editPackageZone">
					<div class="packageFormShape">
						<div class="packageFormTitle">
							Edit a Package Here					
						</div>
						<div class="form-inner">
							<form method="post" action="">
							<label>Select Package Name
							<select name="selectName">
								<?php
									$query_show_packages = "SELECT DISTINCT `name` FROM `packages` ";
									$result_show_packages = mysqli_query($connection,$query_show_packages);
									while ($row = mysqli_fetch_assoc($result_show_packages)) 
									{	
										$name = $row["name"];
										?>
									<option name="option"><?php echo $name ?></option>	
								<?php	}
								?>
							</select>
							</label>
						<input type="submit" name="nameSel" value="Insert name">
						</div>
						</form>
							<?php
								if (isset($_POST['nameSel'])) 
								{		
									$selectedName = $_POST['selectName'];
									$show = "SELECT * FROM `packages` WHERE `name` = '$selectedName' ";
									$result = mysqli_query($connection,$show);
									$row = mysqli_fetch_assoc($result);

									$location = $row['location'];
									$price = $row['price'];
									$details = $row['details'];
									$id = $row['id'];
							?>
						<form method="post" enctype="multipart/form-data">
							<div class="form-inner">
								Package Image
							<div class="image-block">
								<img id="outputEdit" src="../user/packageImgView.php?id=<?php echo $id ?>">
							</div>
							</div>
							<div class="form-inner">
								<label>Package Name:
								<input type="text" name="selName" value="<?php echo $selectedName ?>" readonly><hr>
								Package Location: 
								<span><?php echo $location ?></span></label><hr>
								<label>Package Price<input type="text" name="packagePrice" value="<?php echo $price ?>"><span>GBP</span></label>
							</div>
							<div class="form-inner">
								Package Details<br><textarea name="packageDetails"><?php echo $details ?></textarea>
							</div>
							<div class="button">
								<input type="submit" name="editPackDetails" value="Edit Package">
							</div>
						</form>
						<?php	}	?>
					</div>
				</div>
			</div>
			<?php
				if (isset($_POST['editPackDetails'])) 
				{
					$name = $_POST["selName"];
					$price = $_POST["packagePrice"];
					$details = $_POST["packageDetails"];

					$queryPackEdit = "UPDATE `packages` SET `price` = '$price', `details` = '$details'
					 WHERE `name` = '$name' ";
					$resultPackEdit = mysqli_query($connection,$queryPackEdit);
				}
			?>
			<div class="managePackageContainer">
				<div class="managePackageForm">
					<div class="packageFormShape">
						<form method="post" action="" enctype="multipart/form-data">
							<div class="packageFormTitle">
							Create a Package Here					
							</div>
							<div class="form-inner">
								Package Image
								<div class="image-block">
									<img id="output" src="">
								</div>
								<input type="file" name="packageImageUpload" id="packageImageUpload" accept="image/*" onchange="loadFile(event)" required="">
								<script>
									var loadFile = function(event)
									{
										var output = document.getElementById('output');
										output.src = URL.createObjectURL(event.target.files[0]);
									};
									var loadFileEdit = function(event)
									{
										var outputEdit = document.getElementById('outputEdit');
										outputEdit.src = URL.createObjectURL(event.target.files[0]);
									}
								</script>
							</div>
							<div class="form-inner">
							<label>Package Name<input type="text" name="packageName" required=""></label>
							<label>Package Location<input type="text" name="packageLocation" required=""></label>
							<label>Package Price<input type="text" name="packagePrice" required="">GBP</label>
							</div>
							<div class="form-inner">
							Package Details<br><textarea name="packageDetails" required=""></textarea>
							</div>
							<div class="button">
								<input type="submit" name="insertPackDetails" value="Create Package">
							</div>
						</form>
					</div>
				</div>
			</div>
	</div>
</body>
</html>