<?php

    require 'sql.php';
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $cwid = $_POST["cwid"];
    $class = $_POST["class"];
    $gender = $_POST["gender"];
    $kitchen = $_POST["kitchen"];
    $laundry = $_POST["laundry"];
    $specialNeeds = $_POST["special_needs"];
    
    
    // check if username already exists.
    $sqlCheck = "SELECT * FROM USERS WHERE USERNAME = '$username'";
    
    $result = mysqli_query($conn, $sqlCheck);
    if(!mysqli_num_rows($result) == 0) {
        // if number of results is not zero, the username has been taken.
        echo "That username has already been taken. Please sign up with a different username.<br>";
        echo "<a href=\"signup.php\">Return to sign up.</a>";
        
    } else {
        // username has not been taken, so create new user
        $sql = "INSERT INTO USERS (USERNAME, PASSWORD, NAME, EMAIL, CWID, CLASS, GENDER, KITCHEN, LAUNDRY, SPECIAL_NEEDS, ADMIN)
            VALUES ('$username', password('$password'), '$name', '$email', '$cwid', '$class', '$gender', '$kitchen',
            '$laundry', '$specialNeeds', '0')";
            
        if ($conn->query($sql) === TRUE) { // if the query was successful, give user confirmation
            echo "<a href=\"index.php\">Your account has been created. Click to log in.</a>";
        } else {
            echo "There was a problem with signing up. Please contact the system administrator.";
        }
    }
    
    
    
            
?>