<?php
require("../connection/dbConnection.php");
include("admin_auth.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Complains Page</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<!-- Always force latest IE rendering engine & Chrome Frame -->
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  	<link rel="stylesheet" href="../styles/style.css">
  	<style>
  		td{border-bottom: 2px solid yellow;border-left: 1px solid red;padding: 20px;}
  		table{padding: 20px;}
  	</style>
</head>
<body>
	 <div class="sidenav">
	    <a href="dashboard.php">Dashboard</a>
	    <a href="users_table.php">Users List</a>
	    <a href="admin_user_insert.php">Add User</a>
	    <a href="complains.php">Complaints</a>
	    <a href="manage_package.php">View\Manage Packages</a>
	    <a href="manage_bookings.php">Manage Bookings</a>
	    <a href="../logout.php">Log Out</a>
 	</div>
	 <div class="dashboard-content">
			<div class="header-section">
				<div class="form">
					<div class="form-title">
						Reply message here
					</div>
					<div class="label">
						Select Username
					</div>
					<div class="inner">
						<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<select name="username" id="username">
								<?php
									$query_show_users = "SELECT DISTINCT `submitted_by` FROM `complain`
									 WHERE `submitted_by` NOT LIKE 'admin%'";
									$result_show_users = mysqli_query($connection,$query_show_users);
									while ($row = mysqli_fetch_assoc($result_show_users)) 
									{
										$name = $row['submitted_by'];
								?>
										
											<option><?php echo $name ?></option>
										
								<?php }
								?>
							</select>
							</div>
							<div class="label">
								Type you message below
							</div>
							<div class="inner">
								<textarea name="message"></textarea>
							</div>
							<div class="button">
								<input type="submit" name="send" value="Send">
							</div>
						</form>
				</div>
			</div>
			<?php
				if ($_SERVER["REQUEST_METHOD"] == "POST") 
				{
					$username = $_POST['username'];
					$message = $_POST['message'];

					$query_send_message = "INSERT INTO `complain` (`submitted_by`, `sent_to`, `message`) VALUES 
					('".$_SESSION['admin-name']."','$username', '$message') ";
					$result_send_message = mysqli_query($connection,$query_send_message);

				}
			?>
			<div class="clearFix"></div>
				<div class="complaints-section">
					<h2>Users Complains</h2>
					<div class="complaints-container">
							<?php
							$count = 1;
							$query_show = "SELECT `update_date`, `submitted_by`, `message` FROM `complain` 
							WHERE `submitted_by` NOT LIKE 'admin%' ORDER BY `update_date` DESC";
							$result_show = mysqli_query($connection,$query_show);
							while ($row = mysqli_fetch_assoc($result_show)) 
							{	
								$date = $row['update_date'];
								$user = $row['submitted_by'];
								$message = $row['message'];
								?>
							<div class="admin-answer">
								<div class="answer-inner-container">
											<div class="count">
											<?php echo $count ?>.
											</div>
											<strong>Time:</strong> <?php echo date('j F Y / H:i:s' , strtotime($date)) ?><br>
											<div class="sender_name">
											<strong>Sender Name:</strong> <?php echo $user ?>
											</div>
											<hr>
											<div class="answer">
												 <?php echo $message ?>
											</div>
								</div>
							</div>
						<?php
						$count ++;}
						?>	
					</div>
					<h2>Answers from others admins</h2>
					<div class="complaints-container">
						<?php
							$count = 1;
							$query = "SELECT `update_date`, `submitted_by`, `message`, `sent_to` FROM 
							`complain` WHERE `submitted_by` LIKE 'admin%' AND `submitted_by` NOT LIKE 
							'".$_SESSION["admin-name"]."' ORDER BY `update_date` DESC ";
							$result = mysqli_query($connection,$query);
							while ($row = mysqli_fetch_assoc($result)) 
							{	
								$date = $row['update_date'];
								$user = $row['submitted_by'];
								$sentTo = $row['sent_to'];
								$message = $row['message'];
								?>
							<div class="admin-answer">
								<div class="answer-inner-container">
											<div class="count">
											<?php echo $count ?>.
											</div>
											<strong>Time:</strong> <?php echo date('j F Y / H:i:s' , strtotime($date)) ?><br>
											<div class="sender_name">
											<strong>Sender Name:</strong> <?php echo $user ?><br>
											<strong>Sent To:</strong> <?php echo $sentTo ?>
											</div>
											<hr>
											<div class="answer">
												 <?php echo $message ?>
											</div>
								</div>
							</div>
						<?php
						$count ++;}
						?>	
					</div>
				</div>
	</div>
</body>
</html>