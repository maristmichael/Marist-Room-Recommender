<?php
    require 'layout.php';
    session_start();
    require 'sql.php';
    
    if ($_SESSION['login_user']) {
        
        $class = $_SESSION['class'];
        
        // convert string to integer
        if ($class == "Freshman") {$class = 1;}
        else if ($class == "Sophomore") {$class = 2;}
        else if ($class == "Junior") {$class = 3;}
        else {$class = 3;}
        
        echo "Please select a residence area.";
        
        // get all res areas that match the user's class
        $sql = "SELECT * FROM $tableRA WHERE CLASS = '$class'";
        $result = mysqli_query($conn, $sql);
        
        
        echo "<form action=\"page3.php\" method=\"post\">";
        echo "<select name=\"resArea\" size=\"1\" class=\"select\">";
        while($row = mysqli_fetch_assoc($result)) {
			$resName = $row["NAME"];
			$resAvailable = $row["AVAILABLE"];
				
			if ($resAvailable > 0) {
				echo "<option value=\"$resName\"> $resName ($resAvailable)</option>";
			} else {
				echo "<option value=\"$resName\" disabled> $resName($resAvailable)</option>";
			}
		}
		echo "</select>";
		echo '<input type = "submit" value ="Submit" class = "submit">';
        echo '</form>';

    // there is no user signed in
    } else {
        header('location:index.php?message=You%20must%20sign%20in%20first.');
    }