<?php
session_start();

//Connection
$db_hostname = 'localhost';
$db_database = 'portfolio';
$db_username = 'root';
$db_password = '';

// Connect
$dbConn = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

function user_login ($username, $password) 
{
	global $dbConn;
	
	$sql = "SELECT username, password FROM users WHERE username = '$username'";
	$res = mysqli_query($dbConn, $sql);
	
	if($row = mysqli_fetch_assoc($res))
	{
		//User exist
		$dbpass = $row['password'];
		$salt = substr($dbpass, 0, 64);
		$sentpass = hash('sha256', $salt.$password);
		$sentwithsalt = $salt.$sentpass;
		
		if($sentwithsalt == $dbpass)
		{
			//take the username and prevent SQL injections 
			$username = mysqli_real_escape_string($dbConn, $username);
			//begin the query
			$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$sentwithsalt' LIMIT 1";
			$res = mysqli_query($dbConn, $sql);
			//check to see how many rows were returned
			$rows = mysqli_num_rows($res);
			
			if ($rows<=0 )
			{
			echo "<p class='fel'>Fel användarnamn/lösenord</p>"; 
			}
			else 
			{ 
			//have them logged in 
			$_SESSION['username'] = $username; 
			}
		}
	}
}

?>