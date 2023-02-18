<?php
require("connection/dbConnection.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>LT|Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="icon" type="image/png" href="images/flag.png">
    <link href="styles/style.css" rel="stylesheet">
</head>

<body class="register-background">
    <?php include("navigation.php"); ?>
    <?php
    //setting error messages to empty value
    $generalErrorMsg = $fnameError = $lnameError = $ageError = $genderError = $telError = $housenoError = $stnameError = $ctnameError = $pcodeError = $unameError = $emailError = $passError = $passMatch = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") //by using this method to find out if form methos was post the page will not be easy to hack
    {

        function clean_input($data) //function for cleaning the user input
    
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = strip_tags($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //first name error section
        if (!empty($_POST['firstname'])) //if field is not empty
        {
            if (preg_match("/^[a-zA-Z ]*$/", $_POST['firstname'])) //if value is letters and whitespace
            {
                $fname = clean_input($_POST["firstname"]); //the form element gets first through clening function and the is used to be inserted into the users table
            } else {
                $fnameError = "Only letters and whitespace allowed."; //error message for other characters
            }
        } else {
            $fnameError = "First Name is required"; //error message for empty field
        }
        //last name error section
        if (!empty($_POST['lastname'])) {
            if (preg_match("/^[a-zA-Z ]*$/", $_POST['lastname'])) {
                $lname = clean_input($_POST["lastname"]);
            } else {
                $lnameError = "Only letters and whitespace allowed.";
            }
        } else {
            $lnameError = "Last Name is required";
        }
        //age error section
        if (!empty($_POST['age'])) {
            if (is_numeric($_POST['age'])) {
                $age = clean_input($_POST["age"]);
            } else {
                $ageError = "Enter a numeric value for age";
            }
        } else {
            $ageError = "Age is required";
        }
        //gender error message
        if (empty($_POST['gender'])) {
            $genderError = "Gender is required";
        } else {
            $gender = clean_input($_POST["gender"]);
        }

        //telephone error section
        if (!empty($_POST['telephone'])) {
            if (is_numeric($_POST['telephone'])) {
                $tel = clean_input($_POST["telephone"]);
            } else {
                $telError = "Enter a numeric value for Phone Number";
            }
        } else {
            $telError = "Telephone number required";
        }
        //house number error section
        if (!empty($_POST['housenumber'])) {
            if (is_numeric($_POST['housenumber'])) {
                $houseno = clean_input($_POST["housenumber"]);
            } else {
                $housenoError = "We are working to make input on this value for letters too, but for a moment please enter a numeric value";
            }
        } else {
            $housenoError = "House Number required";
        }
        //street name error section
        if (!empty($_POST['streetname'])) {
            if (preg_match("/^[a-zA-Z ]*$/", $_POST['streetname'])) {
                $stname = clean_input($_POST["streetname"]);
            } else {
                $stnameError = "Whitespace and letters allowed for Street Name";
            }
        } else {
            $stnameError = "Street Name required";
        }
        //city name error message
        if (!empty($_POST['cityname'])) {
            if (preg_match("/^[a-zA-Z ]*$/", $_POST['cityname'])) {
                $ctname = clean_input($_POST["cityname"]);
            } else {
                $ctnameError = "Only letters, whitespace and numbers allowed";
            }
        } else {
            $ctnameError = "City name required";
        }
        //postcode error message
        if (!empty($_POST['postcode'])) {
            if (preg_match("/^[a-zA-Z0-9\s]*$/", $_POST['postcode'])) {
                $pcode = clean_input($_POST["postcode"]);
            } else {
                $pcodeError = "Only letters, whitespace and numbers allowed";
            }
        } else {
            $pcodeError = "Postcode is required";
        }
        //username error message
        if (!empty($_POST['username'])) {
            if (preg_match("/^[a-zA-Z0-9\s]*$/", $_POST['username'])) {
                $uname = clean_input($_POST["username"]);
            } else {
                $unameError = "Only letters and numbers allowed";
            }
        } else {
            $unameError = "Username required";
        }
        //email validation and error messages
        if (!empty($_POST['email'])) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = clean_input($_POST["email"]);
            } else {
                $emailError = "E-mail validation failed";
            }
        } else {
            $emailError = "E-mail is required";
        }
        //if passwords match and must be at minimum lenght of 5 characters
        if (!empty($_POST['password']) && !empty($_POST['vpassword'])) {
            if (strlen($_POST['password']) >= 5 && strlen($_POST['vpassword']) >= 5) {
                $vpassword = $_POST['vpassword'];
                $password = $_POST['password'];
                if ($password == $vpassword) {
                    $pass = clean_input($_POST["password"]);
                } else {
                    $passError = "Passwords do not match";
                }
            } else {
                $passError = "Minimum of 5 characters please";
            }

        } else {
            $passError = "Password cannot be empty";
        }

        //$generalErrorMsg = $fnameError = $lnameError = $ageError = $genderError = $telError = $housenoError = $stnameError = $ctnameError = $pcodeError = $unameError = $emailError = $passError = $passMatch = "";
    
        if (
            empty($generalErrorMsg) && empty($fnameError) && empty($lnameError) && empty($ageError) && empty($genderError) && empty($telError) &&
            empty($housenoError) && empty($stnameError) && empty($ctnameError) && empty($pcodeError) && empty($unameError) && empty($emailError)
            && empty($passError) && empty($passMatch)
        ) {

            $queryVerifyUsername = "SELECT `username` FROM `users` WHERE `username` = '" . $uname . "' ";
            $resultVerifyUsername = mysqli_query($connection, $queryVerifyUsername);
            $rows = mysqli_num_rows($resultVerifyUsername);
            if ($rows == 0) {
                $query = "INSERT INTO `users` (fname, lname, age, tel, gender, houseno, street, city,
                            postcode, username, email, password)
                            VALUES ('$fname', '$lname', '$age', '$tel', '$gender', '$houseno', '$stname', '$ctname', '$pcode','$uname',
                            '$email', '" . md5($pass) . "' )";
                $result = mysqli_query($connection, $query) or die(mysqli_error());
                if ($result) {
                    header("Location: login.php"); //if insertion has been successfull redirect user to login form
                } else {
                    $generalErrorMsg = "Something didn't worked well!Check the source code!"; //error message in case insertion hasn't took place
                }
            } else {
                $generalErrorMsg = "Username exists already";
            }
        }

    }
    ?>

    <h1 class="title">Welcome to Registration Portal</h1>
    <div class="form-style">
        <h1>Register With Us<span>Register with us Now and be able to book and find huge discounts!</span></h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!--$_server["php_self"] method is used to sanitize the form and protect it from external hacking-->
            <div class="section">
                <span>1</span>
                Personal Information
            </div>
            <div class="inner-wrap">
                <div class="php-msg">
                    <?php if ($fnameError != "")
                        echo $fnameError ?>
                    </div>
                    <label>First name<input type="text" name="firstname" value="<?php if (isset($_POST['firstname']))
                        echo $_POST['firstname']; ?>"> </label>
                <div class="php-msg">
                    <?php if ($lnameError != "")
                        echo $lnameError ?>
                    </div>
                    <label>Last Name<input type="text" name="lastname" value="<?php if (isset($_POST['lastname']))
                        echo $_POST['lastname']; ?>"></label>
                <div class="php-msg">
                    <?php if ($ageError != "")
                        echo $ageError ?>
                    </div>
                    <label>Age<input type="text" name="age" value="<?php if (isset($_POST['age']))
                        echo $_POST['age']; ?>"></label>
                <div class="php-msg">
                    <?php if ($genderError != "")
                        echo $genderError ?>
                    </div>
                    <label>Gender:<br>
                        <input type="radio" name="gender" <?php if (isset($gender) && $gender == "male")
                        echo "checked"; ?>
                        value="male">Male
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "female")
                        echo "checked"; ?>
                        value="female">Female
                    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "other")
                        echo "checked"; ?>
                        value="other">Other
                </label>
            </div>
            <div class="section"><span>2</span>Address Details</div>
            <div class="inner-wrap">
                <div class="php-msg">
                    <?php if ($stnameError != "")
                        echo $stnameError ?>
                    </div>
                    <label>Street Name<input type="text" name="streetname" value="<?php if (isset($_POST['streetname']))
                        echo $_POST['streetname']; ?>"></label>
                <div class="php-msg">
                    <?php if ($housenoError != "")
                        echo $housenoError ?>
                    </div>
                    <label>House No.<input type="text" name="housenumber" value="<?php if (isset($_POST['housenumber']))
                        echo $_POST['housenumber']; ?>"></label>
                <div class="php-msg">
                    <?php if ($pcodeError != "")
                        echo $pcodeError ?>
                    </div>
                    <label>Postcode<input type="text" name="postcode" value="<?php if (isset($_POST['postcode']))
                        echo $_POST['postcode']; ?>"></label>
                <div class="php-msg">
                    <?php if ($ctnameError != "")
                        echo $ctnameError ?>
                    </div>
                    <label>City<input type="text" name="cityname" value="<?php if (isset($_POST['cityname']))
                        echo $_POST['cityname']; ?>"></label>
            </div>
            <div class="section"><span>3</span>Email & Phone</div>
            <div class="inner-wrap">
                <div class="php-msg">
                    <?php if ($emailError != "")
                        echo $emailError ?>
                    </div>
                    <label>Email Address <input type="email" name="email" value="<?php if (isset($_POST['email']))
                        echo $_POST['email']; ?>"></label>
                <div class="php-msg">
                    <?php if ($telError != "")
                        echo $telError ?>
                    </div>
                    <label>Phone Number <input type="text" name="telephone" value="<?php if (isset($_POST['telephone']))
                        echo $_POST['telephone']; ?>"></label>
            </div>

            <div class="section"><span>4</span>Username & Passwords</div>
            <div class="inner-wrap">
                <div class="php-msg">
                    <?php if ($unameError != "")
                        echo $unameError ?>
                    <?php if ($generalErrorMsg != "")
                        echo $generalErrorMsg ?>
                    </div>
                    <label>Username<input type="text" name="username" value="<?php if (isset($_POST['username']))
                        echo $_POST['username']; ?>"></label>
                <div class="php-msg">
                    <?php if ($passError != "")
                        echo $passError ?>
                    <?php if ($passMatch != "")
                        echo $passMatch ?>
                    </div>
                    <label>Password <input type="password" name="password"></label>
                    <div class="php-msg">
                    <?php if ($passError != "")
                        echo $passError ?>
                    <?php if ($passMatch != "")
                        echo $passMatch ?>
                    </div>
                    <label>Confirm Password <input type="password" name="vpassword"></label>
                </div>
                <div class="button-section">
                    <input type="submit" name="submit" value="Sign Up">
                    <span class="privacy-policy">
                        <input type="checkbox" name="field7" required="">You agree to our Terms and Policy.
                    </span>
                </div>
            </form>
        </div>

    <?php include("footer.php"); ?>
</body>

</html>