<?php
require("../connection/dbConnection.php");
include("authentication.php");
/*in order for page to be refreshed when user click submit when inserting a message in complain table i had to create an external file
so when user clicks the button the page will be automatically refreshed*/
if (isset($_POST['submit_complain'])) 
{
    /*message getting posted from previous page and assigned a variable to it*/
        $complain = $_POST['complain'];
    /*insert into table the message and username in submitted_by row in table*/
        $query = "INSERT INTO `complain` (`submitted_by`, `message`) VALUES ('".$_SESSION['username']."', '$complain') ";
        $result = mysqli_query($connection,$query) or die (mysqli_error());
        if ($result) 
        {
            header("location: complain.php");
        }
        /*after completion head back to previous page*/
        else
        {
            echo "Query hasn't been successfully operated";
        }
}
else
{
    echo "Something is wrong to the transfer!!!";
}
?>