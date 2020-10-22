<?php
// Initialize the session
session_start();

$user = $_SESSION["username"];
// destroy the csv file ..give the filepath in your system 
//$filepath = $fname = "C:/xampp/htdocs\Project/files/" . $user . ".csv";
$filepath=$fname="/Applications/MAMP/htdocs/git_files1/files/".$user.".csv";
unlink($filepath);

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: index.php");
exit;
