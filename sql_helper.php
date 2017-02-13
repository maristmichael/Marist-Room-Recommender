<?php
	$servername = "localhost";
	$username = "skistar002";
	$password = "";
	$dbname = "project3";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	function RATableExists($tableRA) {  // returns true if the table exists in the database 
        $sql = "SELECT * FROM $tableRA";
        if (query($sql) !== FALSE)
            return true;
        else 
            return false;
    }
    
    function resTableExists($tableRes) {
    	$sql = "SELECT * FROM $tableRes";
    	if (query($sql) !== FALSE)
            return true;
        else 
            return false;
    }
    
    function usersTableExists($tableUsers) {
    	$sql = "SELECT * FROM $tableUsers";
    	if (query($sql) !== FALSE)
    		return true;
    	else
    		return false;
    }
	
	function query($sql) {
        global $conn;
        return mysqli_query($conn, $sql);
    }
	
	function createRATable($tableRA, $columns) {
		$sql = "CREATE TABLE $tableRA (" . implode(", ", $columns) . ")";
		return query($sql);
	}
	
	function createResTable($tableRes, $columns) {
		$sql = "CREATE TABLE $tableRes (" . implode(", ", $columns) . ")";
		return query($sql);
	}
	
	function createRecord($tableRA, $values) {
		return insertInto($tableRA, ["NAME", "CLASS", "CAPACITY", "AVAILABLE","KITCHEN","LAUNDRY", "SPECIAL_NEEDS"], $values);
	}
	
	
	function insertInto($table, $columns, $values) {
        $sql = "INSERT INTO $table (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ")";
        return query($sql);
    }
	
	function createUsersTable($tableUsers, $columns) {
		$sql = "CREATE TABLE $tableUsers (" . implode(", ", $columns) . ")";
		return query($sql);
	}
?>