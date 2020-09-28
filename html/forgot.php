<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'lock');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* If you installed PHPMailer without Composer do this instead: */

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
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
        .mail input[type="text"]
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
            width: 60%;
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
        <form action="forgot.php" method="POST" id="form1">
            Enter Registered Email-id:
            <input type="text" name="mail"
                    pattern="[a-zA-z]{1,}[.]{0,1}[a-zA-z0-9]{0,}[@][a-z]{1,10}[.][a-zA-z]{2,3}"
                    placeholder="Enter your valid email-id" required>
                    <input type="submit" name="" value="Send OTP" id="but1">
        </form>
        <form action="forgot2.php" method="POST" id="form2" style="display:none;">
            Enter Recieved OTP:
            <input type="text" name="otp"
                    pattern="[0-9]{4}"
                    placeholder="OTP" required style="letter-spacing: 2em;" maxlength="4" minlength="4">
                    <input type="submit" name="" value="Verify OTP" id="but1">
        </form>
        </div>
        </main>
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
        <?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $sql2="select * from otp_con";
    $result = mysqli_query($link, $sql2);
    $row=mysqli_fetch_array($result);
    $mail=$row["mail"];
    $sql3="DELETE FROM otp_con WHERE mail='$mail'";
    mysqli_query($link,$sql3);

    $sql = "SELECT * FROM lock.user WHERE mail = ?;";
    if($stmt = mysqli_prepare($link, $sql))
    {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_mail);
        
        // Set parameters
        $param_mail = trim($_POST["mail"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            /* store result */
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) != 1){
                echo '<script>
                alert("Entered Mail does not exist");
                </script>';
            } 
            else
            {
                echo '<script>
                alert("Entered Mail does  exist");
                </script>';


/* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
$mail = new PHPMailer(TRUE);
$result = ""; 
$generator = "1357902468"; 
for ($i = 1; $i <= 4; $i++) { 
$result .= substr($generator, (rand()%(strlen($generator))), 1); 
} 
/* Open the try/catch block. */
try {
  //$mail->SMTPDebug= 2;
   $mail->isSMTP();
   $mail->Host ='smtp.gmail.com';
   $mail->SMTPAuth= true;
   $mail->Username= 'noreply.locknkey@gmail.com';
   $mail->Password= 'Lock&key!';
   $mail ->SMTPSecure= 'tls';
   $mail->Port= 587;

   $mail->setFrom('noreply.locknkey@gmail.com','Lock&Key');
   $mail->addAddress(trim($_POST["mail"]));

   $mail->isHTML(true);
   $mail->Subject="Forgot Password Instructions";
   $mail->Body= "Hello,<br> Pls Enter this OTP: ".$result." and follow the instructions to change your password.<br><br>Thankyou,<br>Lock&Key Team";

   $mail->send();
   echo 'Message sent';
   echo '<script>
document.getElementById("form1").style.display="none";
document.getElementById("form2").style.display="block";
</script>';
$sql1=$link->prepare("insert into otp_con (otp,mail) values(?,?)");
$sql1->bind_param("ss",$result,$_POST["mail"]);

$sql1->execute();
}
catch(Exception $e)
{
    echo "Message could not be sent. Error: ";
}

            }
        } 
        else
        {
            echo "Oops! Something went wrong. Please try again later.";
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
}

?>