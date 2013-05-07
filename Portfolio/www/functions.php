<?php
function get_header()
{
	echo '<div id="header">';
	echo	login_menu();
	echo	show_menu();
	echo '</div><!-- End header -->';
}

//Upload gallery
function upload_gallery()
{
	// The file upload form used as target for the file upload widget -->
	echo '<form id="fileupload" action="fileupload/" method="POST" enctype="multipart/form-data" >';
	
				// The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
	echo '		<div class="row fileupload-buttonbar">
				<div class="span7">
					<!-- The fileinput-button span is used to style the file input field as button -->
					<span class="btn btn-success fileinput-button">
						<i class="icon-plus icon-white"></i>
						<span>Add files...</span>
						<input type="file" name="files[]" multiple>
					</span>
					<button type="submit" class="btn btn-primary start">
						<i class="icon-upload icon-white"></i>
						<span>Start upload</span>
					</button>
					<button type="reset" class="btn btn-warning cancel">
						<i class="icon-ban-circle icon-white"></i>
						<span>Cancel upload</span>
					</button>
					<button type="button" class="btn btn-danger delete">
						<i class="icon-trash icon-white"></i>
						<span>Delete</span>
					</button>
					<div id="markera_alla">
						<input type="checkbox" class="toggle" name="markera_alla">
						Markera alla
					</div>
				</div>';
				
					// The global progress information -->
	echo '			<div class="span5 fileupload-progress fade">';
	
						// The global progress bar -->
	echo '				<div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
						<div class="bar" style="width:0%;"></div>
					</div>';
					
					// The extended global progress information -->
	echo '				<div class="progress-extended">&nbsp;</div>
				</div>
			</div>';
			
			// The loading indicator is shown during file processing -->
	echo '		<div class="fileupload-loading"></div>
			<br>';
			
			// The table listing the files available for upload/download -->
	echo '		<table role="presentation" class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
		 </form>';
}

//Fade in content
function fadeInPage()
{
	echo '<script type="text/javascript">
		$(function(){  // $(document).ready shorthand
		  $(".fade-in").hide().fadeIn(800);
		});
		</script>';
}

//Create key
function createKey()
{
	$key = rand(1, 100000000000000) + randLetter() + rand(1, 100000000000000) + randLetter() * rand(1, 100000) / rand(1,99) + randLetter();
	$keyhash = md5($key);
	return $keyhash;
}

//Random letter
function randLetter()
{
	$arr = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ!#$%'); // get all the characters into an array
    shuffle($arr); // randomize the array
    $arr = array_slice($arr, 0, 6); // get the first six (random) characters out
    $str = implode('', $arr); // smush them back into a string
	
	return $str;
}

//Remove all unsafe chars
function safe_insert($string)
	{
		global $dbConn;
		$string = htmlentities($string, ENT_QUOTES, 'UTF-8');
		$string = mysqli_real_escape_string($dbConn, $string);
		
		return ($string);
	}
	
//Show menu
function show_menu()
	{
		global $dbConn;
		
		$sql = "SELECT menuname, linkname FROM mainmenu";
		$res = mysqli_query($dbConn, $sql);
		
		echo '<div id="menu">';
		echo	'<ul>';
		while($row = mysqli_fetch_assoc($res))
			{
				$menuname = $row['menuname'];
				$linkname = $row['linkname'];
				
				echo '<li><a href="' . $linkname . '">' . $menuname . '</a></li>';
			}
		echo	'</ul>';
		echo '</div>';
	}

//Show edit menu
function show_edit_menu()
	{
		global $dbConn;
		
		echo '<div id="edit_menu">';
		echo	'<ul>';
		echo 		'<li class="button"><a href="edit_profile.php">Ändra användaruppgifter</a></li>';
		echo 		'<li class="button"><a href="edit_password.php">Ändra lösenord</a></li>';
		echo 		'<li class="button"><a href="my_posts.php">Mina inlägg</a></li>';
		
		$username = $_SESSION['username'];
		$sql = "SELECT username, level FROM users WHERE level = 'admin'";
		$res = mysqli_query($dbConn, $sql);
		
		while($row = mysqli_fetch_assoc($res))
		{
			$username = $row['username'];
			if($username == $_SESSION['username'])
			{
				echo 	'<li class="button"><a href="add_gallery_img.php">Lägg till galleribild</a></li>';
			}
		}
		
		echo	'</ul>';
		echo '</div>';
	}

//Login menu
function login_menu()
	{
		global $dbConn;
		
		//Panel
		echo '<div id="toppanel">';
		echo '<div id="panel">';
		echo '<div class="content clearfix">';
		echo '<div class="left">';
		echo '<h1>Välkommen!</h1>';	
		echo '<p class="grey">Jag har tidigare jobbat som webbdesigner, om du vill se några av mina skisser jag gjort under den tiden så kan du se dem under <a href="portfolio.php">portfolio</a>.</p>';
		echo '<h2>Vill du lämna ett meddelande till mig?</h2>';
		echo '<p class="grey">Om du vill skriva något till mig eller bara lämna en hälsning, då kan du göra det på <a href="forum.php">forumet</a>.</p>';
		echo '</div>';
		echo '<div class="left">';
		
		//Login Form
		echo '<h2>Logga in</h2>';
		echo '<form class="clearfix" action="#" method="post">';
		echo '<label class="grey" for="username">Användarnamn:</label>';
		echo '<input class="field" type="text" name="username" id="log" value="" size="20" />';
		echo '<label class="grey" for="password">Lösenord:</label>';
		echo '<input class="field" type="password" name="password" id="pwd" size="20" />';
		echo '<div class="clear"></div>';
		echo '<input type="submit" name="submit" value="LOGGA IN" class="bt_login" />';
	//	echo '<a class="lost-pwd" href="#">Lost your password?</a>';
		echo '</form>';
		echo '</div>';
		echo '<div class="left right">';	
		
		//Register Form
		echo '<h2>Inte medlem än? Registrera dig nedan!</h2>';
		
		echo '<form method="post" action="register.php">
			<label class="grey" for="firstname">Förnamn</label><br>
			<input class="field" type="text" name="firstname" id="safe_input"><br>
			
			<label class="grey" for="lastname">Efternamn</label><br>
			<input class="field" type="text" name="lastname" id="safe_input"><br>
			
			<label class="grey" for="username">Användarnamn</label><br>
			<input class="field" type="text" name="username" id="safe_input" maxlength="10"><br>
			
			<label class="grey" for="password">Lösenord</label><br>
			<input class="field" type="password" name="password" id="safe_input"><br>
			
			<label class="grey" for="email">E-post</label><br>
			<input class="field" type="text" name="email"><br>
			
			<input type="submit" value="REGISTRERA" id="submit" class="bt_register">
		</form>';
		echo '</div>'; // End left right
		echo '</div>'; // End panel
		echo '</div>'; // End login

		//The tab on top
		echo '<div class="tab">';
		echo 	'<div class="inner-tab">';
		
			if(isset($_SESSION['username']))
			{
			echo '<ul class="loggedin">';
			$user = $_SESSION['username'];
			echo '<li>Inloggad som ' . $user . '</li>';
			}
			else
			{
			echo '<ul class="login">';
			echo '<li>Hej Gäst!</li>';
			}
		echo '<li class="sep"></li>';
		echo '<li id="toggle">';
		
		if(isset($_SESSION['username']))
			{
				$sql = "SELECT userID FROM users WHERE username = '$user'";
				$res = mysqli_query($dbConn, $sql);
				
				while($row = mysqli_fetch_assoc($res))
				{
					$userID = $row['userID'];
					
					echo '<a class="logga_ut" href="logout.php">Logga ut</a>';
					echo '<a class="redigera" href="edit_profile.php">Redigera profil</a>';
				}
			}
			else
			{
			
			echo '<a id="open" class="open" href="#">Logga in</a>';
			}
			
			if (isset($_POST['username']) && isset($_POST['password']))
			{     
				user_login($_POST['username'], $_POST['password']);
			}
		
		echo '<a id="close" style="display: none;" class="close" href="#">Stäng panel</a>';	
		echo '</li>';
		echo '</ul>';
		echo '</div>';// End inner-tab
		echo '</div>';// End tab
			
		echo '</div>'; //End panel
	}
	
function load_jqeury_upload_stuff()
	{
		echo '
		<!-- Bootstrap CSS Toolkit styles -->
		<link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap.min.css">
		<!-- Bootstrap Image Gallery styles -->
		<link rel="stylesheet" href="http://blueimp.github.com/Bootstrap-Image-Gallery/css/bootstrap-image-gallery.min.css">
		<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
		<link rel="stylesheet" href="css/jquery.fileupload-ui.css">
		<!-- Shim to make HTML5 elements usable in older Internet Explorer versions -->
		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		
		<!-- The template to display files available for upload -->
		<script id="template-upload" type="text/x-tmpl">
		{% for (var i=0, file; file=o.files[i]; i++) { %}
			<tr class="template-upload fade">
				<td class="preview"><span class="fade"></span></td>
				<td class="name"><span>{%=file.name%}</span></td>
				<td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
				{% if (file.error) { %}
					<td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
				{% } else if (o.files.valid && !i) { %}
					<td>
						<div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
					</td>
					<td class="start">{% if (!o.options.autoUpload) { %}
						<button class="btn btn-primary">
							<i class="icon-upload icon-white"></i>
							<span>Start</span>
						</button>
					{% } %}</td>
				{% } else { %}
					<td colspan="2"></td>
				{% } %}
				<td class="cancel">{% if (!i) { %}
					<button class="btn btn-warning">
						<i class="icon-ban-circle icon-white"></i>
						<span>Cancel</span>
					</button>
				{% } %}</td>
			</tr>
		{% } %}
		</script>
		<!-- The template to display files available for download -->
		<script id="template-download" type="text/x-tmpl">
		{% for (var i=0, file; file=o.files[i]; i++) { %}
			<tr class="template-download fade">
				{% if (file.error) { %}
					<td></td>
					<td class="name"><span>{%=file.name%}</span></td>
					<td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
					<td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
				{% } else { %}
					<td class="preview">{% if (file.thumbnail_url) { %}
						<a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
					{% } %}</td>
					<td class="name">
						<a href="{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&"gallery"%}" download="{%=file.name%}">{%=file.name%}</a>
					</td>
					<td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
					<td colspan="2"></td>
				{% } %}
				<td class="delete">
					<button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
						<i class="icon-trash icon-white"></i>
						<span>Delete</span>
					</button>
					<input type="checkbox" name="delete" value="1">
				</td>
			</tr>
		{% } %}
		</script>
		<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
		<script src="js/vendor/jquery.ui.widget.js"></script>
		<!-- The Templates plugin is included to render the upload/download listings -->
		<script src="http://blueimp.github.com/JavaScript-Templates/tmpl.min.js"></script>
		<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
		<script src="http://blueimp.github.com/JavaScript-Load-Image/load-image.min.js"></script>
		<!-- The Canvas to Blob plugin is included for image resizing functionality -->
		<script src="http://blueimp.github.com/JavaScript-Canvas-to-Blob/canvas-to-blob.min.js"></script>
		<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
		<script src="js/jquery.iframe-transport.js"></script>
		<!-- The basic File Upload plugin -->
		<script src="js/jquery.fileupload.js"></script>
		<!-- The File Upload file processing plugin -->
		<script src="js/jquery.fileupload-fp.js"></script>
		<!-- The File Upload user interface plugin -->
		<script src="js/jquery.fileupload-ui.js"></script>
		<!-- The main application script -->
		<script src="js/main.js"></script>
		<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
		<!--[if gte IE 8]><script src="js/cors/jquery.xdr-transport.js"></script><![endif]-->';
	}
?>