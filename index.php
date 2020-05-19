

<!DOCTYPE html>
<html>
<head>
	<!--index.php is the main page which user access which contains navigation bar and some content and all packages available for booking-->
	<title>LondonTour|Welcome</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="images/flag.png">
	<link rel="stylesheet" href="styles/style.css">	
</head>
<body class="index-body-style">
		<!---this is how we call a php file into another by including the nav bar into the page
		include method let the code to be executed even if the external cannot be found-->
	<?php include("gallery.php"); ?>
	<?php include("navigation.php"); ?>
		<!--content of main page-->
	<div class="index-content">
		<div class="index-content-left">
			<h2>Visit London</h1><hr>
				<p>Welcome to Visit London, your official city guide to London, England. Find things to do in London, days out in London, London attractions and sightseeing, what's on, London events, theatre, tours, restaurants and hotels in London. Plan your trip to London with useful traveller information.</p>
			<h2>Planning Your London Trip?</h1><hr>
				<p>Whether you’re looking for things to do in London such as events and attractions, key traveller information to make your London visit run smoothly or are planning where to stay in London, you’ll find everything you need for your London holiday on visitlondon.com.</p>
				<p>Our what’s on London guide has the latest events not to miss while you visit London – there’s always something going on, so don’t miss out on the latest exhibitions, shows and more on your trip to London by checking out our London tickets and offers.</p>
				<p>Make sure to discover London’s diverse neighbourhoods, from tranquil suburbs to central areas full of shopping, entertainment and dining options.</p>
				<p>Discover the best day trips from London or try one of the best London tours.</p>
				<p>If you’re here as a family, you’ll find plenty of things to do in London with kids and find suitable accommodation such as London holiday apartments. Whether you’re looking for the best weekend breaks in London or planning a longer holiday in London, you can be sure you’ll find all the information you need.</p>
		</div>
		<div class="index-content-right">
			<img src="images/london_pencil1.jpg">
		</div>
	</div>
	<!--content of main page ends-->
	<!--displaying packages from database using sql query-->
	<div class="clearFix"></div>

	<?php
	/*in order to create the query connection file needs to be called and establish the connection to database first*/
		require("connection/dbConnection.php");
		$query = "SELECT * FROM `packages`";
		$result = mysqli_query($connection,$query);
			/*while loop populate the rows with data*/
			while ($row = mysqli_fetch_assoc($result)) 
			{	
				/*variables are assigned to the specific rows form mysql*/
				$id = $row["id"];
				$name = $row["name"];
				$location = $row["location"];
				$details = $row["details"];
				$price = $row["price"];
			?>

			<div class="pack-container" id="tours-section">
				<div class="pack-gallery">
					<img src="user/packageImgView.php?id=<?php echo $id ?>">
					<div class="hover">
						<div class="link"><a href="user/user_profile.php#iframe">Book Now</a></div>
					</div>
				</div>
				<div class="desc">
					<?php echo $name ?>
				</div>
			</div>
			<?php }	?>
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
	<!--displaying packages ends-->
	<div class="clearFix"></div>
	<!--include footer in page-->
	<?php include ("footer.php"); ?>
</body>
</html>