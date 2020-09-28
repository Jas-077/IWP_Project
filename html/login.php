<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: generate.html");
    exit;
}

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'lock');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

<html>

<head>
    <title>Log in</title>

    <link rel="icon" type="image/png" href="../images/android-chrome-512x512.png">
    <link rel="manifest" href="../images/site.webmanifest">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/gen_loader.css">


    <style>
        body {
            margin-top: 0px;
            margin-left: 0px;
            margin-right: 0px;
            background-image: url('../images/back2.jpg'), linear-gradient(yellow, #0B0C10);
            background-attachment: fixed, fixed;
            background-size: cover, cover;
            overflow: visible;
        }

        footer {
            position: initial;
        }

        main {
            min-height: 80vh;
            width: 50%;
            margin: 3% auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logindex{

            width: 48%;
            margin: 10% auto 0;
            background: #1F2833;
            color:cyan ;
            padding: 50px 50px;
            position: relative;
        }

        .avatar {
            height: 150px;
            border-radius: 50%;
            position: absolute;
            top:-18%;
            left:28%;
        }

        .logindex p {
            margin: 0;
            padding: 0;
            font-weight: bold;
            font-size: 18px;
            font-family: monospace;
        }

        .logindex input {
            width: 100%;
            margin-bottom: 20px;
        }

        .logindex input[type="text"],
        input[type="number"],
        input[type="password"] {
            border: none;
            border-bottom: 1px solid #fff;
            background: transparent;
            outline: none;
            height: 40px;
            color:#45A29E ;
;
            font-size: 16px;
        }

        .logindex input[type="submit"] {
            border: none;
            outline: none;
            height: 40px;
            background: #fb2525;
            color: #fff;
            font-size: 18px;
            border-radius: 20px;
        }

        .logindex input[type="submit"]:hover {
            cursor: pointer;
            background: black;
            color: yellow;
        }

        .logindex a {
            text-decoration: none;
            font-size: 12px;
            line-height: 20px;
            color: #45A29E;
        }

        .logindex a:hover {
            color: #66FCF1;
        }

        #Cap {
            width: 20px;
            height: 20px;
            text-align: center;
            position: relative;
            margin-top: 7px;
            margin-left: 100px;
            margin-bottom: 7px;
        }
    </style>
</head>

<body>

    <div class="loader-container">
        <h1>Redirecting</h1>
    </div>

    <header>
        <div class="nav-container">
            <div class="navbar">
                <img src="../images/logo.PNG" alt="logo" width="100">
                <ul>
                    <a href="index.php">

                        <li>Home</li>
                    </a>
                    <a href="signup.php">
                        <li>SignUp</li>
                    </a>
                    <a href="../html/login.php" id="active">
                        <li>Login</li>
                    </a>
                </ul>
            </div class="navbar">
        </div>
        </div>
    </header>
    <main>
        <div class="logindex">
            <form name="form1" action="login.php" onsubmit="return validate()" method="POST">
                <img src="../images/avatar.png" class="avatar"><br>
                <p>Username (*):</p>
                <input type="text" name="user" minlength="1" maxlength="30" placeholder="Enter your Username here"
                    required>
                <p>Password (*):</p>
                <input type="password" name="pass1" minlength="8" maxlength="20" placeholder="Enter your Password"
                    required>
                <p>Captcha :</p>
                <div id="Cap">
                    <p></p>
                </div>
                <p>Enter Captcha (*):</p>
                <input type="text" name="cap" minlength="1" maxlength="7" pattern="[0-9a-zA-Z]{1,7}"
                    placeholder="Enter the Captcha here" required>
                <input type="submit" name="" value="Log in">
                <a href="../html/signup.php">Dont have an Account? Sign up</a><br>
                <a href="forgot.php">Forgot Password? Click Here!</a>
            </form>
        </div>
    </main>
</body>
<script>
    var x = document.getElementById("Cap");
    var t = "";
    var z = Math.floor((Math.random() * (8 - 6)) + 6);
    var ran = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    for (var i = 0; i < z; i++) {
        t += ran[Math.floor(Math.random() * ran.length)];
    }
    x.innerHTML = t;
    function validate() {
        var a = document.forms["form1"]["cap"].value;
        if (a === t)
            ;
        else {
            alert("Pls Re enter the captionxs");
            return false;
        }
    }
</script>
<footer>
    <div class="copyright">Copyright © 2020 Lock&Key</div>
    <div>
        <a href="https://github.com/Jas-077/IWP_Project" target="_blank">
            <i class="fa fa-github fa-2x" aria-hidden="true"></i>
        </a>
    </div>
    <script src='../js/gen_loader.js'></script>
</footer>
</html>

<?php

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT username, password FROM user WHERE username = ?";
        $username = $_POST["user"];
        $password = $_POST["pass1"];
        //echo "<script>alert('$password')</script>";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {

                        if (password_verify($password, $hashed_password)) {

                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            //header("location: login.php?successfull");

                            echo "<script>myFunction()</script>";
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                            echo '<script>
                            alert("Wrong password entered");
                            </script>';
                            $_SESSION = array();

                            // Destroy the session.
                            session_destroy();
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                    echo '<script>
                            alert("No account found with that username.");
                            </script>';
                    $_SESSION = array();

                    // Destroy the session.
                    session_destroy();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
}

?>

