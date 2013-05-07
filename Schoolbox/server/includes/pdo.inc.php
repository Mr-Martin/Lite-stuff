<?php

		
		$username = "root";
		$password = "root";
		$hostname = "localhost";
		$database = "schoolbox";
		
		try {
			$db = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
			$db->exec("SET CHARACTER SET utf8");
		} 
		catch (PDOException $e) {
			echo $e->getMessage();
			exit();
		}
		
		