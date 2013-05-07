<?php
include("functions.php");
include("db.php");
if (isset($_POST['username']) && isset($_POST['password']))
			{     
				user_login($_POST['username'], $_POST['password']);
			}
?>
<html>
	<head>
		<title>Portfolio</title>
		<meta charset="UTF-8">
		
		<!-- General stylesheet -->
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<script type="text/javascript" src="js/jquery.min.js"></script>
		
		<?php fadeInPage(); ?>
	</head>
	<body>
		<div id="wrapper">
			<div id="content" class="fade-in">
				<li class="thread-header">
					<div class="thread-title">Titel</div>
					<div class="thread-poster">Postad av</div>
					<div class="thread-date">Datum</div>
				</li>
				<?php
					$sql = "SELECT t.threadID, t.title, t.posted, u.username FROM threads t
							INNER JOIN users u ON t.userID = u.userID
							ORDER BY posted DESC";
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
					
						$username = $row['username'];
						$posted = $row['posted'];
						$title = $row['title'];
						$threadID = $row['threadID'];
						
						echo "<li class='thread-item $class'><a href='posts.php?threadID=$threadID'><div class='thread-title'>$title</div><div class='thread-poster'>$username</div><div class='thread-date'>$posted</div></a></li>";
					}
					echo "</ul>"; //End list-threads
				?>
			</div><!-- End content -->
		</div><!-- End wrapper -->
	</body>
</html>