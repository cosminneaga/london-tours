<?php
require('../connection/dbConnection.php');
include('admin_auth.php');
$id = $_GET['GetID'];
$query = "select * from users where id = '".$id."' ";
$result = mysqli_query($connection,$query);

while ($row = mysqli_fetch_assoc($result)) {
    $ID = $row['id'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $tel = $row['tel'];
    $gender = $row['gender'];
    $house = $row['houseno'];
    $street = $row['street'];
    $city = $row['city'];
    $postcode = $row['postcode'];
    $username = $row['username'];
    $email = $row['email'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
   <h1 style="text-align: center;color: white;">Insert User Details Page</h1>
   <div class="form">
        <div class="form-title">
            Update Records
        </div>    
             <form method="POST" action="admin_user_update.php?ID=<?php echo $ID ?>">           
                        <div class="label">
                            <h3 style="text-align: center;">Database_User_ID<br>No. <p style="color: red; font-size: 20px;"><?php echo $ID ?></p></h3>
                        </div>
                <div class="inner">
                        <label>First Name:<input type="text" name="fname" value="<?php echo $fname ?>"></label>
                        <label>Last Name:<input type="text" name="lname" value="<?php echo $lname ?>"></label>
                        <label>Telephone Number:<input type="text" name="telephone" value="<?php echo $tel ?>"></label>
                        <label>Gender:<input type="text" name="gender" value="<?php echo $gender ?>"></label>
                        <label>House Number:<input type="text" name="houseno" value="<?php echo $house ?>"></label>
                        <label>Street Name:<input type="text" name="street" value="<?php echo $street?>"></label>
                        <label>City Name:<input type="text" name="city" value="<?php echo $city ?>"></label>
                        <label>Postcode:<input type="text" name="postcode" value="<?php echo $postcode ?>"></label>
                        <label>Username:<input type="text" name="username" value="<?php echo $username ?>"></label>
                        <label>E-mail:<input type="text" name="email" value="<?php echo $email ?>"></label>
                        
                </div>
                <div class="button">
                    <input type="submit" name="update" value="Submit">
                </div> 
            </form>
    </div>
</body>
</html>

