<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'lock');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
use PHPMailer\PHPMailer\PHPMailer;

/* If you installed PHPMailer without Composer do this instead: */

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = $_POST["pass1"];
    $sql2 = "select * from otp_con";
    $result = mysqli_query($link, $sql2);
    $row = mysqli_fetch_array($result);
    $mail = $row["mail"];
    $a = password_hash($a, PASSWORD_DEFAULT);
    $sql1 = "UPDATE user SET password='$a' WHERE mail='$mail'";
    mysqli_query($link, $sql1);
    $sql3 = "DELETE FROM otp_con WHERE mail='$mail'";
    mysqli_query($link, $sql3);
    echo '<script>
    alert("Password Successfully Changed 👍. Pls login with the new credentials.");
    location.href="login.php";
    </script>';
}
?>
<html>

<head>
    <title>
        Forgot -Password
    </title>
    <link rel="icon" type="image/png" href="../images/android-chrome-512x512.png">
    <link rel="manifest" href="../images/site.webmanifest">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <style>
         body {
            background-color: #000000;
            background-image: linear-gradient(45deg, rgb(3, 7, 17) 0%, #031832 50%, #0E2847 100%);
            background-size: 400% 400%;
            animation: Gradient 15s ease infinite;
            animation-direction: alternate;
            animation-delay: 5s;
            color: white;
        }
        main {
            min-height: 80vh;
            width: 50%;
            margin: 3% auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        @keyframes Gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }
        .mail{
            width: 40%
        }
        .mail input {
            width: 100%;
            margin-bottom: 20px;
        }
        .mail input[type="password"]
         {
            border: none;
            border-bottom: 1px solid #fff;
            background: transparent;
            outline: none;
            height: 40px;
            color:#45A29E ;
            font-size: 16px;
        }
        #but1 {
            display: inline-block;
            background-color: #031832;
            color: #66fcf1;
            height: 40px;
            width: 100%;
            font-size: 20px;
            border: 1px solid;
            padding: 10px;
            cursor: pointer;
            box-shadow: 5px 5px 3px rgb(2, 41, 88);
        }

        #but1:hover {
            background-color: #087575;
            color: #0E2847;
        }

        #but1:active {
            background-color: #031832;
            color: #66fcf1;
            box-shadow: 0px 2px rgb(2, 41, 88);
            transform: translateY(2px);
        }
        #p
        {
            font-size: 30px;
        }

    </style>
</head>
<body>
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
                    <a href="../html/login.php">
                        <li>Login</li>
                    </a>
                </ul>
            </div class="navbar">
        </div>
        </div>
    </header>
    <main>
    <div class="mail">
        <form action="forgot3.php" method="POST" id="form1" onsubmit="return validate()">
        <p>Password (*):</p>
                <input type="password" name="pass1" minlength="8" maxlength="20" placeholder="Enter a strong Password"
                    required>
                <p>Confirm Password (*):</p>
                <input type="password" name="pass2" minlength="8" maxlength="20" placeholder="Enter the above Password"
                    required>
                    <input type="submit" name="" value="Change Password" id="but1">
        </form>
        </div>
        </main>

        <script>
        function validate() {
            var x = document.forms["form1"]["pass1"].value;
            var y = document.forms["form1"]["pass2"].value;
            var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
            if (strongRegex.test(x)) {
                if (x != y) {
                    alert("Pls Enter the correct password in Confirm password option");
                    return false;
                }
            }
            else {
                alert("The entered Password is not strong enough");
                return false;
            }
        }
    </script>

        </body>
        <footer>
            <div class="copyright">Copyright © 2020 Lock&Key</div>
            <div>
                <a href="https://github.com/Jas-077/IWP_Project" target="_blank">
                    <i class="fa fa-github fa-2x" aria-hidden="true"></i>
                </a>
            </div>
        </footer>
        </html>
