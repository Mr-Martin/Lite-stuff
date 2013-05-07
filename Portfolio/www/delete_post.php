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
		
		<!-- TinyMCE -->
		<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js" ></script >
		<script type="text/javascript" >
		tinyMCE.init({
			mode : "textareas",
			theme : "advanced",
			plugins : "emotions,spellchecker,advhr,insertdatetime,preview", 
					
			// Theme options - button# indicated the row# only
			theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect,formatselect",
			theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,|,code,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "insertdate,inserttime,|,spellchecker,advhr,,removeformat,|,sub,sup,|,charmap,emotions",      
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true
		});
		</script >
		
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
			
			<div id="content-edit" class="fade-in">
				<?php
					if(isset($_SESSION['username']))
					{
						$username = $_SESSION['username'];
						$threadID = $_GET['threadID'];
						
						$sql = "SELECT t.*, p.* FROM threads t
								INNER JOIN posts p ON t.threadID = p.threadID
								WHERE p.threadID = $threadID";
						$res = mysqli_query($dbConn, $sql);

						if($row = mysqli_fetch_assoc($res))
						{
							mysqli_query($dbConn, "DELETE FROM threads WHERE threadID = $threadID");
							mysqli_query($dbConn, "DELETE FROM posts WHERE threadID = $threadID");
							mysqli_query($dbConn, "DELETE FROM comment WHERE threadID = $threadID");
							
							//header('Location: forum.php');
							echo '<meta http-equiv="refresh" content="0; URL=forum.php">';
						}
						else
						{
							echo "Aja baja! Du får inte ta bort detta inlägg!";
						}
					}
					else
					{
						echo "Aja baja! Du får inte ta bort detta inlägg!";
					}
				?>
			</div><!-- End content -->
		</div><!-- End wrapper -->
		
		<div id="footer">
		<p>Martins Portfolio</p>
		</div><!-- End footer -->
	</body>
</html>