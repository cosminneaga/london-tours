<?php
session_start();
if(!isset($_SESSION["admin-name"])){
header("Location: ../admin_login.php");
exit(); }
?>
