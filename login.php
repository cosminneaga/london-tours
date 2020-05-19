<?php
/*session started whe user logs in*/
session_start();
/*database connection required*/
	require('connection/dbConnection.php');
/*setting the error dislpay messages to empty values waiting to be populated when errors occur*/
$generalErrorMsg = $usernameError = $userPasswordError = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		//function to clean user inputs
		function clean_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = strip_tags($data);
            return $data;
        }
        //posting the html elemnts and assign variable to them
        if (empty($_POST['username'])) 
        {
        	$usernameError = "Please provide the Username";
        }
        elseif (empty($_POST['password'])) 
        {
        	$userPasswordError = "Please provide the Password";
        }
        else
        {
        	$username = clean_input($_POST["username"]);
        	$password = clean_input($_POST["password"]);

        	$query = "SELECT * FROM `users` WHERE username='$username' and password='".md5($password)."' ";
				$result = mysqli_query($connection,$query) or die(mysqli_error());  

				$rows = mysqli_num_rows($result);
				if ($rows==1) //if row exists in the table proceed further
				{
					$_SESSION['username'] = $username;	//capturing the username
					header("Location: user/user_profile.php"); //redirect user to profile page
				}
				else
				{
					$generalErrorMsg = "Username or Password are wrong.<br>Try Again.";//error message display if user details not exists in table
				} 
        }
        	
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="images/flag.png">
	<link href="styles/style.css" rel="stylesheet">
	<title>LT|User Portal</title>
</head>
<!--this is the user login portal-->
<body class="login-background">
	<?php include("navigation.php"); ?>
	<h1 class="title">Welcome to User Portal</h1>
	<div class="form-style">
		<h1>Log in Now!<span>Log in and benefit from huge discounts!</span></h1>
		<form name="theForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> <!--$_server["php_self"] method is used to sanitize the form and protect it from external hacking-->
		    <div class="section">Username & Password</div>
			    <div class="inner-wrap">
			    	<div class="php-msg">
			    	<?php if($generalErrorMsg != "") echo $generalErrorMsg ?>
			    	<?php if ($usernameError != "") echo $usernameError ?>
			    	</div>
			        <label>Username <input type="text" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" ></label>
			        <div class="php-msg">
			        	<?php if($userPasswordError != "") echo $userPasswordError ?>
			        </div>
			        <label>Password <input type="password" name="password"></label>
			    </div>			
			     <input type="submit" name="submit" value="LogIn">
		</form>
				<div class="inner-wrap" style="border: 2px solid black;">
			    	Forgot your password? <button style="float: right;" onclick="document.location.href='change-pass.php' ">Change Password</button>
			    </div>
	</div>
	<?php include("footer.php"); ?>
</body>
</html>