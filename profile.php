<?php
    require 'layout.php';
    session_start();
    
    if ($_SESSION['login_user']) {
        
        // if the user is logged in, display data about the user

        echo "<table>
            <tr>
                <td>Username: </td> <td> " . $_SESSION['username'] . " </td>
            </tr>
            <tr>
                <td>Name: </td> <td> " . $_SESSION['name'] . " </td>
            </tr>
            <tr>
                <td>Class: </td> <td> " . $_SESSION['class'] . " </td>
            </tr>
            <tr>
                <td>CWID: </td> <td> " . $_SESSION['cwid'] . " </td>
            </tr>
            <tr>
                <td>Email: </td> <td> " . $_SESSION['email'] . " </td>
            </tr>
            <tr>
                <td>Gender: </td> <td> " . $_SESSION['gender'] . " </td>
            </tr>
        </table>";
    } else {
        header('location:index.php?message=You%20must%20sign%20in%20first.');
    }
    
?>
    
</html>
