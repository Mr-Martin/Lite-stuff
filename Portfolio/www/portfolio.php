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
		<link href="css/colorbox.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.colorbox.js"></script>
		
		<!-- Pagination -->
		<script type="text/javascript" src="js/easypaginate.js"></script>
		
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
		
		<script>
			$(document).ready(function(){
				$(".group1").colorbox({
					rel: 'group1',
					transition: "elastic",
					height: "70%",
					title: true
					});
				$("a#gallery").colorbox({rel: 'group1', title: function(){
					var url = $(this).attr('href');
					return '<a href="' + url + '" target="_blank">Klicka här för att se i orginalformat!</a>';
				}});
			});
		</script>
		
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
		
		<script type="text/javascript">
  
		  jQuery(function($){
  
			  $('ul#items').easyPaginate({
			  step:12,
			  delay: 40
			  });
			  
			}); 
		  
		</script>
		
		<?php fadeInPage(); ?>
	</head>
	<body>
		<div id="wrapper">
			<?php get_header(); ?>
			
			<div id="content" class="fade-in">
			
				<ul id="items" class="gallery">
				<?php
					$sql = "SELECT filename FROM gallery";
					$res = mysqli_query($dbConn, $sql);
					
					while($row = mysqli_fetch_assoc($res))
					{
						$filename = $row['filename'];
						$link = "fileupload/files/$filename";
						
						echo '<li><a id="gallery" class="group1" href="fileupload/files/'.$filename.'" rel="1"><img src="fileupload/thumbnails/'.$filename.'"/></a></li>';
					}
				?>
				</ul>
				
			</div><!-- End content -->
		</div><!-- End wrapper -->
		
		<div id="footer">
		<p>Martins Portfolio</p>
		</div><!-- End footer -->
	</body>
</html>