<?php
    session_start();
    require 'sql.php';
    require 'admin_header.php';
    
    
    if ($_SESSION['login_user']) {
        if ($_SESSION['ADMIN']) {
            echo "<h1>Administrative Menu</h1>";
            echo "Hello, ". $_SESSION['login_user'] . ".<br>";
        } else { // not an admin, redirect to user's profile
            header('location: profile.php');
        }
    } else {
        // not logged in
        header('location: index.php?noACCESS');
    }
?>