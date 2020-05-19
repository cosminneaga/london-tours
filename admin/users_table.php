<?php
require('../connection/dbConnection.php');
include('admin_auth.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add|Remove and Edit Users Details</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Always force latest IE rendering engine & Chrome Frame -->
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
    <div class="users-table-container">
        <h1 style="text-align: center;font-size: 50px; font-family: akronim;">Users List</h1>
        <table class="users-table-style">
        <thead>
             <tr>
                <th><strong>No.</strong></th>
                <th><strong>Name</strong></th>
                <th><strong>Tel No.</strong></th>
                <th><strong>House No.</strong></th>
                <th><strong>Street Name</strong></th>
                <th><strong>City Name</strong></th>
                <th><strong>Postcode</strong></th>
                <th><strong>Username</strong></th>
                <th><strong>E-mail</strong></th>
                <th><strong>Edit</strong></th>
                <th><strong>Delete</strong></th>
            </tr>
        </thead>
        <tbody>
         <?php
         $count=1;
         $query = "SELECT * FROM users ORDER BY id DESC";
         $result = mysqli_query($connection,$query);
         while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
               <td align="center">
                <?php echo $count; ?>
            </td>
            <td align="center">
                <?php echo $row["fname"]; ?> <?php echo $row["lname"]; ?>
            </td>
            <td align="center">
                <?php echo $row["tel"]; ?>
            </td>
            <td align="center">
                <?php echo $row["houseno"]; ?>
            </td>
            <td align="center">
                <?php echo $row["street"]; ?>
            </td>
            <td align="center">
                <?php echo $row["city"]; ?>
            </td>
            <td align="center">
                <?php echo $row["postcode"]; ?>
            </td>
            <td align="center">
                <?php echo $row["username"]; ?>
            </td>
            <td align="center">
                <?php echo $row["email"]; ?>
            </td>
            <td align="center">
                <a href="admin_user_edit.php?GetID=<?php echo $row['id']; ?>">Edit</a>
            </td>
            <td align="center">
                <a href="admin_user_delete.php?DeleteUserID=<?php echo $row['id']; ?>">Delete</a>
            </td>
         </tr>
        <?php $count++;	} ?>
        </tbody>
        </table>
</div>
</body>
</html>