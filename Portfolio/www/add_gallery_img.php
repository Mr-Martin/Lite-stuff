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
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js?ver=1.6.2"></script>
		
		<?php load_jqeury_upload_stuff(); ?>
		
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
					$sql = "SELECT username, level FROM users WHERE level = 'admin'";
					$res = mysqli_query($dbConn, $sql);
					
					while($row = mysqli_fetch_assoc($res))
					{
						$username = $row['username'];
						if($username == $_SESSION['username'])
						{
							echo "<h2>Redigera profilbild</h2>";
							echo "<div class='edit_box'>";
							
							show_edit_menu();
							
							echo "<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.
							<br><br>
							Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat.</p>";
							echo "</div>";// End edit_box
							echo "</div>";// End content-edit
							
							echo '<div class="fade-in">';
							upload_gallery();
							echo '</div>';
						}
						else
						{
							echo "Du måste vara Administratör för att få tillgång till denna sidan!";
						}
					}
				}
				else
				{
					echo "För att komma åt denna sidan måste du logga in först!";
				}
				?>
		</div><!-- End content-edit -->
		</div><!-- End wrapper -->

		<div id="footer" class="fade-in">
		<p>Martins Portfolio</p>
		</div><!-- End footer -->
	</body>
</html>