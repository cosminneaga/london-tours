<!--this file is called when user or admin push log out which destroys the session going back make it impossible without starting the sessin again-->
<?php
session_start();
if (session_destroy()) 
{
	/*location where it takes when user/admin logs out*/
	header("Location: index.php");
}
?>