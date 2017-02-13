<?php
session_start();
require 'sql.php';

//Function that returns an SQL Delete statement by entering the appropriate arguements
function deleteRecord($table, $column, $value) {
    $sql = "DELETE FROM $table WHERE $column = '$value'";
    return $sql;
}

//Check to see if user has logged and if they are an admin
if ($_SESSION['login_user']) {
    if ($_SESSION['ADMIN']) {
        
        // Hidden data from previous page is posted onto a function that deletes the desired data
        $sql = deleteRecord($_POST['table'], $_POST['column'], $_POST['record']);
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Error: ". mysqli_error($conn);
        } else {
            echo "You deleted '".$_POST['record']. "' from the ".$_POST['table']. " table<br>";
            echo "Affected rows: " . mysqli_affected_rows($conn);
        }
        
        
        echo "<br> <a href=admin".$_POST['page'].".php>Done</a>";
    
    //User is redirected to profile.php if they are not an admin  
    } else {
        header('location:profile.php?message=You%20do%20not%20have%20access%20to%20this%20admin%20page.');
    }
    
//User is redirected to index.php if they are not logged in or do not have an account
} else {
    header('location: index.php?message=You%20are%20not%20logged%20in.');
}


?>