<?php
    require 'layout.php';
    session_start();
    require 'sql.php';
    
    if ($_SESSION['login_user']) {
    
        $username = $_SESSION['username'];
        
         
        if(isset($_POST['submitted'])){
            // if the user deleted her reservation, delete reservation and update available rooms
            
            $sql = "SELECT * FROM $tableRes WHERE USERNAME = '$username'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $resArea = $row['RA_NAME'];
            
            $sqlDelete = "DELETE FROM RESERVATIONS WHERE USERNAME = '$username'";
            mysqli_query($conn, $sqlDelete);
            
            $sqlUpdate = "UPDATE RA SET AVAILABLE = (AVAILABLE + 1) WHERE NAME = '$resArea'";
            mysqli_query($conn, $sqlUpdate);
            
            header('location: reservations.php');
        }
                
        
        // get the reservation for the user
        $sql = "SELECT * FROM $tableRes WHERE USERNAME = '$username'";
        $result = mysqli_query($conn, $sql);
        
        echo "Number of reservations for $username: " . mysqli_num_rows($result) . "<br>";
        
        if (mysqli_num_rows($result) == 1) {
            $aRow = mysqli_fetch_assoc($result);
    
            echo "<br><table>
                <tr>
                    <td>Confirmation ID: </td> <td>". $aRow['CONFIRM_ID'] . "</td>
                </tr>
                <tr>
                    <td>Residence Area: </td> <td>" . $aRow['RA_NAME'] . "</td>
                </tr>
                <tr>
                    <td>Reservation Time: </td> <td>" . $aRow['TIMESTAMP'] . "</td>
                </tr>
            </table>
            
            <br>
                
            <form action='reservations.php' method='post'>
                <input type='hidden' value=".$aRow['USERNAME']." name='record'>
                <input type='hidden' value='RESERVATIONS' name='table'>
                <input type='hidden' value='USERNAME' name='value'>
                <input type='hidden' value='Reservations' name='page'>
                <input type='hidden' value='submitted' name='submitted'>
                <input type='submit' value='Delete Reservation' class='submit'>
            </form>";
          
            
        } elseif (mysqli_num_rows($result) > 1) { // this should not happen
            die("User has multiple reservations");
        } else { // user does not have a reservation, so they can make one
            echo "<br><a href=page2.php>Create a reservation</a>";
        }
    } else {
        header('location:index.php?message=You%20must%20sign%20in%20first.');
    }

?>