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
					
					while($row = mysqli_fetch_assoc($res))
					{
						$username = $row['username'];
						$posted = $row['posted'];
						$title = $row['title'];
						$content = $row['content'];
						
						echo "$username $posted<br><br>$title<br><br>$content";
					}
				}
			?>
			</div><!-- End content -->
		</div><!-- End wrapper -->
	</body>
</html>