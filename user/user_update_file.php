 <?php
 require('../connection/dbConnection.php');

//this external file is used to update details edited by user
if (isset($_POST['update_user_details'])) 
{

    $UserID = $_GET['ID'];
    $fName = $_POST['fname'];
    $lName = $_POST['lname'];
    $telephone = $_POST['telephone'];
    $houseno = $_POST['houseno'];
    $st = $_POST['street'];
    $town = $_POST['city'];
    $pcode = $_POST['postcode'];
    $mail = $_POST['email'];
   //UPDATE USER ROW WHERE ID IS = TO SESSION USER ID
    $query = "UPDATE `users` SET `fname` = '".$fName."', `lname` = '".$lName."', `tel` = '".$telephone."', `gender` = '".$gen."',
    `houseno` = '".$houseno."', `street` = '".$st."', `city` = '".$town."', `postcode` = '".$pcode."', `email` = '".$mail."' WHERE `id` = '".$UserID."'  ";

    $result = mysqli_query($connection,$query);
    if ($result) 
    {
        header("location: user_profile.php"); //if insertion is successfull head to profile page
    }
}

 ?>