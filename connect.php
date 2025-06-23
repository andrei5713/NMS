<?php
$host="localhost";
$user="root";
$pass="";
$db="login";
$conn=new mysqli(hostname: $host,username: $user,password: $pass,database: $db);
if($conn->connect_error){
    echo "failed to connect DB".$conn->connect_error;
}
?>

