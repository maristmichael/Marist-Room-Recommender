<?php
	require 'sql.php';
	if(isset($_SESSION['login_user'])) {
		header("location: profile.php");
		die;
	}
?>

<html>
	<head>
		<title>Cenk's Henchmen</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
		<body>
			<h1><a href="index.php" class="two">Cenk's Henchmen Reservations</a></h1>
			<?php echo $_GET[message];?>
			<h2>Login Form</h2>
			<form action="login.php" method="post">
				<label>Username :</label>
				<input id="name" name="username" placeholder="username" type="text">
				<label>Password :</label>
				<input id="password" name="password" placeholder="**********" type="password">
				<input name="submit" type="submit" value=" Login " class="submit">
			</form>
			New user? <a href="signup.php">Signup Here</a>
		</body>
</html>