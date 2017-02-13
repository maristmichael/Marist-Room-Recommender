<?php
	require 'sql_helper.php';
	
	if (!mysqli_select_db($conn, $dbname)) { // if I can select $dbname, it's fine. Otherwise, create database for me
		$sql = "CREATE DATABASE $dbname";
		if (mysql_query($conn, $sql)) {
			mysqli_select_db($conn, $dbname); // at this point, we have (1) a connection to the MySQL instance and (2) we have selected our project database for creating tables in it
		} else {
			echo "Error creating database: " . mysqli_error($conn);
			die;
		}
	}
	
	$tableRA = "RA";
	$tableRes = "RESERVATIONS";
	$tableUsers = "USERS";
	
	
	if (!RATableExists($tableRA)) { // if the table does not exist, then create it
		createRATable($tableRA, ["ID INT(11) AUTO_INCREMENT UNIQUE", "NAME VARCHAR(100)", "CLASS TINYINT(1)",
				"CAPACITY INT", "AVAILABLE INT", "KITCHEN TINYINT(1)", "LAUNDRY TINYINT(1)",
				"SPECIAL_NEEDS TINYINT(1)"]);
		
		createRecord($tableRA, ["'Leo Hall'", "1", "5", "5", "1", "1", "1"]);
		createRecord($tableRA, ["'Marian Hall'", "1", "5", "5", "1", "1", "1"]);
		createRecord($tableRA, ["'Sheahan Hall'", "1", "5", "5", "1", "1", "1"]);
		createRecord($tableRA, ["'Champagnat Hall'", "1", "5", "5", "1", "1", "1"]);
		createRecord($tableRA, ["'Midrise Hall'", "2", "5", "5", "1", "1", "1"]);
		createRecord($tableRA, ["'New Townhouses'", "2", "5", "5", "1", "1", "1"]);
		createRecord($tableRA, ["'Foy Townhouses'", "2", "5", "5", "1", "1", "1"]);
		createRecord($tableRA, ["'Lower West Cedar'", "2", "5", "5", "1", "1", "1"]);
		createRecord($tableRA, ["'Upper West Cedar'", "2", "5", "5", "1", "1", "1"]);
		createRecord($tableRA, ["'Building A'", "3", "5", "5", "1", "1", "1"]);
		createRecord($tableRA, ["'New Fulton'", "3", "5", "5", "1", "1", "1"]);
		createRecord($tableRA, ["'Fulton Street'", "3", "5", "5", "1", "1", "1"]);
		createRecord($tableRA, ["'Talmadge Court'", "3", "5", "5", "1", "1", "1"]);
		
	}
	
	if(!resTableExists($tableRes)) {
		createResTable($tableRes, ["ID INT(11) AUTO_INCREMENT UNIQUE", "CONFIRM_ID TEXT",
		"RA_NAME TEXT", "TIMESTAMP TIMESTAMP", "USERNAME TEXT"]);
	}
	
	if(!usersTableExists($tableUsers)) {
		createUsersTable($tableUsers, ["ID INT(11) AUTO_INCREMENT UNIQUE", "USERNAME TEXT", "PASSWORD TEXT",
		"NAME TEXT", "EMAIL TEXT", "CWID INT(8)", "CLASS TEXT", "GENDER TEXT", "KITCHEN TINYINT(1)",
		"LAUNDRY TINYINT(1)", "SPECIAL_NEEDS TINYINT(1)", "ADMIN TINYINT(1)"]);
		
		insertInto($tableUsers, ["USERNAME", "PASSWORD", "NAME", "ADMIN",], ["'admin'", "password('pass')", "'ADMIN'", "1"]);
		
	}
?>