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
			
			<ul id="slider">
				<li><img src="images/slider_img_01.jpg" alt=""></li>
				<li><img src="images/slider_img_02.jpg" alt=""></li>
				<li><img src="images/slider_img_03.jpg" alt=""></li>
			</ul>
			
			<hr>
			
			<div class="box">
			<h2>HTML</h2>
			<p>Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis.
			</p>
			
			<p style="font-style: italic; font-size: 15px; color: #999">"Aenean ultricies mi vitae est, mauris placerat eleifend leo!"</p>
			
			<p>
			Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper.
			</p>
			</div>
			
			<div class="box">
			<h2>CSS</h2>
			<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper.
			</p>
			
			<p style="font-style: italic; font-size: 15px; color: #999">"Aenean ultricies mi vitae est, mauris placerat eleifend leo!"</p>
			
			<p>
			Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis.</p>
			</div>
			
			<div class="box">
			<h2>PHP</h2>
			<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Donec eu libero sit amet quam egestas semper.
			</p>
			
			<p style="font-style: italic; font-size: 15px; color: #999">"Aenean ultricies mi vitae est, mauris placerat eleifend leo!"</p>
			
			<p>
			Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec non enim in turpis pulvinar facilisis.</p>
			</div>
			
			
			</div><!-- End content -->
		</div><!-- End wrapper -->
		
		<div id="footer">
		<p>Martins Portfolio</p>
		</div><!-- End footer -->
	</body>
</html>