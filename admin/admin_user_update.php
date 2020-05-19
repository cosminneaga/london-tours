 <?php
 require('../connection/dbConnection.php');


if (isset($_POST['update'])) 
{

    $UserID = $_GET['ID'];
    $fName = $_POST['fname'];
    $lName = $_POST['lname'];
    $telephone = $_POST['telephone'];
    $gen = $_POST['gender'];
    $houseno = $_POST['houseno'];
    $st = $_POST['street'];
    $town = $_POST['city'];
    $pcode = $_POST['postcode'];
    $uname = $_POST['username'];
    $mail = $_POST['email'];
   
    $query = "update users set fname = '".$fName."', lname = '".$lName."', tel = '".$telephone."', gender = '".$gen."',
    houseno = '".$houseno."', street = '".$st."', city = '".$town."', postcode = '".$pcode."', username = '".$uname."',
    email = '".$mail."' where  id = '".$UserID."'  ";

    $result = mysqli_query($connection,$query);
    if ($result) {
        header("location: users_table.php");
    }else{
        echo "Record Not Updated!!!";
    }
}else{"location: users_table.php";}

 ?>