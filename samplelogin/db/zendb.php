<?php
$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "zenith";

$conn = new mysqli($serverName,$username,$password,$dbName);

if($conn->connect_error){
    die("Connection is failed: ".$conn->connect_error );
}
?>