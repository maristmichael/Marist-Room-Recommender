<html>
    <head>
        <title>Cenk's Henchmen</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    
    <body>
    	<div class="signup">
	        <h1>Sign Up</h1>
	        
	        <form action="checksignup.php" method="POST">
				Enter a username<br>
				<input id="username" name="username" placeholder="username" type="text" required>
				
				<br><br>
				
				Enter a password<br>
				<input id="password" name="password" placeholder="**********" type="password" required>
				
				<br><br>
				
				Enter a name<br>
				<input id="name" name="name" placeholder="Name" type="text">
				
				<br><br>
				
				Enter an email<br>
				<input id="email" name="email" placeholder="Email" type="text">
				
				<br><br>
				
				Enter the CWID<br>
				<input id="CWID" name="cwid" placeholder="CWID" type="text">
				
				<br><br>
				
				Enter the class<br>
				<select name="class">
					<option value="Freshman">Freshman</option>
					<option value="Sophomore">Sophomore</option>
					<option value="Junior">Junior</option>
					<option value="Senior">Senior</option>
				</select>
				
				<br><br>
				
				Enter a gender<br>
				<select name="gender">
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
				
				<br><br>
				<input type="checkbox" name="kitchen" value="1">Kitchen
				<br>
				<input type="checkbox" name="laundry" value="1">Laundry
				<br>
				<input type="checkbox" name="special_needs" value="1">Special Needs
				<br><br>
				
				<input name="submit" type="submit" value="Sign Up" class="submit">
				
	        </form>
        </div> <!-- signup div -->
    </body>
</html>