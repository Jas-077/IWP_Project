<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'lock');

session_start();
$user = $_SESSION["username"];

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $type = $_POST['type'];

    if ($type == 'all') {

        $sql = "DELETE from safe where acc_username='$user'";
        if (mysqli_query($con, $sql)) {
            echo json_encode(array("status" => "success"));
        } else{
            echo json_encode(array("status" => "fail"));
        }

    } else if ($type == 'single') {
        $domain=$_POST['domain'];

        $sql = "DELETE from safe where acc_username='$user' and domain_name='$domain'";
        if (mysqli_query($con, $sql)) {
            echo json_encode(array("status" => "success"));
        } else{
            echo json_encode(array("status" => "fail"));
        }

    }
}

?>
