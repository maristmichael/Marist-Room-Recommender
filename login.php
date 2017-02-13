<?php
	session_start();
	require 'sql.php';

	// If the user clicks on submit from index.php
	if (isset($_POST['submit'])) {
		
		// Check to see if user has not filled either username or password
		if(empty($_POST['username']) || empty($_POST['password'])) {
			echo "No username or password has been entered. <br>";
			echo "<a href=\"index.php\">Back to sign-in page.</a>";
		
		// Else the user has entered in a username and password	
		} else {
    		$username=$_POST['username'];
    		$password=$_POST['password'];
    		
    		$sql = "SELECT * FROM USERS WHERE PASSWORD=password('$password') AND USERNAME='$username'";
    		
    		$result = mysqli_query($conn, $sql);
    		
    		// if the query returns one user
    		if(mysqli_num_rows($result) == 1) {
    			$_SESSION['login_user']=$username;
    			$aUser = mysqli_fetch_assoc($result);
    			
    			$_SESSION['username'] = $aUser['USERNAME'];
    			$_SESSION['name'] = $aUser['NAME'];
    			$_SESSION['email'] = $aUser['EMAIL'];
    			$_SESSION['cwid'] = $aUser['CWID'];
    			$_SESSION['class'] = $aUser['CLASS'];
    			$_SESSION['gender'] = $aUser['GENDER'];
    			$_SESSION['kitchen'] = $aUser['KITCHEN'];
    			$_SESSION['laundry'] = $aUser['LAUNDRY'];
    			$_SESSION['specialNeeds'] = $aUser['SPECIAL_NEEDS'];
    			$_SESSION['ADMIN'] = $aUser['ADMIN'];
    			
    			// Checks if user has admin provaleges to direct to admin main page else user is directed to the profile page
    			if ($aUser['ADMIN']) {
    				header('location: adminMain.php');
    			} else {
    				header('location: profile.php');
    			}
    		
    		} else {
    			echo "The entered username or password is invalid.<br>";
    			echo "<a href=\"index.php\">Back to Login </a>";
    		}
    		
    		mysqli_close($conn);
		}
    }
?>