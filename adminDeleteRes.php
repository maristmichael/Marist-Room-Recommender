<?php
    session_start();
    require 'sql.php';
    
    //Check to see if user has logged and if they are an admin
    if ($_SESSION['login_user']) {
        if ($_SESSION['ADMIN']) {
            
            $username = $_POST['username'];
            $resArea = $_POST['resArea'];
            
            // delete the reservation and update the available rooms in the res area
            $sqlDelete = "DELETE FROM RESERVATIONS WHERE USERNAME = '$username'";
            $sqlUpdate = "UPDATE RA SET AVAILABLE = (AVAILABLE + 1) WHERE NAME = '$resArea'";
            
            $resultDelete = mysqli_query($conn, $sqlDelete);
            $resultUpdate = mysqli_query($conn, $sqlUpdate);
            
            if ($resultDelete) {
                echo "Reservation deleted for: " . $username . ".<br>";
            }
            if ($resultUpdate) {
                echo $resArea . " record updated successfully.";
            }
            
            echo "<br> <a href=adminReservations.php>Done</a>";
    
        //User is redirected to profile.php if they are not an admin  
        } else {
            header('location:profile.php?message=You%20do%20not%20have%20access%20to%20this%20admin%20page.');
        }
    
    //User is redirected to index.php if they are not logged in or do not have an account
    } else {
        header('location: index.php?message=You%20are%20not%20logged%20in.');
    }
?>