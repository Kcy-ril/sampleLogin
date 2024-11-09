<?php
session_start();
include('../db/zendb.php');

if(isset($_POST['btnlog'])){
    $username = $_POST['username'];
    $password = $_POST['password']; // Assuming you handle password verification too

    // Check if username exists in admins table
    $query_admin = "SELECT * FROM admintbl WHERE username = ? and password = ?";
    $stmt_admin = $conn->prepare($query_admin);
    $stmt_admin->bind_param("si", $username, $password);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    if ($result_admin->num_rows > 0) {
        // User is an admin
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['role'] = 'admin';
        header("Location: ../home.php");
        exit();

    } else {
        // Check if username exists in customers table
        $query_customer = "SELECT * FROM usertbl WHERE username = ? and password = ?";
        $stmt_customer = $conn->prepare($query_customer);
        $stmt_customer->bind_param("si", $username , $password);
        $stmt_customer->execute();
        $result_customer = $stmt_customer->get_result();

        if ($result_customer->num_rows > 0) {
            // User is a customer
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['role'] = 'customer';
            header("Location: ../user.php");
            exit();
        } else {    
            // User does not exist in either table
            echo "Invalid username or password.";
        }
    }

    $stmt_admin->close();
    $stmt_customer->close();
    $conn->close();
}

?>