<?php
session_start();
require("connection/dbConnection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>LT|Administrator Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" href="styles/style.css">
</head>

<body class="admin-login-background">
    <?php include("navigation.php"); ?>
    <?php
    $msg = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        function clean_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = strip_tags($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $adminName = clean_input($_POST["admin-name"]);
        $password = clean_input($_POST["password"]);
        $query = "SELECT * FROM admin WHERE name = '$adminName' AND password = '" . md5($password) . "' ";
        $result = mysqli_query($connection, $query) or die(mysqli_connect_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $url = 'admin/dashboard.php';
            $_SESSION['admin-name'] = $adminName;
            if (!headers_sent()) {
                header("location: ".$url."", true);
                exit;
            } else {
                echo '<script type="text/javascript">';
                echo 'window.location.href="'.$url.'";';
                echo '</script>';
                echo '<noscript>';
                echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
                echo '</noscript>'; exit;
            }
        } else {
            $msg = "These admin details are not corresponding to our records!";
        }
    }
    ?>
    <h1 class="title">Welcome to Administrator Portal</h1>
    <p class="php-msg">
        <?php if ($msg != "")
            echo $msg . "<br><br>" ?>
        </p>
        <div class="form-style" style="float: none;margin: auto;">
            <h1>Admin Portal<span>Log in here!</span></h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="section">Admin Name & Password</div>
            <div class="inner-wrap">
                <label>Admin Name<input type="text" name="admin-name" id="admin-name" value="admin: "> </label>
                <label>Password<input type="password" name="password" id="password"></label>
            </div>
            <div class="button-section">
                <input type="submit" name="submit" value="Login">
            </div>
        </form>
    </div>
    <?php include("footer.php"); ?>
</body>

</html>