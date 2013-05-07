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
		
		<?php load_jqeury_upload_stuff(); ?>
		<?php fadeInPage(); ?>
	</head>
	<body>
		<div id="wrapper">
			<?php get_header(); ?>
			
			<div id="content" class="fade-in">
			<?php
				$threadID = $_GET['threadID'];
				if(isset($threadID))
				{
					$sql = "SELECT p.postID, p.title, p.content, p.posted, u.username FROM posts p
							INNER JOIN users u ON u.userID = p.UserID
							WHERE p.threadID = $threadID
							ORDER BY p.posted";
					$res = mysqli_query($dbConn, $sql);

					if($row = mysqli_fetch_assoc($res))
					{
						$title = $row['title'];
						$posted = $row['posted'];
						$content = $row['content'];
						$username = $row['username'];
						
						echo "<a href='forum.php' class='back'>Gå tillbaka till forumet</a>";
						
						if(isset($_SESSION['username']))
						{
							if($username == $_SESSION['username'])
							{
								$threadID = $_GET['threadID'];
								
								echo "<a href='delete_post.php?threadID=". $threadID ."' class='delete-post btn btn-danger delete'><i class='icon-trash icon-white'></i> Radera inlägget</a>";
								echo "<a href='edit_post.php?threadID=". $threadID ."' class='edit btn btn-success fileinput-button'><i class='icon-plus icon-white'></i> Redigera</a>";
							}
						}
						
						echo "<div class='post-box'>";
						echo "<div class='post-header'>";
						echo "<div class='post-title'>» $title</div><div class='post-right'><strong>$username</strong> - $posted</div>";
						echo "</div>";
						
						echo $content;
						echo "</div>";
					//	echo "<hr>";
						
						$sql = "SELECT c.title, c.content, c.username, c.posted FROM comment c WHERE threadID = $threadID";
						$res = mysqli_query($dbConn, $sql);
						
							echo "<div class='comment-icon'></div>";
							
							while($row = mysqli_fetch_assoc($res))
							{
								$title = $row['title'];
								$poster = $row['username'];
								$posted = $row['posted'];
								$content = $row['content'];
								
								echo "<div class='comment-box'>";
								echo "<div class='comment-header'>";
								echo "<div class='comment-title'>» $title</div><div class='post-right'><strong>$username</strong> - $posted</div>";
								echo "</div>";
								echo "$content";
								echo "</div>";
							}
							
							$array = mysqli_num_rows($res);
							if($array == 0)
								{
									echo "<p class='no-comments'>Det finns inga kommentarer!</p>";
								}
						
						if(isset($_SESSION['username']))
						{
							echo "<a href='comment.php?threadID=" . $threadID . "' class='comment btn btn-primary start'>Kommentera inlägget</a>";
						}
						else
						{
							echo "<p style='font-size: 12px; color: #aaa; float: right; margin-right: 20px;'><em>För att kommentera detta inlägg, måste du logga in först!</em></p>";
						}
					}
				}
			?>
			</div><!-- End content -->
		</div><!-- End wrapper -->
		
		<div id="footer">
		<p>Martins Portfolio</p>
		</div><!-- End footer -->
	</body>
</html>