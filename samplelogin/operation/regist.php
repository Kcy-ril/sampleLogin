<?php 
require_once("../db/zendb.php");
session_start();

if(isset( $_POST['btnRes'])){
$username = $_POST['username'];
$password = $_POST['password'];


if(!empty ($username) && !empty ($password)){
$sql = "INSERT INTO `usertbl` (`id`, `username`, `password`) VALUES (NULL, '$username', '$password');";
$query = $conn->query($sql);
if ($query){   
    $_SESSION["sess_add_succ"] = "Success! New Data Added";
    unset($_SESSION["sess_add_err"]);
}
else{  
    $_SESSION["sess_add_err"] = "Failed! No Data Added";   
    unset($_SESSION["sess_add_succ"]);
}

}else{
$_SESSION["sess_add_err"] = "Please complete all fields!";
unset($_SESSION["sess_add_succ"]);
}

}else{
$_SESSION["sess_add_err"] = "Empty Fields!";
unset($_SESSION["sess_add_succ"]);
}

header("location: ../login.php");

?>