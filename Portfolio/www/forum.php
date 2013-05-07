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
		<script type="text/javascript" src="js/jquery.min.js"></script>
		
			<!-- AnythingSlider -->
			<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
			<script src="js/jquery.easing.1.2.js"></script>
			<script src="js/swfobject.js"></script>
			<script src="js/jquery.anythingslider.js"></script>
			
			<link rel="stylesheet" href="css/theme-metallic.css">
			
			<script>
			$(function(){
				$('#slider').anythingSlider();
			});
			</script>
		
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

		<script type="text/javascript">
			$(function(){
				$("#safe_input").keypress(function(event){
					var ew = event.which;
					if(48 <= ew && ew <= 57)
						return true;
					if(65 <= ew && ew <= 90)
						return true;
					if(97 <= ew && ew <= 122)
						return true;
					return false;
				});
			});
		</script>
		
		<?php fadeInPage(); ?>
	</head>
	<body>
		<div id="wrapper">
			<?php get_header(); ?>
			
			<div id="content" class="fade-in">
				<li class="thread-header">
					<div class="thread-title">Titel</div>
					<div class="thread-poster">Postad av</div>
					<div class="thread-date">Datum</div>
					<?php
					if(isset($_SESSION['username']))
						{
						echo "<div class='thread-post'><a href='post.php'>Skriv inlägg</a></div>";
						}
					else
						{
						echo "<div class='thread-post'>Logga in för att göra ett inlägg!</div>";
						}
					?>
				</li>
				<?php
					$sql = "SELECT t.threadID, t.title, t.posted, u.username FROM threads t
							INNER JOIN users u ON t.userID = u.userID
							ORDER BY posted DESC";
					$res = mysqli_query($dbConn, $sql);
					
					$counter = 0;
					
					echo "<div class='left'>";
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
					echo "</div>"; //End Left
					
					echo "<div class='right'>";
					echo "<div id='sidebar'>";
					echo 	"<h2>Senaste inläggen</h2>";
					
					$sql = "SELECT threadID, title, posted FROM threads ORDER BY posted DESC LIMIT 0, 5";
					$res = mysqli_query($dbConn, $sql);
					
					while($row = mysqli_fetch_assoc($res))
					{
						$title = $row['title'];
						$threadID = $row['threadID'];
						
						echo "<li><a href='posts.php?threadID=$threadID'>» $title</a></li>";
					}
					echo "</div>";//End sidebar
					echo "</div>";//End right
				?>
			</div><!-- End content -->
		</div><!-- End wrapper -->
		
		<div id="footer">
		<p>Martins Portfolio</p>
		</div><!-- End footer -->
	</body>
</html>