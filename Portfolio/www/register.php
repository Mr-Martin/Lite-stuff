<!DOCTYPE html >
<html>
	<head>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" media="screen" />

	</head>
	<body id="iframe">
		<?php 
		include("functions.php"); 
		include("db.php");

		if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']))
			{
				//Prevent SQL injections 
				$firstname	 = safe_insert($_POST['firstname']); 
				$lastname	 = safe_insert($_POST['lastname']); 
				$username	 = safe_insert($_POST['username']); 
				$email		 = safe_insert($_POST['email']); 
				$password	 = $_POST['password']; 
				$level		 = "Member"; 
				$account_key = createKey();
				 
				//Crypt the password
				$slump = time() . "hemligt" . $username;
				$salt = hash('sha256', $slump);
				
				$password = hash('sha256', $salt.$password);
				$password = $salt.$password;
				 
				//Check to see if username exists 
				$sql = "SELECT username FROM users WHERE username = '$username'";
				$res = mysqli_query($dbConn, $sql);
				if (mysqli_num_rows($res)>0) 
					{ 
						die ("<div id='konto'><h2 id='konto_skapat'>Användaren finns redan.</h2></div>"); 
					}
				
				$sql = "INSERT INTO users (firstname, lastname, username, password, email, level, account_key) VALUES ('$firstname', '$lastname', '$username', '$password', '$email', '$level', '$account_key')";
				$res = mysqli_query($dbConn, $sql);

				echo "<div id='konto'><h2 id='konto_skapat'>Konto skapat.</h2></div>";
			} 
		?>
	</body>
</html>