<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'lock');

session_start();
$user=$_SESSION["username"];

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM safe WHERE acc_username='$user'";

    $result = $con->query($sql);
    $final = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($final, $row);
        }

        echo json_encode($final);
    } else {
        echo json_encode("No data");
    }

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $domain = $_POST['domain'];
    $username = $_POST['d_username'];
    $u_password = $_POST['password'];
    $g_password = $_POST['pass2'];

    $sql = "";
    if ($u_password != '') {
        $sql = "INSERT INTO safe (acc_username,domain_name,domain_username,domain_password) VALUES ('$user','$domain','$username','$u_password')";
    } else {

        $sql = "INSERT INTO safe (acc_username,domain_name,domain_username,domain_password) VALUES ('$user','$domain','$username','$g_password')";
    }

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Successfully added to Safe')
        window.location='generate.html'</script>";

    }

}
