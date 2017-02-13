<?php
    require 'layout.php';
    session_start();
    require 'sql.php';
    
    if ($_SESSION['login_user']) {
        
        // create a unique confirmation code
        $confirm_ID = substr(md5(uniqid(rand(), true)), 8, 8);
        $username = $_SESSION['login_user'];
        
        // insert the reservation, update the available rooms in RA table
        $resArea = $_POST["resArea"];
        $sqlInsert = "INSERT INTO RESERVATIONS (CONFIRM_ID, RA_NAME, USERNAME)
                VALUES('$confirm_ID', '$resArea', '$username')";
                
        $sqlUpdate = "UPDATE RA SET AVAILABLE = (AVAILABLE - 1) WHERE NAME = '$resArea'";
        
        if ($conn->query($sqlInsert) && $conn->query($sqlUpdate)) {
            echo "Thank you for your reservation.<br>";
            echo "Your confirmation ID is: " . $confirm_ID . ".<br>";
        }
                        
        
        
    } else {
        header('location:index.php?message=You%20must%20sign%20in%20first.');
    }
    
    
