<?php
include("functions.php");
include("db.php");
?>
<html>
	<head>
		<title>Portfolio</title>
		<meta charset="UTF-8">
		
		<!-- General stylesheet -->
		<link href="style.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/slide.css" type="text/css" media="screen" />
		
		<?php fadeInPage(); ?>
	</head>
	<body>
		<div class="tab"></div>
		<div id="wrapper">
			<div id="header">
			</div><!-- End header -->
			
			<div id="content" class="fade-in">
				<?php
				if(isset($_SESSION['username']))
				{
					if(isset($_POST['firstname']))
					{
						$username = $_SESSION['username'];

						$sql = "SELECT username, password FROM users WHERE username = '$username'";
						$res = mysqli_query($dbConn, $sql);
						
						if($row = mysqli_fetch_assoc($res))
						{
							$dbpass = $row['password'];
							$salt = substr($dbpass, 0, 64);
							$password = $_POST['confirm_right_user'];
							$sentpass = hash('sha256', $salt.$password);
							$sentwithsalt = $salt.$sentpass;
							
							if($sentwithsalt == $dbpass)
							{
								$firstname	= safe_insert($_POST['firstname']);
								$lastname	= safe_insert($_POST['lastname']);
								$email		= safe_insert($_POST['email']);
								
								$sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', email = '$email' WHERE username = '$username'";
								mysqli_query($dbConn, $sql);
								
								echo "<p>Uppdaterar din profil, var god vänta!</p>";
								echo '<META HTTP-EQUIV=Refresh CONTENT="2; url=edit_profile.php">';
							}
							else
							{
								echo "<p>Tyvärr, du har fyllt i ett felaktigt nuvarande lösenord. Försök igen!</p>";
								echo '<META HTTP-EQUIV=Refresh CONTENT="4; url=edit_profile.php">';
							}
						}
					}
				}
				else
				{
					echo "För att komma åt denna sidan måste du logga in först!";
				}
				?>
			</div><!-- End content -->
		</div><!-- End wrapper -->
		
		<div id="footer">
		<p>Martins Portfolio</p>
		</div><!-- End footer -->
	</body>
</html>