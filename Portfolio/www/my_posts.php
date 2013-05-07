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
				echo "<h2>Mina inlägg</h2>";
				echo "<div class='edit_box'>";
				echo "<div class='left'>";
				
				echo '<li class="thread-header">
						<div class="thread-title">Titel</div>
						<div class="thread-date">Datum</div>
					</li>';
				
				$username = $_SESSION['username'];
				
				$sql = "SELECT u.userID, t.title, t.posted, t.threadID FROM users u
				INNER JOIN threads t ON u.userID = t.userID
				WHERE username = '$username'
				ORDER BY t.posted DESC";
				$res = mysqli_query($dbConn, $sql);
				
				$counter = 0;
				
				echo "<ul class='list-threads'>";
				while($row = mysqli_fetch_assoc($res))
				{
					if($counter % 2 ==0)
					{
						$class = "even";
					}
					else
					{
						$class = "uneven";
					}

					$counter++;

					$posted = $row['posted'];
					$title = $row['title'];
					$threadID = $row['threadID'];
					
					echo "<li class='thread-item $class'><a href='posts.php?threadID=$threadID'><div class='thread-title'>$title</div><div class='thread-date'>$posted</div></a></li>";
				}
				echo "</ul>"; //End list-threads
				echo "</div>";// End left
				echo "<div class='right'>";
					show_edit_menu();
				echo "</div>";// End right
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