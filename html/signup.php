<?php
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
$sql1 = $link->prepare("insert into user(name,username,mail,age,password) values(?,?,?,?,?)");
$sql1->bind_param("sssss", $name, $username, $mail, $age, $pass2);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "SELECT * FROM lock.user WHERE username = ?;";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        // Set parameters
        $param_username = trim($_POST["user"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            /* store result */
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                $username_err = "This username is already taken.";
                echo '<script>
                alert("Username already taken");
                </script>';
            } else {
                $username = trim($_POST["user"]);
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    $name = $_POST["name"];
    $mail = $_POST["mail"];
    $age = ($_POST["age"]);
    $pass = $_POST["pass1"];
    $pass2 = password_hash($pass, PASSWORD_DEFAULT);
    //$pass2 = $pass;
    //$sql = "SELECT * FROM lock.user WHERE username = ?;";
    $sql1->execute();
    header("location: login.php");
}
?>
<html>

<head>
    <title>
        Sign Up
    </title>
    <link rel="icon" type="image/png" href="../images/android-chrome-512x512.png">
    <link rel="manifest" href="../images/site.webmanifest">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">

    <style>
        body {
            margin-top: 0px;
            margin-left: 0px;
            margin-right: 0px;
            margin-bottom: 0px;
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

        .logindex {

            width: 48%;
            margin: 12% auto 0;
            background: #1F2833;
            color: cyan;
            padding: 50px 50px;
            position: relative;
        }

        .avatar {
            height: 150px;
            border-radius: 50%;
            position: absolute;
            top: -14%;
            left: 28%;
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
                    <a href="signup.php" id="active">
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
        <div class="logindex">
            <form name="form1" action="signup.php" onsubmit="return validate()" method="POST">
                <img src="../images/avatar.png" class="avatar"><br>
                <p>Name (*):</p>
                <input type="text" name="name" minlength="1" maxlength="30" placeholder="Enter your Full name here"
                    required pattern="[A-Z]{1}[ A-Za-z]{1,30}">
                <p>Username (*):</p>
                <input type="text" name="user" minlength="1" maxlength="30" placeholder="Enter your Username here"
                    required>
                <p>Email id (*):</p>
                <input type="text" name="mail"
                    pattern="[a-zA-z]{1,}[.]{0,1}[a-zA-z0-9]{0,}[@][a-z]{1,10}[.][a-zA-z]{2,3}"
                    placeholder="Enter your valid email-id" required>
                <p>Age (*):</p>
                <input type="number" min="12" maxlength="3" placeholder="Enter age(Atleast 12)" name="age" required>
                <p>Password (*):</p>
                <input type="password" name="pass1" minlength="8" maxlength="20" placeholder="Enter a strong Password"
                    required>
                <p>Confirm Password (*):</p>
                <input type="password" name="pass2" minlength="8" maxlength="20" placeholder="Enter the above Password"
                    required>
                <input type="submit" name="" value="Sign Up">
                <a href="../html/login.php">Already have an account? Log in!</a><br>
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
