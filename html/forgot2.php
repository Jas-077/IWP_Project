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

require '/Applications/MAMP/htdocs/PHPMailer-master/src/Exception.php';
require '/Applications/MAMP/htdocs/PHPMailer-master/src/PHPMailer.php';
require '/Applications/MAMP/htdocs/PHPMailer-master/src/SMTP.php';
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(($_SERVER["REQUEST_METHOD"] == "POST"))
{
$a= $_POST["otp"];
$sql2="select otp from otp_con";
$result = mysqli_query($link, $sql2);
$row=mysqli_fetch_assoc($result);
$b=$row["otp"];
//$sql3=$link->prepare("DELETE FROM otp_con WHERE otp='$a'");
if($a==$b)
{
    header("location: forgot3.php?successfull");
}
else{
    header("location: forgot.php?unsucessfull");
}
}
?>