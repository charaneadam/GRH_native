<?php

	function connexion(){
		
		$servername = "localhost";
		$username = "adam";
		$password = "Local MariaDB Password";
		$dbname = "GRH";
	
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		
		return $conn;
		
	}

?>