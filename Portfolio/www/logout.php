<?php  
include "db.php";
if (isset($_SESSION['username']))
{
	$tmp = $_SESSION['username'];  
	session_destroy();  
	session_regenerate_id();  
	$_SESSION['username'] = $tmp;

	header( 'Location: index.php' ) ;

}
?>

