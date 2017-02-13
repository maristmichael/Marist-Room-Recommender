<?php
session_start(); // Starting Session
require 'sql.php'; // get connection information
require 'admin_header.php';
	    
if ($_SESSION['login_user']) {
  if ($_SESSION['ADMIN']) {
      
    // if the admin wants to create new user
    if(isset($_POST['createSubmit'])) {
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
	    
	    // query DB, check if username already exists
	    $sqlCheck = "SELECT * FROM USERS WHERE USERNAME = '$username'";
        $result = mysqli_query($conn, $sqlCheck);
        
        // if the username does not exist, create the user
        if(!mysqli_num_rows($result) > 0) {
            $sql = "INSERT INTO USERS (USERNAME, PASSWORD, NAME, EMAIL, CWID, CLASS, GENDER, KITCHEN, LAUNDRY, SPECIAL_NEEDS, ADMIN)
	        VALUES ('$username', password('$password'), '$name', '$email', '$cwid', '$class', '$gender', '$kitchen','$laundry', '$specialNeeds', '$admin')";
       
            $result = mysqli_query($conn,$sql);
            unset($_POST['createSubmit']);
            echo "<b>Succesfully created new user: " . $username . "</b><br><br>";
        } else {
            echo "<b>There is a user with that username already.</b><br><br>";
        }
    }
  ?>
  
  <table>
    <tr>
      <td>Username</td><td></td>
      <td>Name</td><td></td>
      <td>Email</td><td></td>
      <td>Class</td><td></td>
      <td>CWID</td><td></td>
      <td>Gender</td><td></td>
      <td>Kitchen</td><td></td>
      <td>Laundry</td><td></td>
      <td>Special Needs</td><td></td>
      <td>Admin</td><td></td>
    </tr>
<?php
    // do not display the admin logged in to prevent deleting admin account
    $sql = "SELECT * FROM USERS WHERE USERNAME <> '$_SESSION[login_user]'";
    $result = mysqli_query($conn,$sql);
    while ($aRow = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$aRow['USERNAME']."</td>"; echo "<td></td>";
        echo "<td>".$aRow['NAME']."</td>"; echo "<td></td>";
        echo "<td>".$aRow['EMAIL']."</td>"; echo "<td></td>";
        echo "<td>".$aRow['CWID']."</td>"; echo "<td></td>";
        echo "<td>".$aRow['CLASS']."</td>"; echo "<td></td>";
        echo "<td>".$aRow['GENDER']."</td>"; echo "<td></td>";
        echo "<td>".$aRow['KITCHEN']."</td>"; echo "<td></td>";
        echo "<td>".$aRow['LAUNDRY']."</td>"; echo "<td></td>";
        echo "<td>".$aRow['SPECIAL_NEEDS']."</td>"; echo "<td></td>";
        echo "<td>".$aRow['ADMIN']."</td>"; echo "<td></td>";
        
        echo "<td>
            <form action='delete.php' method='post'>
            <input type='hidden' value='$aRow[USERNAME]' name='record'>
            <input type='hidden' value='USERS' name='table'>
            <input type='hidden' value='USERNAME' name='column'>
            <input type='hidden' value='Users' name='page'>
            <input type='submit' value='Delete'>
        </td></form>";
        echo "</tr>";
    }
    echo "</table>\n";
    
?>
    <br><br>
    Insert a new user:
    <table>
          <tr>
            <td>Username</td><td>Password</td><td>Name</td><td>Email</td><td>CWID</td><td>Class</td>
                    <td>Gender</td><td>Kitchen</td><td>Laundry</td><td>Special Needs</td><td>Admin</td>
          </tr>
          <tr>
            <form action="adminUsers.php" method="post">
            <td><input type="text" name="username"></td>
            <td><input type="password" name="password"></td>
            <td><input type="text" name="name"></td>
            <td><input type="email" name="email"></td>
            <td><input type="text" name="cwid"></td>
            <td><select name="class">
					<option value="Freshman">Freshman</option>
					<option value="Sophomore">Sophomore</option>
					<option value="Junior">Junior</option>
					<option value="Senior">Senior</option>
				</select></td>
            <td><select name="gender">
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select></td>
			<td><input type="checkbox" name="kitchen" value="1"></td>
			<td><input type="checkbox" name="laundry" value="1"></td>
			<td><input type="checkbox" name="special_needs" value="1"></td>
			<td><input type="checkbox" name="admin" value="1"></td>
          </tr>
          <tr>
            <td><input type="submit" value="Submit" name="createSubmit"></form></td>
          </tr>
        </table> 
<?php
    echo "<a href=adminMain.php>Main Admin Page</a><br>";
  } else {
      header('location:profile.php?message=You%20do%20not%20have%20access%20to%20this%20admin%20page.');
  }
} else { 
    header('location: index.php?message=You%20are%20not%20logged%20in.');
}


?>