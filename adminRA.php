<?php
    session_start();
    require 'sql.php';
    require 'admin_header.php';
  
    if ($_SESSION['login_user']) {
      if ($_SESSION['ADMIN']) {
        
        
        // if the user deleted a res area, delete res area from RA table
        if(isset($_POST["submitted"])) {
          $resArea = $_POST['resArea'];
          
          $sqlDelete = "DELETE FROM RA WHERE NAME = '$resArea'";
          mysqli_query($conn, $sqlDelete);
          
          header('location: adminRA.php');
        }
        
        // if the user created a new res area, insert into RA table
        if(isset($_POST["createSubmit"])) {
          $sqlInsert = "INSERT INTO RA (NAME, CLASS, CAPACITY, AVAILABLE, KITCHEN, LAUNDRY, SPECIAL_NEEDS)
                        VALUES('$_POST[name]', '$_POST[class]', '$_POST[capacity]', '$_POST[available]',
                        '$_POST[kitchen]', '$_POST[laundry]', '$_POST[specialneeds]')";
          mysqli_query($conn, $sqlInsert);
          header('location: adminRA.php');
        }
  ?>
        <table>
          <tr>
            <td>Name</td><td></td>
            <td>Class</td><td></td>
            <td>Capacity</td><td></td>
            <td>Available</td><td></td>
            <td>Kitchen</td><td></td>
            <td>Laundry</td><td></td>
            <td>Special Needs</td><td></td>
          </tr>
  <?php
        $sql = "SELECT * FROM RA";
        $result = mysqli_query($conn,$sql);
        while ($aRow = mysqli_fetch_assoc($result)) {
          echo "<tr>";
            echo "<td>".$aRow['NAME']."</td>"; echo "<td></td>";
            echo "<td>".$aRow['CLASS']."</td>"; echo "<td></td>";
            echo "<td>".$aRow['CAPACITY']."</td>"; echo "<td></td>";
            echo "<td>".$aRow['AVAILABLE']."</td>"; echo "<td></td>";
            echo "<td>".$aRow['KITCHEN']."</td>"; echo "<td></td>";
            echo "<td>".$aRow['LAUNDRY']."</td>"; echo "<td></td>";
            echo "<td>".$aRow['SPECIAL_NEEDS']."</td>"; echo "<td></td>";
            
            echo "<td>
              <form action='adminRA.php' method='post'>
                <input type='hidden' value='$aRow[NAME]' name='resArea'>
                <input type='hidden' value='RA' name='table'>
                <input type='hidden' value='submitted' name='submitted'>
                <input type='submit' value='Delete'>
              </form>
            </td>
        </tr>";
        }
        echo "</table>";
        ?>
        <br>
        
        <!-- form for an admin to create a new res area -->
        Create a new Residence Area:<br>
        <form action="adminRA.php" method="post">
        <table>
          <tr>
            <td>Name</td><td>Class</td><td>Capacity</td><td>Available</td><td>Kitchen</td><td>Laundry</td><td>Special Needs</td>
          </tr>
          <tr>
            <td><input type="text" name="name"></td>
            <td><input type="number" value="1" name="class" min="1" max="3"></td>
            <td><input type="number" value="5" name="capacity" style="width: 50px;" /></td>
            <td><input type="number" value="5" name="available"></td>
            <td><input type="number" value="1" name="kitchen" min="0" max="1"></td>
            <td><input type="number" value="1" name="laundry" min="0" max="1"></td>
            <td><input type="number" value="1" name="specialneeds" min="0" max="1"></td>
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
  </body>
</html>