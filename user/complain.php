<?php
require("../connection/dbConnection.php");
include("authentication.php");
$msg = "";
if (isset($_POST['submit_complain'])) 
{
	/*function used to clean the input from user*/
	function clean_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = strip_tags($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        /*getting the form element and assign a variable to it*/
        $complain = clean_input($_POST['complain']);
        /*query to populate the table complain with the message from user*/
        $query = "INSERT INTO `complain` (`submitted_by`, `message`) VALUES 
        ('".$_SESSION['username']."', '$complain') ";
        $result = mysqli_query($connection,$query) or die (mysqli_error());
        if ($result) 
        {
        	$msg = "Your complain has been send to one of our administrators...Thank you!";
        }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>LT|Complains Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="stylesheet" href="../styles/style.css">
</head>
<body>
	<?php include("sidenav.php"); ?>
	<div class="profile_bloc">
		<div class="header-section">
			<h2>Make a Complain</h1> <?php if($msg != "") echo $msg . "<br>" ?>
			<div class="form-centered">
				<form method="post" action="complain_update.php">
					<div class="form">
						<div class="form-title">
							Complains Section
						</div>
						<div class="label">
							Type your complaint below<br>We will answer as soon as posible
						</div>
						<div class="inner">
							<textarea name="complain" placeholder="your complain goes here" required=""></textarea>
						</div>
						<div class="button">
							<input type="submit" name="submit_complain">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--ONLY USER IS ABLE TO DELETE THE MESSAGES ADMINISTRATOR IS JUST READING THEM AND ANSWER BACK TO USER-->
	<div class="profile_bloc">
		<div class="complaints-container">
			<div class="complaints-section">
				<!--this section displays the previous complain made by user-->
				<h2>Your Complains</h2>
					<?php
						$count = 1;
						$query_show = "SELECT * FROM `complain` WHERE `submitted_by` = '".$_SESSION['username']."' ";
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
									<a href="complain_delete.php?ID=<?php echo $row['id']; ?>"><button>DELETE</button></a>
								</div>
							</div>
					<?php
					$count ++;}
					?>
			</div>
		</div>
		<div class="complaints-container">
			<div class="complaints-section">
				<!--this section contains answers from administrators along with any info needed about the message as date and time-->
				<h2>Answers</h1>
					<?php
						$count = 1;
						$query_show_answers = "SELECT `id`,`update_date`,`submitted_by`,`sent_to`,`message` FROM `complain` WHERE 
						`sent_to` = '".$_SESSION['username']."' ORDER BY `update_date` DESC ";
						$result_show_answers = mysqli_query($connection,$query_show_answers);
						while ($row = mysqli_fetch_assoc($result_show_answers)) 
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
										<a href="complain_delete.php?ID=<?php echo $row['id']; ?>"><button>DELETE</button></a>
									</div>
								</div>
					<?php		
					$count++;}
					?>
			</div>
		</div>
	</div>
</body>
</html>