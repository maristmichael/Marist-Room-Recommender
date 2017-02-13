<?php
session_start(); // Starting Session
require 'sql.php'; // get connection information
require 'admin_header.php';

if ($_SESSION['login_user']) {
  if ($_SESSION['ADMIN']) {
    
    // if the admin wants to create a new reservation
    if(isset($_POST['submitted'])){
      
      // check if there is a reservation for the user already
      $sqlCheck = "SELECT * FROM RESERVATIONS WHERE USERNAME = '$_POST[username]'";
      $result = mysqli_query($conn, $sqlCheck);
      
      // if no reservation exsists, create the reservation
      if(!mysqli_num_rows($result) > 0) {
        $confirm_ID = substr(md5(uniqid(rand(), true)), 8, 8);
        $sqlInsert = "INSERT INTO RESERVATIONS (USERNAME, CONFIRM_ID, RA_NAME)
                VALUES ('$_POST[username]', '$confirm_ID', '$_POST[resArea]')";
        mysqli_query($conn, $sqlInsert);
        
        $sqlUpdate = "UPDATE RA SET AVAILABLE = (AVAILABLE - 1) 
                      WHERE NAME = '$_POST[resArea]'";
        mysqli_query($conn, $sqlUpdate);
        
        if ($sqlInsert && $sqlUpdate) {
          echo "Successfully created reservation.<br>";
        } else {
          echo "Error";
        }
      // a reservation for that user already exists, do nothing
      } else {
        echo "<b>Error: a user can only have one reservation.</b><br><br>";
      }
    }
  ?>
  
  <table>
    <tr>
      <td>Username</td> <td></td>
      <td>Confirmation ID</td><td></td>
      <td>Residence Area</td><td></td>
      <td>Timestamp</td><td></td>
    </tr>
<?php
    $sql = "SELECT * FROM RESERVATIONS";
    $result = mysqli_query($conn,$sql);
    while ($aRow = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$aRow['USERNAME']."</td>"; echo "<td></td>";
        echo "<td>".$aRow['CONFIRM_ID']."</td>";echo "<td></td>";
        echo "<td>".$aRow['RA_NAME']."</td>"; echo "<td></td>";
        echo "<td>".$aRow['TIMESTAMP']."</td>"; echo "<td></td>";

        echo "<td>
            <form action='adminDeleteRes.php' method='post'>
            <input type='hidden' value='$aRow[USERNAME]' name='username'>
            <input type='hidden' value='$aRow[RA_NAME]' name='resArea'>
            <input type='submit' value='Delete'>
        </td></form>";
      
     
        //echo "<td><a method=\"post\" onClick=\"javascript: return confirm('Please confirm deletion');\" href=delete.php?cwid=".$aRow['NAME'].">Delete</a></td>\n";
        echo "</tr>";
    }
    echo "</table>\n";
    
    // Insert new reservation
    
    $sqlUsers = "SELECT * FROM $tableUsers WHERE ADMIN <> 1";
    $resultUsers = mysqli_query($conn, $sqlUsers);
    $sqlRA = "SELECT * FROM $tableRA";
    $resultRA = mysqli_query($conn, $sqlRA);
    
    echo "<br><br>Create a new reservation:<br>";
    echo "<form action=\"adminReservations.php\" method=\"post\">
      <table>
        <tr>
          <td>Username</td><td>Residence Area</td>
        </tr>
        <tr>
          <td>";
            echo "<select name=\"username\" size=\"1\">";
              while($row = mysqli_fetch_assoc($resultUsers)) {
                $username = $row["USERNAME"];
                $available = $row["AVAILABLE"];
                echo "<option value=\"$username\"> $username</option>";
              }
            echo "</select>
          </td>
          <td>
            <select name=\"resArea\" size=\"1\">";
              while($row = mysqli_fetch_assoc($resultRA)) {
                $resArea = $row["NAME"];
                $available = $row["AVAILABLE"];
                echo "<option value=\"$resArea\"> $resArea ($available)</option>";
              }
            echo "</select>
          </td>
        </tr>
      </table>
    <input type=\"submit\" name=\"submitted\" value =\"Submit\">";
                
    echo "<br><br><br><a href=adminMain.php>Main Admin Page</a><br>";
  } else {
      header('location:profile.php?message=You%20do%20not%20have%20access%20to%20this%20admin%20page.');
  }
} else { 
    header('location: index.php?message=You%20are%20not%20logged%20in.');
}


?>