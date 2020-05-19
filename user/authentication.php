<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: ../login.php");
exit(); }
/*authentication is needed when user register direct him/her to login location, this file first starts the session and makes the username superglobal variable
so we can use it in any pages during session*/
?>
