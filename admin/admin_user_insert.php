<?php
require('../connection/dbConnection.php');
include('admin_auth.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" href="../styles/style.css">
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
    <?php

    if (isset($_REQUEST['admin-user-insert'])) {

        //personal information
        $fname = stripslashes($_REQUEST['fname']);
        $fname = mysqli_real_escape_string($connection, $fname);
        $lname = stripslashes($_REQUEST['lname']);
        $lname = mysqli_real_escape_string($connection, $lname);
        $tel = stripslashes($_REQUEST['tel']);
        $tel = mysqli_real_escape_string($connection, $tel);
        $age = stripslashes($_REQUEST['age']);
        $age = mysqli_real_escape_string($connection, $age);
        $gender = stripslashes($_REQUEST['gender']);
        $gender = mysqli_real_escape_string($connection, $gender);
        //home address
        $houseno = stripslashes($_REQUEST['houseno']);
        $houseno = mysqli_real_escape_string($connection, $houseno);
        $stname = stripslashes($_REQUEST['street']);
        $stname = mysqli_real_escape_string($connection, $stname);
        $ctname = stripslashes($_REQUEST['city']);
        $ctname = mysqli_real_escape_string($connection, $ctname);
        $pcode = stripslashes($_REQUEST['postcode']);
        $pcode = mysqli_real_escape_string($connection, $pcode);
        //login details
        $uname = stripslashes($_REQUEST['username']);
        $uname = mysqli_real_escape_string($connection, $uname);
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($connection, $email);
        $pass = stripslashes($_REQUEST['password']);
        $pass = mysqli_real_escape_string($connection, $pass);

        $query = "INSERT INTO `users` (fname, lname, tel, age, gender, houseno, street, city,
                                    postcode, username, email, password)
             VALUES ('$fname', '$lname', '$tel', '$age', '$gender', '$houseno', '$stname', '$ctname', '$pcode','$uname',
                        '$email', '" . md5($pass) . "')";
        $result = mysqli_query($connection, $query);
        if ($result) {
            header("Location: users_table.php");
        } else {
            echo "Something didn't worked well";
        }
    }
    ?>

    <div class="form-centered">
        <div class="form">
            <div class="form-title">
                Insert Records
            </div>
            <div class="label">Insert new user details below</div>
            <div class="inner">
                <form method="POST" action="">
                    <input type="text" name="fname" placeholder="First Name" required=""><br>
                    <input type="text" name="lname" placeholder="Last Name" required=""><br>
                    <input type="text" name="age" placeholder="Age" required=""><br>
                    <input type="text" name="tel" placeholder="Telephone"><br>
                    Gender:<br>
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "male")
                        echo "checked"; ?>
                        value="male"><span id="ciki">Male</span>
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "female")
                        echo "checked"; ?>
                        value="female"><span id="ciki">Female</span>
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "other")
                        echo "checked"; ?>
                        value="other" checked><span id="ciki">Other</span>
                    <br><br>
                    <input type="text" name="houseno" placeholder="House No" required=""><br>
                    <input type="text" name="street" placeholder="Street Name" required=""><br>
                    <input type="text" name="city" placeholder="City Name" required=""><br>
                    <input type="text" name="postcode" placeholder="Postcode" required=""><br>
                    <input type="text" name="username" placeholder="Username" required=""><br>
                    <input type="text" name="email" placeholder="E-mail" required=""><br>
                    <input type="text" name="password" placeholder="Password" required=""><br>
            </div>
            <div class="button">
                <input type="submit" name="admin-user-insert" value="Submit">
            </div>

            </form>
        </div>
    </div>
</body>

</html>