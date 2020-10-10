<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'lock');

session_start();
$user = $_SESSION["username"];

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    //put the filepath in your system
    $fname="C:/xampp/htdocs\Project/files/".$user.".csv";
    $file=fopen($fname,"w") or die ("unable to find the file !");
    fputcsv($file,array("Domain name","Username","Password"));

    $sql="SELECT domain_name,domain_username,domain_password FROM safe where acc_username='$user'";

    $result=$con->query($sql);
    echo mysqli_error($con);
    $final=array();

    if($result->num_rows>0){

        $file=fopen($fname,"a") or die ("unable to find the file !");

        while($row=$result->fetch_assoc()){
            fputcsv($file,$row);
        }

        echo json_encode(array("status"=>"success","file"=>$fname));

    } else{
        echo json_encode(array("status"=>"fail"));
    }    
}
