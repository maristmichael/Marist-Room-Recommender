<?php
session_start();
require 'sql.php';

//Function that returns an SQL Insert statement by entering the appropriate arguements
function insertRecord($table, $columns, $values) {
    $sql = "INSERT INTO $table $columns VALUES $values;";
    return $sql;
}

//Check to see if user has logged and if they are an admin
if ($_SESSION['login_user']) {
    if ($_SESSION['ADMIN']) {
    	
    	//Check to see if the Admin wants to insert a new user
    	if ($_POST['page'] == "Users") {
    		
    		//Check to see if Admin has submitted the new user form, if true, the captured POST data is inserted into the database
			if (isset($_POST['adminNewUser'])) {
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
			    $admin = $_POST["admin"];
			    
			    $sql = insertRecord("USERS", "(USERNAME, PASSWORD, NAME, EMAIL, CWID, CLASS, GENDER, KITCHEN, LAUNDRY, SPECIAL_NEEDS, ADMIN)",
			    "('$username', password('$password'), '$name', '$email', '$cwid', '$class', '$gender', '$kitchen','$laundry', '$specialNeeds', '$admin');");
	           
	            $result = mysqli_query($conn,$sql);
	            unset($_POST['adminNewUser']);
	            echo "<br>Succesfully created new user $username";
	            echo "<br> <a href=adminUsers.php>Done</a>";
	        
	        //Else the admin wants to create a new user but has not submitted the form, the HTML is presented to do so
            } else {
				echo $newUserHTML;
				echo "<br> <a href=admin".$_POST['page'].".php>Back</a>";
            }
        //Else the admin is redirected to adminMain.php if previous page is not adminUsers.php, adminRA, or adminReservations.php
    	} else {
    		header('location: adminMain.php');
    	}
 //User is redirected to profile.php if they are not an admin  
    } else {
        header('location:profile.php?message=You%20do%20not%20have%20access%20to%20this%20admin%20page.');
    }
    
//User is redirected to index.php if they are not logged in or do not have an account
} else {
    header('location: index.php?message=You%20are%20not%20logged%20in.');
}

?>