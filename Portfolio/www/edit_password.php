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
		
		<!-- Sliding login menu stylesheets -->
			<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
			<link rel="stylesheet" href="css/slide.css" type="text/css" media="screen" />
			<!-- PNG FIX for IE6 -->
			<!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
			<!--[if lte IE 6]> 
				<script type="text/javascript" src="js/pngfix/supersleight-min.js"></script>
			<![endif]-->

			<!-- Sliding effect -->
			<script src="js/slide.js" type="text/javascript"></script>
			
		<?php fadeInPage(); ?>
	</head>
	<body>
		<div id="wrapper">
			<?php get_header(); ?>
			
			<div id="content-edit" class="fade-in">
			<?php
			if(isset($_SESSION['username']))
			{
				echo "<h2>Ändra lösenord</h2>";
				echo "<div class='edit_box'>";

				$username = $_SESSION['username'];
				
				$sql = "SELECT userID, username FROM users WHERE username = '$username'";
				$res = mysqli_query($dbConn, $sql);
				
				while($row = mysqli_fetch_assoc($res))
				{
					$userID = $row['userID'];
					$username = $row['username'];
					
					$sql = "SELECT firstname, lastname, username, password, email FROM users WHERE userID = $userID AND username = '$username'";
					$res = mysqli_query($dbConn, $sql);
					
					while($row = mysqli_fetch_assoc($res))
					{
						echo '<form method="post" action="update_password.php" name="update_password">';
						echo '	<input type="hidden" name="userID" value="'. $userID . '" />';

						echo '	<label for="old_password">Ditt gamla lösenord</label>';
						echo '	<input type="password" name="old_password" /><br>';
						
						echo '	<label for="new_password">Nytt lösenord</label>';
						echo '	<input type="password" name="new_password"/><br>';
						
						echo '	<label for="repeat_password">Upprepa nytt lösenord</label>';
						echo '	<input type="password" name="repeat_password"/><br>';
						
						echo '	<input type="submit" value="Uppdatera profil" class="submit" />';
						echo ' </form>';
					}
				}
				show_edit_menu();
				echo "</div>";// End edit_box
			}
			else
			{
				echo "För att komma åt denna sidan måste du logga in först!";
			}
			?>
			</div><!-- End content-edit -->
		</div><!-- End wrapper -->
		
		<div id="footer">
		<p>Martins Portfolio</p>
		</div><!-- End footer -->
	</body>
</html>