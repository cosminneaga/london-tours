<?php
require("connection/dbConnection.php");

if (isset($_POST['submitSearch'])) 
{
		$name = $_POST['searchName'];
		$query = "SELECT * FROM `packages` ORDER BY `name` RLIKE '".$name."' DESC ";
		$result = mysqli_query($connection, $query);		
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Search Results</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="images/flag.png">
	<link rel="stylesheet" href="styles/style.css">	
</head>
<body style="background-color: #e6e6e6;">
	<?php include("navigation.php"); ?>
	<div class="result">
		Search results for: <span><?php echo $name ?></span>
	</div>
	<?php
		while ($row = mysqli_fetch_assoc($result)) 
		{
			$id = $row['id'];
			$packName = $row['name'];
			$price = $row['price'];
			$details = $row['details'];
	?>
				<div class="card">
					<img src="user/packageImgView.php?id=<?php echo $id ?>">
					<h1><?php echo $packName ?></h1>
					<p class="price"><?php echo $price ?> GBP</p>
					<p><?php echo $details ?></p>
					<p><button onclick="document.location.href = 'user/bookings.php' ">BOOK</button></p>
				</div>
	<?php			
		}
	?>

	<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

	<script>
		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {scrollFunction()};

		function scrollFunction() {
		  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		    document.getElementById("myBtn").style.display = "block";
		  } else {
		    document.getElementById("myBtn").style.display = "none";
		  }
		}

		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
		  document.body.scrollTop = 0;
		  document.documentElement.scrollTop = 0;
		}
	</script>
</body>
</html>